<?php
// masina_save.php - proceseaza formularul de adaugare masina

session_start();
require_once 'config.php';

// Afiseaza erori doar in development (poti comenta pe hosting)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: adauga.php');
    exit;
}

// Helper: taie string + limita
function s($v, $max = 500): string {
    $v = trim((string)$v);
    if ($v === '') return '';
    if (mb_strlen($v) > $max) {
        $v = mb_substr($v, 0, $max);
    }
    return $v;
}

try {
    // Colecteaza + valideaza minim
    $marca = s($_POST['make'] ?? '', 50);
    $model = s($_POST['model'] ?? '', 100);
    $an = (int)($_POST['year'] ?? 0);
    $pret = (int)($_POST['price'] ?? 0);
    $combustibil = s($_POST['fuel'] ?? '', 20);
    $cutie_viteze = s($_POST['transmission'] ?? '', 20);
    $kilometraj = (int)($_POST['mileage'] ?? 0);
    $culoare = s($_POST['color'] ?? '', 30);
    $descriere = s($_POST['description'] ?? '', 5000);
    $contact = s($_POST['contact'] ?? '', 200); // momentan NU exista coloana in DB; pastram doar pentru viitor

    $currentYear = (int)date('Y');
    if ($marca === '' || $model === '' || $combustibil === '' || $cutie_viteze === '' || $culoare === '' || $descriere === '' || $contact === '') {
        throw new RuntimeException('Campuri obligatorii lipsa.');
    }
    if ($an < 1990 || $an > $currentYear) {
        throw new RuntimeException('An invalid.');
    }
    if ($pret < 0 || $pret > 1000000) {
        throw new RuntimeException('Pret invalid.');
    }
    if ($kilometraj < 0 || $kilometraj > 1000000) {
        throw new RuntimeException('Kilometraj invalid.');
    }

    // Imagine default sau prima din lista
    $imagine = 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800&h=450&fit=crop';
    $imagesRaw = s($_POST['images'] ?? '', 4000);
    $imagini = [];
    if ($imagesRaw !== '') {
        $imagini = array_values(array_filter(array_map('trim', explode(',', $imagesRaw))));
        if (count($imagini) > 0) {
            $imagine = s($imagini[0], 500);
        }
    }

    // Inserare masina + imagini extra intr-o tranzactie
    $conn->begin_transaction();

    $sql = "INSERT INTO masini (marca, model, an, pret, kilometraj, combustibil, cutie_viteze, culoare, descriere, imagine, featured, data_adaugare)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'ssiiisssss',
        $marca,
        $model,
        $an,
        $pret,
        $kilometraj,
        $combustibil,
        $cutie_viteze,
        $culoare,
        $descriere,
        $imagine
    );
    $stmt->execute();
    $masina_id = (int)$conn->insert_id;
    $stmt->close();

    // Imagini suplimentare (daca exista)
    if (count($imagini) > 0) {
        $sql_img = "INSERT INTO imagini_masini (masina_id, url_imagine, descriere, este_principala, ordine)
                    VALUES (?, ?, ?, ?, ?)";
        $stmt_img = $conn->prepare($sql_img);

        $ordine = 1;
        foreach ($imagini as $img_url) {
            $img_url = s($img_url, 500);
            if ($img_url === '') continue;

            $descr = 'Imagine anunt';
            $este_principala = ($ordine === 1) ? 1 : 0;
            $ordineVal = $ordine;

            $stmt_img->bind_param('issii', $masina_id, $img_url, $descr, $este_principala, $ordineVal);
            $stmt_img->execute();
            $ordine++;
        }
        $stmt_img->close();
    }

    $conn->commit();

    header('Location: adauga.php?success=1&id=' . $masina_id);
    exit;

} catch (Throwable $e) {
    // Daca a inceput tranzactia, revenim
    if ($conn && $conn->errno === 0) {
        // nu facem nimic
    }
    if ($conn && $conn->connect_errno === 0) {
        try { $conn->rollback(); } catch (Throwable $ignore) {}
    }

    // Pentru debugging local, poti vedea eroarea in log.
    // error_log($e->getMessage());
    header('Location: adauga.php?error=1');
    exit;
}
