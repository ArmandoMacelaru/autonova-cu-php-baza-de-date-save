<?php
// populeaza_baza.php
include 'config.php';

echo "<style>
    body { font-family: Arial, sans-serif; padding: 20px; background: #f8f9fa; }
    .success { color: #2e7d32; background: #e8f5e8; padding: 10px; border-radius: 5px; margin: 10px 0; }
    .error { color: #c62828; background: #ffebee; padding: 10px; border-radius: 5px; margin: 10px 0; }
    .info { color: #1565c0; background: #e3f2fd; padding: 10px; border-radius: 5px; margin: 10px 0; }
    a { color: #ff6a00; text-decoration: none; font-weight: bold; }
    a:hover { text-decoration: underline; }
</style>";

echo "<h2>🔄 Populare baza de date AutoNova cu mașini premium</h2>";

// Verifică dacă tabelele există
$tables_exist = true;
$result = $conn->query("SHOW TABLES LIKE 'masini'");
if ($result->num_rows == 0) {
    echo "<div class='error'>❌ Tabela 'masini' nu există!</div>";
    $tables_exist = false;
}

$result = $conn->query("SHOW TABLES LIKE 'imagini_masini'");
if ($result->num_rows == 0) {
    echo "<div class='error'>❌ Tabela 'imagini_masini' nu există!</div>";
    $tables_exist = false;
}

if (!$tables_exist) {
    echo "<div class='info'>💡 Creează tabelele folosind acest SQL în phpMyAdmin:</div>";
    echo "<pre style='background: #fff; padding: 15px; border-radius: 5px; border: 1px solid #ddd;'>
CREATE TABLE masini (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(50) NOT NULL,
    model VARCHAR(100) NOT NULL,
    an INT NOT NULL,
    pret INT NOT NULL,
    kilometraj INT NOT NULL,
    combustibil VARCHAR(20) NOT NULL,
    cutie_viteze VARCHAR(20) NOT NULL,
    putere VARCHAR(20),
    capacitate_cilindrica VARCHAR(20),
    culoare VARCHAR(30),
    descriere TEXT,
    featured BOOLEAN DEFAULT 0,
    imagine VARCHAR(500)
);

CREATE TABLE imagini_masini (
    id INT AUTO_INCREMENT PRIMARY KEY,
    masina_id INT NOT NULL,
    url_imagine VARCHAR(500) NOT NULL,
    descriere VARCHAR(200),
    este_principala BOOLEAN DEFAULT 0,
    ordine INT DEFAULT 0,
    FOREIGN KEY (masina_id) REFERENCES masini(id) ON DELETE CASCADE
);
</pre>";
    exit();
}

// Șterge datele vechi cu verificare
echo "<div class='info'>🗑️ Ștergere date vechi...</div>";

// Dezactivează verificările FK temporar
$conn->query("SET FOREIGN_KEY_CHECKS = 0");

// Șterge datele
$conn->query("DELETE FROM imagini_masini");
$conn->query("DELETE FROM masini");

// Resetează auto-increment
$conn->query("ALTER TABLE masini AUTO_INCREMENT = 1");
$conn->query("ALTER TABLE imagini_masini AUTO_INCREMENT = 1");

// Reactivează verificările FK
$conn->query("SET FOREIGN_KEY_CHECKS = 1");

echo "<div class='success'>✅ Datele vechi au fost șterse!</div>";

// Array cu mașini premium
$masini_premium = [
    [
        'marca' => 'BMW',
        'model' => 'Seria 5 530d',
        'an' => 2022,
        'pret' => 48900,
        'kilometraj' => 28500,
        'combustibil' => 'motorina',
        'cutie_viteze' => 'automata',
        'putere' => '265 CP',
        'capacitate_cilindrica' => '2993 cm³',
        'culoare' => 'Alb',
        'descriere' => 'BMW Seria 5 în stare impecabilă, full options, istoric service la reprezentantă, fără accidente. Dotări: cutie automată Steptronic, faruri LED adaptative, head-up display, scaune ergonomice, sistem audio Harman Kardon, pachet M Sport.',
        'featured' => 1,
        'imagine' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&h=450&fit=crop',
        'imagini_extra' => [
            'https://www.bmw.ro/content/dam/bmw/common/all-models/5-series/sedan/2023/highlights/bmw-5-series-sedan-sp-desktop.jpg',
            'https://www.bmw.ro/content/dam/bmw/common/all-models/5-series/sedan/2023/highlights/bmw-5-series-sedan-interior-desktop.jpg'
        ]
    ],
    [
        'marca' => 'Mercedes',
        'model' => 'E-Class E220d',
        'an' => 2021,
        'pret' => 41900,
        'kilometraj' => 34200,
        'combustibil' => 'motorina',
        'cutie_viteze' => 'automata',
        'putere' => '194 CP',
        'capacitate_cilindrica' => '1950 cm³',
        'culoare' => 'Negru',
        'descriere' => 'Mercedes E-Class AMG Line, interior piele Artico, navigație MBUX, camera 360°, sistem audio Burmester, pachet AMG Night, scaune multicontur. Mașină întreținută exclusiv la reprezentanță.',
        'featured' => 1,
        'imagine' => 'https://images.unsplash.com/photo-1563720223485-8f6a4bca015c?w=800&h=450&fit=crop',
        'imagini_extra' => [
            'https://www.mercedes-benz.ro/passengercars/_jcr_content/root/paragraph/paragraph-right/paragraphimage.coreimg.90.2560.jpeg/1684835996467/mercedes-benz-clasa-c-2023-w206-2560x1440.jpeg',
            'https://www.mercedes-benz.ro/passengercars/_jcr_content/root/paragraph/paragraph-right/paragraphimage.coreimg.90.2560.jpeg/1684835996468/mercedes-benz-clasa-c-2023-w206-interior-2560x1440.jpeg'
        ]
    ],
    [
        'marca' => 'Audi',
        'model' => 'A6 3.0 TDI',
        'an' => 2020,
        'pret' => 38900,
        'kilometraj' => 45600,
        'combustibil' => 'motorina',
        'cutie_viteze' => 'automata',
        'putere' => '286 CP',
        'capacitate_cilindrica' => '2967 cm³',
        'culoare' => 'Gri Metalizat',
        'descriere' => 'Audi A6 Quattro, cutie S-tronic, faruri Matrix LED, heads-up display, pachet sport, interior Valcona, suspensie adaptivă. Mașină verificată Audi Approved Plus.',
        'featured' => 0,
        'imagine' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&h=450&fit=crop',
        'imagini_extra' => [
            'https://www.audi.ro/content/dam/nemo/models/a6/a6-sedan/my-2023/1920x1080-teaser/1920x1080_AA6_191023.jpg',
            'https://www.audi.ro/content/dam/nemo/models/a6/a6-sedan/my-2023/1920x1080-teaser/1920x1080_AA6_191023_2.jpg'
        ]
    ],
    [
        'marca' => 'Volvo',
        'model' => 'XC60 T8',
        'an' => 2023,
        'pret' => 62900,
        'kilometraj' => 12500,
        'combustibil' => 'hibrid',
        'cutie_viteze' => 'automata',
        'putere' => '455 CP',
        'capacitate_cilindrica' => '1969 cm³',
        'culoare' => 'Albastru',
        'descriere' => 'Volvo XC60 Recharge T8 Ultimate, plug-in hybrid, interior piele Nappa, pilot assist, sistem audio Bowers & Wilkins, panoramicroof, air suspension. Autonomie electrică 70km.',
        'featured' => 1,
        'imagine' => 'https://apruhonice.s3.eu-central-1.amazonaws.com/87/8787338a-6a56-49be-9f0e-3c9222028ba1.full.jpg',
        'imagini_extra' => [
            'https://www.volvocars.com/images/v/-/media/project/contentplatform/data/media/my23/xc60/features/volvo-xc60-exterior-design-1-1-2.jpg',
            'https://www.volvocars.com/images/v/-/media/project/contentplatform/data/media/my23/xc60/features/volvo-xc60-interior-design-1-1-2.jpg'
        ]
    ],
    [
        'marca' => 'Skoda',
        'model' => 'Superb L&K',
        'an' => 2021,
        'pret' => 27900,
        'kilometraj' => 37800,
        'combustibil' => 'motorina',
        'cutie_viteze' => 'automata',
        'putere' => '190 CP',
        'capacitate_cilindrica' => '1968 cm³',
        'culoare' => 'Maro',
        'descriere' => 'Skoda Superb Laurin & Klement, dotări maxime, scaune ventilate cu masaj, sunroof panoramic, senzori 360°, matrix LED, audio Canton. Cea mai spațioasă mașină din clasa sa.',
        'featured' => 0,
        'imagine' => 'https://media.discordapp.net/attachments/914645674677661736/1441093466984681573/20250702_205622.jpg',
        'imagini_extra' => [
            'https://www.skoda-auto.com/_ipx/w_1920,q_75/%2Fcontent%2Fdam%2Fskoda%2Finternational%2Fmodels%2Fsuperb%2Fsuperb-iv%2Fexterior%2F1920x1080-superb_iv_exterior_01.jpg',
            'https://www.skoda-auto.com/_ipx/w_1920,q_75/%2Fcontent%2Fdam%2Fskoda%2Finternational%2Fmodels%2Fsuperb%2Fsuperb-iv%2Finterior%2F1920x1080-superb_iv_interior_01.jpg'
        ]
    ],
    [
        'marca' => 'Tesla',
        'model' => 'Model Y',
        'an' => 2023,
        'pret' => 53900,
        'kilometraj' => 8900,
        'combustibil' => 'electric',
        'cutie_viteze' => 'automata',
        'putere' => '351 CP',
        'capacitate_cilindrica' => '-',
        'culoare' => 'Alb',
        'descriere' => 'Tesla Model Y Long Range, autonomie 533km, Full Self-Driving Capability, glass roof, accelerare 0-100 în 4.4s, supraveghere Sentry Mode, updates over-the-air. Încărcare supercharger gratuită 1 an.',
        'featured' => 1,
        'imagine' => 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?w=800&h=450&fit=crop',
        'imagini_extra' => [
            'https://www.tesla.com/sites/default/files/images/model-y/model-y-exterior-hero-desktop.jpg',
            'https://www.tesla.com/sites/default/files/images/model-y/model-y-interior-hero-desktop.jpg'
        ]
    ],
    [
        'marca' => 'Porsche',
        'model' => 'Macan S',
        'an' => 2022,
        'pret' => 78900,
        'kilometraj' => 15600,
        'combustibil' => 'benzina',
        'cutie_viteze' => 'automata',
        'putere' => '380 CP',
        'capacitate_cilindrica' => '2995 cm³',
        'culoare' => 'Alb',
        'descriere' => 'Porsche Macan S, PDK, pachet sport chrono, faruri LED Matrix, interior full leather, jante 21", suspensie adaptivă, audio Bose. Mașină cu istoric Porsche perfect.',
        'featured' => 1,
        'imagine' => 'https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=800&h=450&fit=crop',
        'imagini_extra' => [
            'https://www.porsche.com/international/models/macan/macan-models/macan/',
            'https://www.porsche.com/international/models/macan/macan-models/macan-s/'
        ]
    ],
    [
        'marca' => 'Land Rover',
        'model' => 'Range Rover Velar',
        'an' => 2021,
        'pret' => 65900,
        'kilometraj' => 28700,
        'combustibil' => 'motorina',
        'cutie_viteze' => 'automata',
        'putere' => '300 CP',
        'capacitate_cilindrica' => '1997 cm³',
        'culoare' => 'Negru',
        'descriere' => 'Range Rover Velar D300, off-road capabilities, interior premium cu piele Windsor, touch pro duo, air suspension, sistem audio Meridian. Garantie Land Rover până în 2024.',
        'featured' => 0,
        'imagine' => 'https://images.unsplash.com/photo-1553440569-bcc63803a83d?w=800&h=450&fit=crop',
        'imagini_extra' => [
            'https://www.landrover.ro/explore-land-rover/range-rover-velar/design/exterior.html',
            'https://www.landrover.ro/explore-land-rover/range-rover-velar/design/interior.html'
        ]
    ]
];

echo "<div class='info'>🚗 Adăugare mașini premium în baza de date...</div>";

$total_adaugate = 0;
$total_imagini = 0;

// Adaugă mașinile în baza de date
foreach ($masini_premium as $index => $masina) {
    echo "<div style='margin: 10px 0; padding: 10px; background: white; border-radius: 5px; border-left: 4px solid #ff6a00;'>";
    
    // Inserează în tabelul masini
    $sql_masina = "INSERT INTO masini (marca, model, an, pret, kilometraj, combustibil, cutie_viteze, putere, capacitate_cilindrica, culoare, descriere, featured, imagine) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql_masina);
    if (!$stmt) {
        echo "<div class='error'>❌ Eroare pregătire query: " . $conn->error . "</div>";
        continue;
    }
    
    $stmt->bind_param("ssiiissssssis", 
        $masina['marca'], $masina['model'], $masina['an'], 
        $masina['pret'], $masina['kilometraj'], $masina['combustibil'],
        $masina['cutie_viteze'], $masina['putere'], $masina['capacitate_cilindrica'],
        $masina['culoare'], $masina['descriere'], $masina['featured'], $masina['imagine']
    );
    
    if ($stmt->execute()) {
        $masina_id = $conn->insert_id;
        echo "<span class='success'>✅ " . ($index+1) . ". " . $masina['marca'] . " " . $masina['model'] . " (ID: $masina_id) - " . number_format($masina['pret']) . "€</span>";
        $total_adaugate++;
        
        // Adaugă imaginea principală în imagini_masini
        $sql_imagine_principala = "INSERT INTO imagini_masini (masina_id, url_imagine, descriere, este_principala) 
                                   VALUES (?, ?, 'Imagine principală', 1)";
        $stmt_img = $conn->prepare($sql_imagine_principala);
        $stmt_img->bind_param("is", $masina_id, $masina['imagine']);
        if ($stmt_img->execute()) {
            $total_imagini++;
        }
        
        // Adaugă imagini extra
        if (isset($masina['imagini_extra'])) {
            $ordine = 2;
            foreach ($masina['imagini_extra'] as $imagine_extra) {
                $sql_imagine_extra = "INSERT INTO imagini_masini (masina_id, url_imagine, descriere, este_principala, ordine) 
                                      VALUES (?, ?, 'Imagine suplimentară', 0, ?)";
                $stmt_extra = $conn->prepare($sql_imagine_extra);
                $stmt_extra->bind_param("isi", $masina_id, $imagine_extra, $ordine);
                if ($stmt_extra->execute()) {
                    $total_imagini++;
                }
                $ordine++;
            }
        }
        
    } else {
        echo "<span class='error'>❌ Eroare la " . $masina['marca'] . ": " . $stmt->error . "</span>";
    }
    
    echo "</div>";
}

echo "<div class='success' style='font-size: 18px; margin-top: 20px;'>";
echo "🎉 <strong>Operațiune completă cu succes!</strong><br>";
echo "✅ <strong>$total_adaugate mașini</strong> au fost adăugate în baza de date<br>";
echo "📷 <strong>$total_imagini imagini</strong> au fost asociate mașinilor";
echo "</div>";

// Verificare finală
echo "<div class='info' style='margin-top: 20px;'>";
echo "🔍 <strong>Verificare finală:</strong><br>";

$result = $conn->query("SELECT COUNT(*) as total FROM masini");
$row = $result->fetch_assoc();
echo "• Mașini în baza de date: <strong>" . $row['total'] . "</strong><br>";

$result = $conn->query("SELECT COUNT(*) as total FROM imagini_masini");
$row = $result->fetch_assoc();
echo "• Imagini în baza de date: <strong>" . $row['total'] . "</strong><br>";

// Afișează lista mașinilor
$result = $conn->query("SELECT id, marca, model, an, pret FROM masini ORDER BY id");
echo "• Lista mașinilor adăugate:<br>";
echo "<ul>";
while($row = $result->fetch_assoc()) {
    echo "<li>#" . $row['id'] . " - " . $row['marca'] . " " . $row['model'] . " (" . $row['an'] . ") - " . number_format($row['pret']) . "€</li>";
}
echo "</ul>";
echo "</div>";

echo "<div style='text-align: center; margin: 30px 0; padding: 20px; background: linear-gradient(135deg, #ff6a00 0%, #e65e00 100%); color: white; border-radius: 10px;'>";
echo "<h3>🚀 Baza de date este gata!</h3>";
echo "<p>Accesează acum <a href='index.php' style='color: white; text-decoration: underline; font-weight: bold;'>index.php</a> pentru a vedea mașinile premium.</p>";
echo "<p>Sau <a href='detalii.php?id=1' style='color: white; text-decoration: underline; font-weight: bold;'>vezi detalii pentru prima mașină</a></p>";
echo "</div>";

$conn->close();
?>