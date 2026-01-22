<?php
// adauga_masini_rapid.php
include 'config.php';

echo "<style>
    body { font-family: Arial, sans-serif; padding: 20px; background: #f8f9fa; max-width: 1200px; margin: 0 auto; }
    .success { color: #2e7d32; background: #e8f5e8; padding: 10px; border-radius: 5px; margin: 10px 0; }
    .error { color: #c62828; background: #ffebee; padding: 10px; border-radius: 5px; margin: 10px 0; }
    .info { color: #1565c0; background: #e3f2fd; padding: 10px; border-radius: 5px; margin: 10px 0; }
    .warning { color: #ff9800; background: #fff3cd; padding: 10px; border-radius: 5px; margin: 10px 0; }
    
    .masina-card { 
        background: white; 
        padding: 15px; 
        border-radius: 8px; 
        margin: 15px 0; 
        border: 1px solid #ddd;
        border-left: 4px solid #ff6a00;
        transition: all 0.3s;
    }
    .masina-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    
    .btn {
        background: #ff6a00;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        margin: 5px;
        transition: background 0.3s;
    }
    .btn:hover {
        background: #e65e00;
    }
    
    .btn-secondary {
        background: #6c757d;
    }
    .btn-secondary:hover {
        background: #5a6268;
    }
    
    .btn-success {
        background: #28a745;
    }
    .btn-success:hover {
        background: #218838;
    }
    
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin: 20px 0;
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }
    
    .form-control {
        width: 100%;
        padding: 8px 12px;
        border: 2px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
    }
    
    .form-control:focus {
        border-color: #ff6a00;
        outline: none;
    }
    
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 10px 0;
    }
    
    .stats {
        background: white;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
        border: 1px solid #ddd;
    }
    
    .price-tag {
        background: #ff6a00;
        color: white;
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: bold;
        display: inline-block;
        margin-left: 10px;
    }
    
    .featured-badge {
        background: #28a745;
        color: white;
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: bold;
        display: inline-block;
        margin-left: 10px;
    }
    
    h1, h2, h3 {
        color: #333;
    }
    
    a {
        color: #ff6a00;
        text-decoration: none;
        font-weight: bold;
    }
    
    a:hover {
        text-decoration: underline;
    }
    
    .action-buttons {
        display: flex;
        gap: 10px;
        margin-top: 10px;
        flex-wrap: wrap;
    }
</style>";

echo "<h1>🚗 Adaugă rapid mașini în AutoNova</h1>";

// Verifică dacă există tabelele
$tables_exist = true;
$result = $conn->query("SHOW TABLES LIKE 'masini'");
if ($result->num_rows == 0) {
    echo "<div class='error'>❌ Tabela 'masini' nu există! Rulează mai întâi populeaza_baza.php</div>";
    $tables_exist = false;
}

if (!$tables_exist) {
    echo "<div class='action-buttons'>";
    echo "<a href='populeaza_baza.php' class='btn'>📥 Rulează Populare Baza</a>";
    echo "<a href='index.php' class='btn btn-secondary'>🏠 Pagina Principală</a>";
    echo "</div>";
    exit();
}

// Verifică statistici curente
$stats = $conn->query("SELECT COUNT(*) as total_masini FROM masini")->fetch_assoc();
$total_masini = $stats['total_masini'];

echo "<div class='stats'>";
echo "<h3>📊 Statistici curente:</h3>";
echo "<p><strong>Mașini în baza de date:</strong> <span style='font-size: 24px; color: #ff6a00;'>$total_masini</span></p>";
echo "</div>";

// Meniu de acțiuni
echo "<div class='action-buttons'>";
echo "<button class='btn' onclick=\"showSection('adauga-rapid')\">➕ Adaugă Rapid</button>";
echo "<button class='btn btn-secondary' onclick=\"showSection('lista-masini')\">📋 Vezi Toate Mașinile</button>";
echo "<button class='btn' onclick=\"showSection('categorii')\">🚙 Adaugă din Categorii</button>";
echo "<a href='index.php' class='btn'>🏠 Pagina Principală</a>";
echo "<a href='populeaza_baza.php' class='btn btn-success'>🔄 Repopulează Baza</a>";
echo "</div>";

// ============================================
// SECȚIUNEA 1: Adaugă rapid mașini
// ============================================
echo "<div id='adauga-rapid' class='section' style='display: none;'>";
echo "<h2>➕ Adaugă mașină rapid</h2>";

echo "<form method='POST' action='' onsubmit='return validateForm()'>";
echo "<div class='grid-container'>";

// Coloana 1
echo "<div>";
echo "<div class='form-group'><label>Marca *</label><input type='text' name='marca' class='form-control' required placeholder='ex: BMW'></div>";
echo "<div class='form-group'><label>Model *</label><input type='text' name='model' class='form-control' required placeholder='ex: Seria 3'></div>";
echo "<div class='form-group'><label>An *</label><input type='number' name='an' class='form-control' required min='1990' max='2024' placeholder='ex: 2022'></div>";
echo "<div class='form-group'><label>Preț (€) *</label><input type='number' name='pret' class='form-control' required min='0' placeholder='ex: 25000'></div>";
echo "</div>";

// Coloana 2
echo "<div>";
echo "<div class='form-group'><label>Kilometraj *</label><input type='number' name='kilometraj' class='form-control' required min='0' placeholder='ex: 45000'></div>";
echo "<div class='form-group'><label>Combustibil *</label>
        <select name='combustibil' class='form-control' required>
            <option value=''>Selectează</option>
            <option value='benzina'>Benzină</option>
            <option value='motorina'>Motorină</option>
            <option value='hibrid'>Hibrid</option>
            <option value='electric'>Electric</option>
            <option value='gpl'>GPL</option>
        </select>
    </div>";
echo "<div class='form-group'><label>Cutie viteze *</label>
        <select name='cutie_viteze' class='form-control' required>
            <option value=''>Selectează</option>
            <option value='manual'>Manuală</option>
            <option value='automata'>Automată</option>
        </select>
    </div>";
echo "<div class='form-group'><label>Culoare</label><input type='text' name='culoare' class='form-control' placeholder='ex: Alb'></div>";
echo "</div>";

// Coloana 3
echo "<div>";
echo "<div class='form-group'><label>Putere (CP)</label><input type='text' name='putere' class='form-control' placeholder='ex: 190 CP'></div>";
echo "<div class='form-group'><label>Capacitate cilindrică</label><input type='text' name='capacitate' class='form-control' placeholder='ex: 1995 cm³'></div>";
echo "<div class='form-group'><label>URL Imagine principală *</label><input type='text' name='imagine' class='form-control' required placeholder='https://...'></div>";
echo "<div class='checkbox-group'>
        <input type='checkbox' name='featured' id='featured' value='1'>
        <label for='featured'>Mașină featured (apare ca NOU/RECOMANDATĂ)</label>
    </div>";
echo "</div>";

echo "</div>"; // închide grid-container

echo "<div class='form-group'>";
echo "<label>Descriere</label>";
echo "<textarea name='descriere' class='form-control' rows='4' placeholder='Descrie mașina, dotările, stare...'></textarea>";
echo "</div>";

echo "<div class='form-group'>";
echo "<label>Imagini suplimentare (URL-uri separate prin virgulă)</label>";
echo "<textarea name='imagini_extra' class='form-control' rows='2' placeholder='https://image1.jpg, https://image2.jpg'></textarea>";
echo "<small>Adaugă link-uri către imagini suplimentare (opțional)</small>";
echo "</div>";

echo "<div class='action-buttons'>";
echo "<button type='submit' name='adauga_masina' class='btn btn-success'>✅ Adaugă Mașină</button>";
echo "<button type='reset' class='btn btn-secondary'>🔄 Resetează Formular</button>";
echo "</div>";
echo "</form>";
echo "</div>";

// ============================================
// SECȚIUNEA 2: Lista mașinilor existente
// ============================================
echo "<div id='lista-masini' class='section' style='display: none;'>";
echo "<h2>📋 Mașinile tale</h2>";

$result = $conn->query("SELECT * FROM masini ORDER BY id DESC LIMIT 20");
if ($result->num_rows > 0) {
    echo "<div class='grid-container'>";
    while($masina = $result->fetch_assoc()) {
        echo "<div class='masina-card'>";
        echo "<h3>" . htmlspecialchars($masina['marca']) . " " . htmlspecialchars($masina['model']) . "</h3>";
        echo "<p><strong>An:</strong> " . $masina['an'] . "</p>";
        echo "<p><strong>Preț:</strong> <span class='price-tag'>" . number_format($masina['pret']) . "€</span></p>";
        echo "<p><strong>KM:</strong> " . number_format($masina['kilometraj']) . " km</p>";
        echo "<p><strong>Combustibil:</strong> " . $masina['combustibil'] . "</p>";
        if ($masina['featured']) {
            echo "<span class='featured-badge'>FEATURED</span>";
        }
        echo "<div class='action-buttons' style='margin-top: 10px;'>";
        echo "<a href='detalii.php?id=" . $masina['id'] . "' class='btn' style='padding: 5px 10px; font-size: 12px;'>👁️ Vezi</a>";
        echo "<button class='btn btn-secondary' style='padding: 5px 10px; font-size: 12px;' onclick=\"editMasina(" . $masina['id'] . ")\">✏️ Edit</button>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
    
    // Buton pentru a vedea toate
    $total_count = $conn->query("SELECT COUNT(*) as total FROM masini")->fetch_assoc()['total'];
    if ($total_count > 20) {
        echo "<div class='info'>";
        echo "Afișate 20 din $total_count mașini. ";
        echo "<a href='#' onclick=\"alert('Pentru a vedea toate mașinile, accesează index.php')\">Vezi toate mașinile</a>";
        echo "</div>";
    }
} else {
    echo "<div class='warning'>📭 Nu există mașini în baza de date.</div>";
}
echo "</div>";

// ============================================
// SECȚIUNEA 3: Adaugă din categorii predefinite
// ============================================
echo "<div id='categorii' class='section' style='display: none;'>";
echo "<h2>🚙 Adaugă mașini din categorii</h2>";
echo "<p>Selectează o categorie pentru a adăuga rapid mai multe mașini:</p>";

// Array cu mașini pe categorii
$categorii_masini = [
    'SUV Premium' => [
        [
            'marca' => 'BMW',
            'model' => 'X5 xDrive40d',
            'an' => 2021,
            'pret' => 68900,
            'kilometraj' => 32500,
            'combustibil' => 'motorina',
            'cutie_viteze' => 'automata',
            'putere' => '340 CP',
            'culoare' => 'Albastru',
            'descriere' => 'BMW X5 xDrive40d, M Sport Package, interior piele Merino, suspensie aer, audio Harman Kardon.',
            'featured' => 1,
            'imagine' => 'https://images.unsplash.com/photo-1553440569-bcc63803a83d?w=800&h=450&fit=crop'
        ],
        [
            'marca' => 'Audi',
            'model' => 'Q7 55 TFSI',
            'an' => 2022,
            'pret' => 74900,
            'kilometraj' => 18900,
            'combustibil' => 'benzina',
            'cutie_viteze' => 'automata',
            'putere' => '340 CP',
            'culoare' => 'Negru',
            'descriere' => 'Audi Q7 Vorsprung, pachet S line, faruri Matrix LED, suspensie adaptivă, interior premium.',
            'featured' => 1,
            'imagine' => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=800&h=450&fit=crop'
        ]
    ],
    
    'Sport & Performanță' => [
        [
            'marca' => 'Porsche',
            'model' => '911 Carrera S',
            'an' => 2020,
            'pret' => 112900,
            'kilometraj' => 12500,
            'combustibil' => 'benzina',
            'cutie_viteze' => 'automata',
            'putere' => '450 CP',
            'culoare' => 'Alb',
            'descriere' => 'Porsche 911 Carrera S, PDK, pachet sport chrono, interior full leather, sport exhaust.',
            'featured' => 1,
            'imagine' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&h=450&fit=crop'
        ],
        [
            'marca' => 'BMW',
            'model' => 'M4 Competition',
            'an' => 2022,
            'pret' => 95900,
            'kilometraj' => 8900,
            'combustibil' => 'benzina',
            'cutie_viteze' => 'automata',
            'putere' => '510 CP',
            'culoare' => 'Portocaliu',
            'descriere' => 'BMW M4 Competition, xDrive, pachet M Carbon, scaune bucket, sistem M Sport exhaust.',
            'featured' => 1,
            'imagine' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&h=450&fit=crop'
        ]
    ],
    
    'Electrice' => [
        [
            'marca' => 'Tesla',
            'model' => 'Model 3 Performance',
            'an' => 2023,
            'pret' => 51900,
            'kilometraj' => 5600,
            'combustibil' => 'electric',
            'cutie_viteze' => 'automata',
            'putere' => '450 CP',
            'culoare' => 'Roșu',
            'descriere' => 'Tesla Model 3 Performance, autonomie 547km, acceleration boost, premium interior.',
            'featured' => 1,
            'imagine' => 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?w=800&h=450&fit=crop'
        ],
        [
            'marca' => 'Audi',
            'model' => 'e-tron GT',
            'an' => 2023,
            'pret' => 112900,
            'kilometraj' => 4200,
            'combustibil' => 'electric',
            'cutie_viteze' => 'automata',
            'putere' => '530 CP',
            'culoare' => 'Gri',
            'descriere' => 'Audi e-tron GT quattro, pachet design, interior piele, autonomie 488km, încărcare rapidă.',
            'featured' => 1,
            'imagine' => 'https://images.unsplash.com/photo-1593941707882-a5bba5338fe2?w=800&h=450&fit=crop'
        ]
    ],
    
    'Clasic & Accesibil' => [
        [
            'marca' => 'Volkswagen',
            'model' => 'Golf 8 GTI',
            'an' => 2022,
            'pret' => 32900,
            'kilometraj' => 18700,
            'combustibil' => 'benzina',
            'cutie_viteze' => 'automata',
            'putere' => '245 CP',
            'culoare' => 'Alb',
            'descriere' => 'Volkswagen Golf 8 GTI, pachet Performance, scaune sport, audio Harman Kardon, DCC.',
            'featured' => 1,
            'imagine' => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=800&h=450&fit=crop'
        ],
        [
            'marca' => 'Ford',
            'model' => 'Mustang GT',
            'an' => 2021,
            'pret' => 45900,
            'kilometraj' => 23400,
            'combustibil' => 'benzina',
            'cutie_viteze' => 'automata',
            'putere' => '450 CP',
            'culoare' => 'Albastru',
            'descriere' => 'Ford Mustang GT, pachet Performance, active exhaust, MagneRide suspension, Recaro seats.',
            'featured' => 0,
            'imagine' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&h=450&fit=crop'
        ]
    ]
];

// Afișează categoriile
echo "<div class='grid-container'>";
foreach ($categorii_masini as $categorie => $masini) {
    echo "<div class='masina-card'>";
    echo "<h3>$categorie</h3>";
    echo "<p><strong>Disponibile:</strong> " . count($masini) . " mașini</p>";
    
    echo "<div style='margin-top: 15px;'>";
    foreach ($masini as $index => $masina) {
        echo "<p style='margin: 5px 0;'>• " . $masina['marca'] . " " . $masina['model'] . " - " . number_format($masina['pret']) . "€</p>";
    }
    echo "</div>";
    
    echo "<form method='POST' action='' style='margin-top: 15px;'>";
    echo "<input type='hidden' name='categorie' value='" . htmlspecialchars($categorie) . "'>";
    echo "<button type='submit' name='adauga_categorie' class='btn'>📥 Adaugă toate (" . count($masini) . ")</button>";
    echo "</form>";
    echo "</div>";
}
echo "</div>";
echo "</div>";

// ============================================
// PROCESARE FORMULARE
// ============================================

// Procesare adăugare masină individuală
if (isset($_POST['adauga_masina'])) {
    echo "<div class='info'>🔄 Se procesează adăugarea mașinii...</div>";
    
    $marca = $conn->real_escape_string($_POST['marca']);
    $model = $conn->real_escape_string($_POST['model']);
    $an = intval($_POST['an']);
    $pret = intval($_POST['pret']);
    $kilometraj = intval($_POST['kilometraj']);
    $combustibil = $conn->real_escape_string($_POST['combustibil']);
    $cutie_viteze = $conn->real_escape_string($_POST['cutie_viteze']);
    $putere = isset($_POST['putere']) ? $conn->real_escape_string($_POST['putere']) : '';
    $capacitate = isset($_POST['capacitate']) ? $conn->real_escape_string($_POST['capacitate']) : '';
    $culoare = isset($_POST['culoare']) ? $conn->real_escape_string($_POST['culoare']) : '';
    $descriere = isset($_POST['descriere']) ? $conn->real_escape_string($_POST['descriere']) : '';
    $featured = isset($_POST['featured']) ? 1 : 0;
    $imagine = $conn->real_escape_string($_POST['imagine']);
    
    $sql = "INSERT INTO masini (user_id, marca, model, an, pret, kilometraj, combustibil, cutie_viteze, putere, capacitate_cilindrica, culoare, descriere, featured, imagine) 
            VALUES (NULL, ? ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiiissssssis", 
        $marca, $model, $an, $pret, $kilometraj, $combustibil,
        $cutie_viteze, $putere, $capacitate, $culoare, $descriere, $featured, $imagine
    );
    
    if ($stmt->execute()) {
        $masina_id = $conn->insert_id;
        echo "<div class='success'>✅ Mașina a fost adăugată cu succes! ID: $masina_id</div>";
        
        // Adaugă imagini extra dacă există
        if (!empty($_POST['imagini_extra'])) {
            $imagini_extra = explode(',', $_POST['imagini_extra']);
            $ordine = 2;
            foreach ($imagini_extra as $imagine_extra) {
                $imagine_extra = trim($imagine_extra);
                if (!empty($imagine_extra)) {
                    $sql_img = "INSERT INTO imagini_masini (masina_id, url_imagine, descriere, este_principala, ordine) 
                               VALUES (NULL, ? ?, 'Imagine suplimentară', 0, ?)";
                    $stmt_img = $conn->prepare($sql_img);
                    $stmt_img->bind_param("isi", $masina_id, $imagine_extra, $ordine);
                    $stmt_img->execute();
                    $ordine++;
                }
            }
            echo "<div class='info'>📷 " . ($ordine-2) . " imagini suplimentare adăugate</div>";
        }
        
        // Refresh stats
        $total_masini = $conn->query("SELECT COUNT(*) as total FROM masini")->fetch_assoc()['total'];
        echo "<script>document.querySelector('.stats p').innerHTML = '<strong>Mașini în baza de date:</strong> <span style=\"font-size: 24px; color: #ff6a00;\">$total_masini</span>';</script>";
        
    } else {
        echo "<div class='error'>❌ Eroare la adăugare: " . $stmt->error . "</div>";
    }
}

// Procesare adăugare categorie
if (isset($_POST['adauga_categorie'])) {
    $categorie = $_POST['categorie'];
    
    if (isset($categorii_masini[$categorie])) {
        echo "<div class='info'>🔄 Se adaugă mașinile din categoria: <strong>$categorie</strong></div>";
        
        $adaugate = 0;
        $erori = 0;
        
        foreach ($categorii_masini[$categorie] as $masina) {
            $sql = "INSERT INTO masini (user_id, marca, model, an, pret, kilometraj, combustibil, cutie_viteze, putere, capacitate_cilindrica, culoare, descriere, featured, imagine) 
                    VALUES (NULL, ? ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssiiissssssis", 
                $masina['marca'], $masina['model'], $masina['an'], 
                $masina['pret'], $masina['kilometraj'], $masina['combustibil'],
                $masina['cutie_viteze'], $masina['putere'], $masina['capacitate_cilindrica'],
                $masina['culoare'], $masina['descriere'], $masina['featured'], $masina['imagine']
            );
            
            if ($stmt->execute()) {
                $adaugate++;
                echo "<div class='success' style='padding: 5px; margin: 2px;'>✅ " . $masina['marca'] . " " . $masina['model'] . "</div>";
            } else {
                $erori++;
                echo "<div class='error' style='padding: 5px; margin: 2px;'>❌ " . $masina['marca'] . " " . $masina['model'] . " - " . $stmt->error . "</div>";
            }
        }
        
        echo "<div class='info'>";
        echo "🎉 <strong>Operațiune completă:</strong><br>";
        echo "✅ Adăugate: $adaugate mașini<br>";
        echo "❌ Erori: $erori";
        echo "</div>";
        
        // Refresh stats
        $total_masini = $conn->query("SELECT COUNT(*) as total FROM masini")->fetch_assoc()['total'];
        echo "<script>document.querySelector('.stats p').innerHTML = '<strong>Mașini în baza de date:</strong> <span style=\"font-size: 24px; color: #ff6a00;\">$total_masini</span>';</script>";
    }
}

$conn->close();
?>

<script>
// Funcții JavaScript
function showSection(sectionId) {
    // Ascunde toate secțiunile
    document.querySelectorAll('.section').forEach(section => {
        section.style.display = 'none';
    });
    
    // Arată secțiunea selectată
    document.getElementById(sectionId).style.display = 'block';
    
    // Salvează preferința
    localStorage.setItem('lastSection', sectionId);
}

function validateForm() {
    const pret = document.querySelector('input[name="pret"]').value;
    const kilometraj = document.querySelector('input[name="kilometraj"]').value;
    const an = document.querySelector('input[name="an"]').value;
    
    if (pret < 0 || kilometraj < 0 || an < 1990 || an > 2024) {
        alert('Te rugăm să introduci valori valide:\n- Preț pozitiv\n- Kilometraj pozitiv\n- An între 1990 și 2024');
        return false;
    }
    
    return true;
}

function editMasina(id) {
    if (confirm(`Vrei să editezi mașina cu ID ${id}?\nAceastă funcție va fi implementată în versiunea următoare.`)) {
        // Pentru moment, redirecționează la detalii
        window.location.href = `detalii.php?id=${id}`;
    }
}

// La încărcarea paginii, arată secțiunea salvată sau prima
document.addEventListener('DOMContentLoaded', function() {
    const lastSection = localStorage.getItem('lastSection') || 'adauga-rapid';
    showSection(lastSection);
    
    // Dacă există mesaje de succes, arată secțiunea listei
    if (document.querySelector('.success')) {
        setTimeout(() => showSection('lista-masini'), 1000);
    }
});
</script>

<div style="margin-top: 40px; padding: 20px; background: #f0f0f0; border-radius: 10px; text-align: center;">
    <h3>💡 Sfaturi pentru adăugare rapidă</h3>
    <p><strong>Pentru imagini:</strong> Folosește <a href="https://unsplash.com/s/photos/car" target="_blank">Unsplash</a> sau <a href="https://pixabay.com/images/search/car/" target="_blank">Pixabay</a> pentru imagini gratuite de calitate.</p>
    <p><strong>Prețuri realiste:</strong> Verifică prețurile pe <a href="https://www.autovit.ro" target="_blank">AutoVit</a> sau <a href="https://www.olx.ro/auto-masini-moto-ambarcatiuni/" target="_blank">OLX</a>.</p>
    <p><strong>Descrieri atractive:</strong> Include dotări principale, stare tehnică, istoric service.</p>
</div>