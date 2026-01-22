<?php
include 'header.php';
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = (int)$_SESSION['user_id'];

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: profil.php?tab=mele");
    exit;
}
$id = (int)$_GET['id'];

// ia mașina și verifică owner
$stmt = $conn->prepare("SELECT * FROM masini WHERE id=? AND user_id=? LIMIT 1");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) {
    $stmt->close();
    header("Location: profil.php?tab=mele");
    exit;
}
$masina = $res->fetch_assoc();
$stmt->close();

$err = '';
$ok = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marca = trim($_POST['marca'] ?? '');
    $model = trim($_POST['model'] ?? '');
    $an = (int)($_POST['an'] ?? 0);
    $pret = (int)($_POST['pret'] ?? 0);
    $kilometraj = (int)($_POST['kilometraj'] ?? 0);
    $combustibil = trim($_POST['combustibil'] ?? '');
    $cutie_viteze = trim($_POST['cutie_viteze'] ?? '');
    $culoare = trim($_POST['culoare'] ?? '');
    $descriere = trim($_POST['descriere'] ?? '');
    $imagine = trim($_POST['imagine'] ?? '');

    if ($marca === '' || $model === '' || $an <= 0 || $pret <= 0) {
        $err = "Completează corect câmpurile obligatorii (marca, model, an, preț).";
    } else {
        $upd = $conn->prepare("UPDATE masini 
            SET marca=?, model=?, an=?, pret=?, kilometraj=?, combustibil=?, cutie_viteze=?, culoare=?, descriere=?, imagine=? 
            WHERE id=? AND user_id=?");
        $upd->bind_param("ssiiisssssii", $marca, $model, $an, $pret, $kilometraj, $combustibil, $cutie_viteze, $culoare, $descriere, $imagine, $id, $user_id);
        $upd->execute();
        $upd->close();
        $ok = "Mașina a fost actualizată.";
        // reîncarcă datele
        $stmt2 = $conn->prepare("SELECT * FROM masini WHERE id=? AND user_id=? LIMIT 1");
        $stmt2->bind_param("ii", $id, $user_id);
        $stmt2->execute();
        $masina = $stmt2->get_result()->fetch_assoc();
        $stmt2->close();
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editează mașina - AutoNova</title>
  <link rel="stylesheet" href="css/styles.css">
  <style>
    .wrap{max-width:900px;margin:30px auto;padding:0 20px;}
    .card{background:var(--bg-secondary,#fff);border:1px solid var(--border-color,#e0e0e0);border-radius:12px;padding:18px;box-shadow:0 2px 12px rgba(0,0,0,.06);}
    .row{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
    label{font-weight:800;display:block;margin:10px 0 6px;}
    input,select,textarea{width:100%;padding:10px 12px;border-radius:10px;border:1px solid var(--border-color,#e0e0e0);background:var(--bg-secondary,#fff);color:var(--text-primary,#333);}
    textarea{min-height:120px;resize:vertical;}
    .btn{display:inline-block;margin-top:14px;padding:12px 16px;border-radius:10px;border:none;background:var(--accent-color,#ff6a00);color:#fff;font-weight:900;cursor:pointer;text-decoration:none;}
    .btn2{display:inline-block;margin-top:14px;margin-left:10px;padding:12px 16px;border-radius:10px;border:2px solid var(--accent-color,#ff6a00);color:var(--accent-color,#ff6a00);font-weight:900;text-decoration:none;background:transparent;}
    .msg{margin-top:12px;font-weight:800;}
    .msg.err{color:#b00020;}
    .msg.ok{color:#0a7d2f;}
    @media (max-width: 768px){.row{grid-template-columns:1fr;}}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card">
      <h2>Editează: <?php echo htmlspecialchars(($masina['marca']??'').' '.($masina['model']??'')); ?></h2>
      <a href="profil.php?tab=mele" class="btn2">← Înapoi</a>

      <?php if ($err): ?><div class="msg err"><?php echo htmlspecialchars($err); ?></div><?php endif; ?>
      <?php if ($ok): ?><div class="msg ok"><?php echo htmlspecialchars($ok); ?></div><?php endif; ?>

      <form method="post">
        <div class="row">
          <div>
            <label>Marca *</label>
            <input name="marca" value="<?php echo htmlspecialchars($masina['marca']??''); ?>" required>
          </div>
          <div>
            <label>Model *</label>
            <input name="model" value="<?php echo htmlspecialchars($masina['model']??''); ?>" required>
          </div>
          <div>
            <label>An *</label>
            <input type="number" name="an" value="<?php echo (int)($masina['an']??0); ?>" required>
          </div>
          <div>
            <label>Preț (€) *</label>
            <input type="number" name="pret" value="<?php echo (int)($masina['pret']??0); ?>" required>
          </div>
          <div>
            <label>Kilometraj</label>
            <input type="number" name="kilometraj" value="<?php echo (int)($masina['kilometraj']??0); ?>">
          </div>
          <div>
            <label>Combustibil</label>
            <input name="combustibil" value="<?php echo htmlspecialchars($masina['combustibil']??''); ?>">
          </div>
          <div>
            <label>Cutie viteze</label>
            <input name="cutie_viteze" value="<?php echo htmlspecialchars($masina['cutie_viteze']??''); ?>">
          </div>
          <div>
            <label>Culoare</label>
            <input name="culoare" value="<?php echo htmlspecialchars($masina['culoare']??''); ?>">
          </div>
        </div>

        <label>URL Imagine</label>
        <input name="imagine" value="<?php echo htmlspecialchars($masina['imagine']??''); ?>">

        <label>Descriere</label>
        <textarea name="descriere"><?php echo htmlspecialchars($masina['descriere']??''); ?></textarea>

        <button class="btn" type="submit">💾 Salvează</button>
      </form>
    </div>
  </div>
</body>
</html>
