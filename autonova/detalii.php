<?php
include 'header.php';

// === DB CONNECT ===
if (file_exists(__DIR__ . '/config.php')) {
    require_once __DIR__ . '/config.php'; // trebuie să definească $conn = new mysqli(...)
} else {
    $conn = new mysqli("localhost", "root", "", "autonova");
}

if (!isset($conn) || $conn->connect_error) {
    $db_error = true;
} else {
    $db_error = false;
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoNova - Detalii mașină</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }

        :root {
            --bg-primary: #f8f9fa;
            --bg-secondary: #ffffff;
            --bg-header: linear-gradient(135deg, #ff6a00 0%, #e65e00 100%);
            --text-primary: #333333;
            --text-secondary: #666666;
            --text-muted: #999999;
            --border-color: #e0e0e0;
            --shadow-color: rgba(0,0,0,0.1);
            --accent-color: #ff6a00;
            --accent-hover: #e65e00;
        }

        [data-theme="dark"] {
            --bg-primary: #1a1a1a;
            --bg-secondary: #2d2d2d;
            --bg-header: linear-gradient(135deg, #ff6a00 0%, #e65e00 100%);
            --text-primary: #ffffff;
            --text-secondary: #cccccc;
            --text-muted: #888888;
            --border-color: #404040;
            --shadow-color: rgba(0,0,0,0.3);
            --accent-color: #ff6a00;
            --accent-hover: #e65e00;
        }

        body {
            font-family: Arial, sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            transition: all .3s ease;
        }

        /* THEME TOGGLE */
        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999; /* important */
            background: var(--bg-secondary);
            border: 2px solid var(--border-color);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            cursor: pointer;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size: 20px;
            box-shadow: 0 2px 10px var(--shadow-color);
            transition: transform .2s ease, border-color .2s ease;
            user-select: none;
        }
        .theme-toggle:hover { transform: scale(1.08); border-color: var(--accent-color); }

        /* HEADER */
        .main-header {
            background: var(--bg-header);
            padding: 15px 0;
            box-shadow: 0 2px 10px var(--shadow-color);
        }
        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display:flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            gap: 12px;
        }
        .logo { color:#fff; font-size:28px; font-weight:700; text-decoration:none; }
        .main-nav { display:flex; align-items:center; gap:18px; flex-wrap: wrap; }
        .main-nav a {
            color:#fff;
            text-decoration:none;
            font-weight:500;
            opacity: .95;
        }
        .main-nav a:hover { opacity:.8; }

        .nav-user {
            color:#fff;
            font-weight:600;
            display:flex;
            gap:10px;
            align-items:center;
            white-space: nowrap;
        }
        .nav-user a { color:#fff; text-decoration:none; font-weight:700; }
        .nav-user a:hover { opacity:.85; }

        /* CONTAINER */
        .container { max-width:1200px; margin: 30px auto; padding: 0 20px; }

        .back-btn {
            display:inline-block;
            margin-bottom: 20px;
            color: var(--accent-color);
            text-decoration:none;
            font-weight:600;
            padding: 8px 14px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--bg-secondary);
            transition: all .2s ease;
        }
        .back-btn:hover { background: var(--accent-color); color:#fff; border-color: var(--accent-color); }

        .car-detail-card {
            background: var(--bg-secondary);
            border-radius: 12px;
            overflow:hidden;
            box-shadow: 0 2px 20px var(--shadow-color);
            border: 1px solid var(--border-color);
        }

        .car-detail-header {
            position: relative;
            height: 400px;
            overflow:hidden;
        }
        .car-detail-header img {
            width:100%;
            height:100%;
            object-fit: cover;
            transition: opacity .25s ease;
        }

        .car-badge-large{
            position:absolute;
            top:20px; left:20px;
            background: var(--accent-color);
            color:#fff;
            padding: 8px 18px;
            border-radius: 20px;
            font-weight: 800;
            font-size: 14px;
        }

        .favorite-btn-large {
            position:absolute;
            top:20px; right:20px;
            background: var(--bg-secondary);
            border:none;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            cursor:pointer;
            box-shadow: 0 2px 10px var(--shadow-color);
            color: var(--text-muted);
            font-size: 20px;
            transition: all .2s ease;
        }
        .favorite-btn-large:hover { background: var(--accent-color); color:#fff; }

        .car-detail-content { padding: 30px; }
        .car-title-large { font-size: 32px; font-weight: 800; margin-bottom: 10px; }
        .car-price-large { font-size: 28px; font-weight: 900; color: var(--accent-color); margin-bottom: 20px; }

        .specs-grid {
            display:grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin: 22px 0 10px;
            padding: 18px;
            background: var(--bg-primary);
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }
        .spec-item-detail{
            display:flex;
            justify-content: space-between;
            align-items:center;
            gap: 10px;
            padding: 14px;
            background: var(--bg-secondary);
            border-radius: 10px;
            border: 1px solid var(--border-color);
        }
        .spec-label { color: var(--text-secondary); font-size: 14px; }
        .spec-value { font-weight: 800; font-size: 16px; }

        .description-box{
            background: var(--bg-primary);
            padding: 22px;
            border-radius: 12px;
            margin: 22px 0;
            border: 1px solid var(--border-color);
        }
        .description-box h3 { margin-bottom: 12px; font-size: 20px; }

        .image-gallery{
            display:grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
            margin-top: 14px;
        }
        .gallery-thumb{
            height: 80px;
            border-radius: 10px;
            overflow:hidden;
            cursor:pointer;
            border: 2px solid var(--border-color);
            transition: transform .2s ease, border-color .2s ease;
        }
        .gallery-thumb:hover { border-color: var(--accent-color); transform: scale(1.04); }
        .gallery-thumb.active { border-color: var(--accent-color); box-shadow: 0 0 0 2px var(--accent-color); }
        .gallery-thumb img { width:100%; height:100%; object-fit: cover; }

        .action-buttons{ display:flex; gap: 14px; margin-top: 18px; flex-wrap: wrap; }
        .btn-primary{
            background: var(--accent-color);
            color:#fff;
            padding: 14px 24px;
            border:none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 900;
            cursor:pointer;
            text-decoration:none;
            display:inline-flex;
            align-items:center;
            gap:10px;
        }
        .btn-primary:hover { background: var(--accent-hover); }
        .btn-secondary{
            background: transparent;
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
            padding: 14px 24px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 900;
            cursor:pointer;
            text-decoration:none;
            display:inline-flex;
            align-items:center;
            gap:10px;
        }
        .btn-secondary:hover { background: var(--accent-color); color:#fff; }

        /* FOOTER */
        .main-footer{
            background:#333;
            color:#fff;
            padding: 40px 0 20px;
            margin-top: 50px;
        }
        .footer-container{
            max-width:1200px;
            margin: 0 auto;
            padding: 0 20px;
            display:grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        .footer-section h3{ margin-bottom: 12px; font-size: 18px; }
        .footer-section a{
            color:#ccc;
            text-decoration:none;
            display:block;
            margin-bottom: 8px;
        }
        .footer-section a:hover{ color: #ff6a00; }
        .copyright{
            text-align:center;
            padding-top: 20px;
            margin-top: 20px;
            border-top: 1px solid #555;
            color:#999;
            font-size: 14px;
        }

        @media (max-width: 768px){
            .header-container{ flex-direction: column; align-items:flex-start; }
            .specs-grid{ grid-template-columns: 1fr; }
            .car-detail-header{ height: 250px; }
            .car-title-large{ font-size: 24px; }
        }
    </style>
</head>
<body>

<button class="theme-toggle" id="themeToggle" title="Schimbă tema">🌙</button>

<div class="container">
<?php
if ($db_error) {
    echo '<div class="description-box">';
    echo '<h3 style="color:var(--accent-color)">⚠️ Eroare la baza de date</h3>';
    echo '<p>Nu mă pot conecta la MySQL. Pornește MySQL din XAMPP și verifică datele din config.php.</p>';
    echo '</div>';
} else {

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo '<div class="description-box">';
        echo '<h3 style="color:var(--accent-color)">🔍 Mașină nespecificată</h3>';
        echo '<p>Selectează o mașină din lista principală.</p>';
        echo '<a href="index.php" class="btn-primary">← Vezi toate mașinile</a>';
        echo '</div>';
    } else {
        $id = (int)$_GET['id'];

        // Salvează mașina ca "vizionată" (doar dacă user-ul e logat)
        if (isset($_SESSION['user_id'])) {
            if ($stmtV = $conn->prepare("
                INSERT INTO vizualizari (user_id, masina_id, viewed_at)
                VALUES (?, ?, NOW())
                ON DUPLICATE KEY UPDATE viewed_at = NOW()
            ")) {
                $uid = (int)$_SESSION['user_id'];
                $stmtV->bind_param("ii", $uid, $id);
                $stmtV->execute();
                $stmtV->close();
            }
        }

        // Mașina
        $stmt = $conn->prepare("SELECT * FROM masini WHERE id = ? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $masinaRes = $stmt->get_result();

        if ($masinaRes->num_rows === 0) {
            echo '<div class="description-box">';
            echo '<h3 style="color:var(--accent-color)">🚗 Mașina nu a fost găsită</h3>';
            echo '<p>Mașina nu mai este disponibilă.</p>';
            echo '<a href="index.php" class="btn-primary">← Înapoi la mașini</a>';
            echo '</div>';
        } else {
            $masina = $masinaRes->fetch_assoc();

            // Imagini
            $imagini = [];
            $imagine_principala = $masina['imagine'] ?? '';

            if ($stmtImg = $conn->prepare("SELECT url_imagine, descriere, este_principala, ordine
                                           FROM imagini_masini
                                           WHERE masina_id = ?
                                           ORDER BY este_principala DESC, ordine ASC")) {
                $stmtImg->bind_param("i", $id);
                $stmtImg->execute();
                $imgRes = $stmtImg->get_result();

                while ($row = $imgRes->fetch_assoc()) {
                    $imagini[] = $row;
                    if ((int)$row['este_principala'] === 1) {
                        $imagine_principala = $row['url_imagine'];
                    }
                }
                $stmtImg->close();
            }

            if (empty($imagini) && !empty($imagine_principala)) {
                $imagini[] = [
                    'url_imagine' => $imagine_principala,
                    'descriere' => 'Imagine',
                    'este_principala' => 1,
                    'ordine' => 0
                ];
            }

            // Badge
            $badge = '';
            if (!empty($masina['featured']) && (int)$masina['featured'] === 1) $badge = 'NOU';
            else if (!empty($masina['kilometraj']) && (int)$masina['kilometraj'] < 30000) $badge = 'REDUS';
            else if (!empty($masina['pret']) && (int)$masina['pret'] < 10000) $badge = 'ECONOMIC';

            echo '<a href="index.php" class="back-btn">← Înapoi la toate mașinile</a>';
            ?>
            <div class="car-detail-card">
                <div class="car-detail-header">
                    <img
                        src="<?php echo htmlspecialchars($imagine_principala); ?>"
                        id="mainCarImage"
                        alt="<?php echo htmlspecialchars(($masina['marca'] ?? '') . ' ' . ($masina['model'] ?? '')); ?>"
                    >
                    <?php if ($badge): ?>
                        <div class="car-badge-large"><?php echo $badge; ?></div>
                    <?php endif; ?>
                    <button class="favorite-btn-large" type="button" id="favBtn">♥</button>
                </div>

                <div class="car-detail-content">
                    <h1 class="car-title-large">
                        <?php echo htmlspecialchars(($masina['marca'] ?? '') . ' ' . ($masina['model'] ?? '')); ?>
                    </h1>

                    <div class="car-price-large">
                        <?php echo number_format((float)($masina['pret'] ?? 0), 0, ',', '.'); ?> €
                    </div>

                    <div class="specs-grid">
                        <div class="spec-item-detail"><span class="spec-label">Marca</span><span class="spec-value"><?php echo htmlspecialchars($masina['marca'] ?? ''); ?></span></div>
                        <div class="spec-item-detail"><span class="spec-label">Model</span><span class="spec-value"><?php echo htmlspecialchars($masina['model'] ?? ''); ?></span></div>
                        <div class="spec-item-detail"><span class="spec-label">An fabricație</span><span class="spec-value"><?php echo htmlspecialchars($masina['an'] ?? ''); ?></span></div>
                        <div class="spec-item-detail"><span class="spec-label">Kilometraj</span><span class="spec-value"><?php echo number_format((float)($masina['kilometraj'] ?? 0), 0, ',', '.'); ?> km</span></div>
                        <div class="spec-item-detail"><span class="spec-label">Combustibil</span><span class="spec-value"><?php echo htmlspecialchars($masina['combustibil'] ?? ''); ?></span></div>
                        <div class="spec-item-detail"><span class="spec-label">Cutie viteze</span><span class="spec-value"><?php echo htmlspecialchars($masina['cutie_viteze'] ?? ''); ?></span></div>

                        <?php if (!empty($masina['putere'])): ?>
                            <div class="spec-item-detail"><span class="spec-label">Putere</span><span class="spec-value"><?php echo htmlspecialchars($masina['putere']); ?> CP</span></div>
                        <?php endif; ?>
                        <?php if (!empty($masina['capacitate_cilindrica'])): ?>
                            <div class="spec-item-detail"><span class="spec-label">Capacitate cilindrică</span><span class="spec-value"><?php echo htmlspecialchars($masina['capacitate_cilindrica']); ?> cm³</span></div>
                        <?php endif; ?>
                    </div>

                    <div class="description-box">
                        <h3>Descriere</h3>
                        <p>
                            <?php
                            if (!empty($masina['descriere'])) echo nl2br(htmlspecialchars($masina['descriere']));
                            else echo 'Această mașină este în stare excelentă, cu istoric complet de service.';
                            ?>
                        </p>
                    </div>

                    <?php if (!empty($imagini)): ?>
                        <div class="description-box">
                            <h3>Galerie foto (<?php echo count($imagini); ?> imagini)</h3>
                            <div class="image-gallery" id="imageGallery">
                                <?php foreach ($imagini as $idx => $img): 
                                    $url = $img['url_imagine'] ?? '';
                                    $desc = $img['descriere'] ?? ('Imagine ' . ($idx + 1));
                                    $active = ($url === $imagine_principala) ? 'active' : '';
                                ?>
                                    <div class="gallery-thumb <?php echo $active; ?>"
                                         data-url="<?php echo htmlspecialchars($url); ?>"
                                         title="<?php echo htmlspecialchars($desc); ?>">
                                        <img src="<?php echo htmlspecialchars($url); ?>"
                                             alt="<?php echo htmlspecialchars($desc); ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="action-buttons">
                        <button class="btn-primary" type="button" id="contactBtn">📞 Contactează vânzătorul</button>
                        <a class="btn-secondary"
                           target="_blank"
                           href="https://wa.me/40712345678?text=Salut!%20Mă%20interesează%20mașina%20<?php echo urlencode(($masina['marca'] ?? '') . ' ' . ($masina['model'] ?? '')); ?>%20de%20pe%20AutoNova">
                           💬 Mesaj pe WhatsApp
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }

        $stmt->close();
    }

    $conn->close();
}
?>
</div>

<footer class="main-footer">
    <div class="footer-container">
        <div class="footer-section">
            <h3>Despre AutoNova</h3>
            <a href="#">Cine suntem</a>
            <a href="#">Cum cumpăr</a>
            <a href="#">Cum vând</a>
            <a href="#">Contact</a>
        </div>
        <div class="footer-section">
            <h3>Ajutor</h3>
            <a href="#">Întrebări frecvente</a>
            <a href="#">Termeni și condiții</a>
            <a href="#">Politica de confidențialitate</a>
        </div>
        <div class="footer-section">
            <h3>Social</h3>
            <a href="#">Facebook</a>
            <a href="#">Instagram</a>
            <a href="#">YouTube</a>
        </div>
    </div>
    <div class="copyright">&copy; 2024 AutoNova. Toate drepturile rezervate.</div>
</footer>

<script>
/* ===== THEME ===== */
class ThemeManager {
  constructor() {
    this.currentTheme = localStorage.getItem('autonova_theme') || 'light';
  }
  applyTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('autonova_theme', theme);
    const btn = document.getElementById('themeToggle');
    if (btn) {
      btn.textContent = theme === 'light' ? '🌙' : '☀️';
      btn.title = theme === 'light' ? 'Activează tema întunecată' : 'Activează tema luminoasă';
    }
  }
  toggle() {
    this.currentTheme = (this.currentTheme === 'light') ? 'dark' : 'light';
    this.applyTheme(this.currentTheme);
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const theme = new ThemeManager();
  theme.applyTheme(theme.currentTheme);

  const toggleBtn = document.getElementById('themeToggle');
  if (toggleBtn) {
    toggleBtn.addEventListener('click', () => theme.toggle());
  }

  // Galerie
  const mainImg = document.getElementById('mainCarImage');
  document.querySelectorAll('.gallery-thumb').forEach(thumb => {
    thumb.addEventListener('click', () => {
      const url = thumb.getAttribute('data-url');
      if (!url || !mainImg) return;

      mainImg.style.opacity = '0.5';
      setTimeout(() => {
        mainImg.src = url;
        setTimeout(() => mainImg.style.opacity = '1', 50);
      }, 150);

      document.querySelectorAll('.gallery-thumb').forEach(t => t.classList.remove('active'));
      thumb.classList.add('active');
    });
  });

  // Favorite
  const favBtn = document.getElementById('favBtn');
  if (favBtn) {
    favBtn.addEventListener('click', () => {
      favBtn.classList.toggle('active');
      if (favBtn.classList.contains('active')) {
        favBtn.style.color = 'red';
        favBtn.textContent = '❤';
        alert('❤ Mașina a fost adăugată la favorite!');
      } else {
        favBtn.style.color = 'var(--text-muted)';
        favBtn.textContent = '♥';
        alert('💔 Mașina a fost eliminată de la favorite!');
      }
    });
  }

  // Contact
  const contactBtn = document.getElementById('contactBtn');
  if (contactBtn) {
    contactBtn.addEventListener('click', () => {
      alert('✅ Vânzătorul va fi contactat în curând!\n\n📞 Telefon: 0722 123 456\n📧 Email: contact@autonova.ro');
    });
  }
});
</script>

</body>
</html>
