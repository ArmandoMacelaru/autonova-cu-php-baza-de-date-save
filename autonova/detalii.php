<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoNova - Detalii mașină</title>
    <style>
        /* Copiat din index.html - îți păstrez exact același design */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            font-family: 'Arial', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            transition: all 0.3s ease;
        }

        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: var(--bg-secondary);
            border: 2px solid var(--border-color);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 2px 10px var(--shadow-color);
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
            border-color: var(--accent-color);
        }

        /* HEADER - exact ca în index.php */
        .main-header {
            background: var(--bg-header);
            padding: 15px 0;
            box-shadow: 0 2px 10px var(--shadow-color);
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            color: white;
            font-size: 28px;
            font-weight: bold;
            text-decoration: none;
        }

        .main-nav a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
            font-weight: 500;
        }

        .main-nav a:hover {
            opacity: 0.8;
        }

        /* CONTAINER pentru detalii - ca în paginile tale HTML */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* Stiluri specifice pentru pagina de detalii */
        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 500;
            padding: 8px 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background: var(--bg-secondary);
            transition: all 0.3s;
        }

        .back-btn:hover {
            background: var(--accent-color);
            color: white;
            border-color: var(--accent-color);
        }

        .car-detail-card {
            background: var(--bg-secondary);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 20px var(--shadow-color);
            border: 1px solid var(--border-color);
        }

        /* HEADER cu imagine mare */
        .car-detail-header {
            position: relative;
            height: 400px;
            overflow: hidden;
        }

        .car-detail-header img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease;
        }

        .car-badge-large {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--accent-color);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            z-index: 2;
        }

        .favorite-btn-large {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--bg-secondary);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 2px 10px var(--shadow-color);
            color: var(--text-muted);
            font-size: 20px;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .favorite-btn-large:hover {
            background: var(--accent-color);
            color: white;
        }

        /* CONTENT */
        .car-detail-content {
            padding: 30px;
        }

        .car-title-large {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
            color: var(--text-primary);
        }

        .car-price-large {
            font-size: 28px;
            color: var(--accent-color);
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* GRID pentru specificații */
        .specs-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 30px 0;
            padding: 20px;
            background: var(--bg-primary);
            border-radius: 10px;
            border: 1px solid var(--border-color);
        }

        .spec-item-detail {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: var(--bg-secondary);
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .spec-label {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .spec-value {
            font-weight: bold;
            color: var(--text-primary);
            font-size: 16px;
        }

        /* Descriere */
        .description-box {
            background: var(--bg-primary);
            padding: 25px;
            border-radius: 10px;
            margin: 30px 0;
            border: 1px solid var(--border-color);
        }

        .description-box h3 {
            margin-bottom: 15px;
            font-size: 20px;
            color: var(--text-primary);
        }

        /* GALERIE IMAGINI */
        .image-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
            margin-top: 15px;
        }

        .gallery-thumb {
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid var(--border-color);
            transition: all 0.3s;
        }

        .gallery-thumb:hover {
            border-color: var(--accent-color);
            transform: scale(1.05);
        }

        .gallery-thumb.active {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 2px var(--accent-color);
        }

        .gallery-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Butoane de acțiune */
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-primary {
            background: var(--accent-color);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: var(--accent-hover);
        }

        .btn-secondary {
            background: transparent;
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background: var(--accent-color);
            color: white;
        }

        /* FOOTER - exact ca în index.php */
        .main-footer {
            background: #333;
            color: white;
            padding: 40px 0 20px;
            margin-top: 50px;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .footer-section h3 {
            margin-bottom: 15px;
            font-size: 18px;
        }

        .footer-section a {
            color: #ccc;
            text-decoration: none;
            display: block;
            margin-bottom: 8px;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: #ff6a00;
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            margin-top: 20px;
            border-top: 1px solid #555;
            color: #999;
            font-size: 14px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .specs-grid {
                grid-template-columns: 1fr;
            }
            
            .car-detail-header {
                height: 250px;
            }
            
            .car-title-large {
                font-size: 24px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .image-gallery {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .header-container {
                flex-direction: column;
                gap: 15px;
            }

            .main-nav {
                display: flex;
                gap: 15px;
            }

            .main-nav a {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- THEME TOGGLE -->
    <button class="theme-toggle" id="themeToggle" title="Schimbă tema">
        🌙
    </button>

    <!-- HEADER -->
    <header class="main-header">
        <div class="header-container">
            <a href="welcome.html" class="logo">AUTONOVA</a>
            <nav class="main-nav">
                <a href="welcome.html">Acasă</a>
                <a href="index.php">Mașini</a>
                <a href="adauga.html">Vinde mașină</a>
                <a href="login.html" id="loginLink">Contul meu</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <?php
        // Conexiune la baza de date
        $config_path = __DIR__ . '/config.php';
        if (file_exists($config_path)) {
            include 'config.php';
        } else {
            $conn = new mysqli("localhost", "root", "", "autonova");
        }
        
        // Verifică ID-ul mașinii
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = intval($_GET['id']);
            
            // Preia mașina
            $sql_masina = "SELECT * FROM masini WHERE id = ?";
            $stmt_masina = $conn->prepare($sql_masina);
            $stmt_masina->bind_param("i", $id);
            $stmt_masina->execute();
            $result_masina = $stmt_masina->get_result();
            
            if ($result_masina->num_rows > 0) {
                $masina = $result_masina->fetch_assoc();
                
                // Preia toate imaginile pentru această mașină
                $sql_imagini = "SELECT * FROM imagini_masini 
                               WHERE masina_id = ? 
                               ORDER BY este_principala DESC, ordine ASC";
                $stmt_imagini = $conn->prepare($sql_imagini);
                $stmt_imagini->bind_param("i", $id);
                $stmt_imagini->execute();
                $result_imagini = $stmt_imagini->get_result();
                
                $imagini = array();
                $imagine_principala = $masina['imagine']; // fallback
                
                while($imagine_row = $result_imagini->fetch_assoc()) {
                    $imagini[] = $imagine_row;
                    if ($imagine_row['este_principala'] == 1) {
                        $imagine_principala = $imagine_row['url_imagine'];
                    }
                }
                
                // Dacă nu există imagini în tabelul nou, folosește vechea imagine
                if (empty($imagini)) {
                    $imagini[] = array(
                        'url_imagine' => $masina['imagine'],
                        'descriere' => 'Vedere frontală',
                        'este_principala' => true
                    );
                    $imagine_principala = $masina['imagine'];
                }
                
                // Determină badge-ul
                $badge = '';
                if ($masina['featured'] == 1) {
                    $badge = 'NOU';
                } elseif ($masina['kilometraj'] < 30000) {
                    $badge = 'REDUS';
                } elseif ($masina['pret'] < 10000) {
                    $badge = 'ECONOMIC';
                }
                ?>
                
                <a href="index.php" class="back-btn">← Înapoi la toate mașinile</a>
                
                <div class="car-detail-card">
                    <!-- HEADER cu imaginea principală -->
                    <div class="car-detail-header">
                        <img src="<?php echo htmlspecialchars($imagine_principala); ?>" 
                             id="mainCarImage"
                             alt="<?php echo htmlspecialchars($masina['marca'] . ' ' . $masina['model']); ?>">
                        
                        <?php if ($badge): ?>
                        <div class="car-badge-large"><?php echo $badge; ?></div>
                        <?php endif; ?>
                        
                        <button class="favorite-btn-large">♥</button>
                    </div>
                    
                    <!-- CONTENT -->
                    <div class="car-detail-content">
                        <h1 class="car-title-large"><?php echo htmlspecialchars($masina['marca'] . ' ' . $masina['model']); ?></h1>
                        <div class="car-price-large"><?php echo number_format($masina['pret'], 0, ',', '.'); ?> €</div>
                        
                        <!-- SPECIFICAȚII -->
                        <div class="specs-grid">
                            <div class="spec-item-detail">
                                <span class="spec-label">Marca</span>
                                <span class="spec-value"><?php echo htmlspecialchars($masina['marca']); ?></span>
                            </div>
                            <div class="spec-item-detail">
                                <span class="spec-label">Model</span>
                                <span class="spec-value"><?php echo htmlspecialchars($masina['model']); ?></span>
                            </div>
                            <div class="spec-item-detail">
                                <span class="spec-label">An fabricație</span>
                                <span class="spec-value"><?php echo htmlspecialchars($masina['an']); ?></span>
                            </div>
                            <div class="spec-item-detail">
                                <span class="spec-label">Kilometraj</span>
                                <span class="spec-value"><?php echo number_format($masina['kilometraj'], 0, ',', '.'); ?> km</span>
                            </div>
                            <div class="spec-item-detail">
                                <span class="spec-label">Combustibil</span>
                                <span class="spec-value"><?php echo htmlspecialchars($masina['combustibil']); ?></span>
                            </div>
                            <div class="spec-item-detail">
                                <span class="spec-label">Cutie viteze</span>
                                <span class="spec-value"><?php echo htmlspecialchars($masina['cutie_viteze']); ?></span>
                            </div>
                            <?php if ($masina['putere']): ?>
                            <div class="spec-item-detail">
                                <span class="spec-label">Putere</span>
                                <span class="spec-value"><?php echo htmlspecialchars($masina['putere']); ?> CP</span>
                            </div>
                            <?php endif; ?>
                            <?php if ($masina['capacitate_cilindrica']): ?>
                            <div class="spec-item-detail">
                                <span class="spec-label">Capacitate cilindrică</span>
                                <span class="spec-value"><?php echo htmlspecialchars($masina['capacitate_cilindrica']); ?> cm³</span>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- DESCRIERE -->
                        <div class="description-box">
                            <h3>Descriere</h3>
                            <p><?php 
                                if (!empty($masina['descriere'])) {
                                    echo nl2br(htmlspecialchars($masina['descriere']));
                                } else {
                                    echo 'Această mașină este în stare excelentă, cu istoric complet de service și fără accidente. Perfectă pentru condusul zilnic sau pentru vacanțe.';
                                }
                            ?></p>
                        </div>
                        
                        <!-- GALERIE FOTO -->
                        <?php if (count($imagini) > 0): ?>
                        <div class="description-box">
                            <h3>Galerie foto (<?php echo count($imagini); ?> imagini)</h3>
                            <div class="image-gallery" id="imageGallery">
                                <?php foreach ($imagini as $index => $imagine): ?>
                                <div class="gallery-thumb <?php echo ($imagine['url_imagine'] == $imagine_principala) ? 'active' : ''; ?>" 
                                     onclick="changeMainImage('<?php echo htmlspecialchars($imagine['url_imagine']); ?>', this)"
                                     title="<?php echo htmlspecialchars($imagine['descriere'] ?? 'Imagine ' . ($index + 1)); ?>">
                                    <img src="<?php echo htmlspecialchars($imagine['url_imagine']); ?>" 
                                         alt="<?php echo htmlspecialchars($imagine['descriere'] ?? 'Imagine ' . ($index + 1)); ?>">
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <!-- BUTOANE DE ACȚIUNE -->
                        <div class="action-buttons">
                            <button class="btn-primary" onclick="contactSeller()">
                                📞 Contactează vânzătorul
                            </button>
                            <a href="https://wa.me/40712345678?text=Salut!%20Mă%20interesează%20mașina%20<?php echo urlencode($masina['marca'] . ' ' . $masina['model']); ?>%20de%20pe%20AutoNova" 
                               target="_blank" class="btn-secondary">
                                💬 Mesaj pe WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
                
                <script>
                // Funcție pentru schimbarea imaginii principale
                function changeMainImage(newImageUrl, clickedThumb) {
                    const mainImage = document.getElementById('mainCarImage');
                    
                    // Animație fade out
                    mainImage.style.opacity = '0.5';
                    
                    setTimeout(() => {
                        // Schimbă sursa
                        mainImage.src = newImageUrl;
                        
                        // Animație fade in
                        setTimeout(() => {
                            mainImage.style.opacity = '1';
                        }, 50);
                    }, 200);
                    
                    // Highlight thumb-ul selectat
                    document.querySelectorAll('.gallery-thumb').forEach(thumb => {
                        thumb.classList.remove('active');
                    });
                    clickedThumb.classList.add('active');
                }
                
                // Funcție pentru contact
                function contactSeller() {
                    alert('✅ Vânzătorul va fi contactat în curând!\n\n📞 Telefon: 0722 123 456\n📧 Email: contact@autonova.ro\n\nVă vom contacta în maximum 24 de ore.');
                }
                
                // Funcționalitate pentru butonul favorite
                document.querySelector('.favorite-btn-large').addEventListener('click', function() {
                    this.classList.toggle('active');
                    if (this.classList.contains('active')) {
                        this.style.color = 'red';
                        this.innerHTML = '❤';
                        alert('❤ Mașina a fost adăugată la favorite!');
                    } else {
                        this.style.color = 'var(--text-muted)';
                        this.innerHTML = '♥';
                        alert('💔 Mașina a fost eliminată de la favorite!');
                    }
                });
                </script>
                
                <?php
                $stmt_masina->close();
                $stmt_imagini->close();
            } else {
                // Mașina nu există
                echo '<div style="text-align: center; padding: 50px; background: var(--bg-secondary); border-radius: 12px; margin-top: 50px;">';
                echo '<h2 style="margin-bottom: 20px; color: var(--accent-color);">🚗 Mașina nu a fost găsită</h2>';
                echo '<p style="margin-bottom: 30px; color: var(--text-secondary);">Mașina pe care o căutați nu mai este disponibilă în baza noastră de date.</p>';
                echo '<a href="index.php" class="btn-primary">← Înapoi la mașini</a>';
                echo '</div>';
            }
        } else {
            // ID invalid
            echo '<div style="text-align: center; padding: 50px; background: var(--bg-secondary); border-radius: 12px; margin-top: 50px;">';
            echo '<h2 style="margin-bottom: 20px; color: var(--accent-color);">🔍 Mașină nespecificată</h2>';
            echo '<p style="margin-bottom: 30px; color: var(--text-secondary);">Vă rugăm să selectați o mașină din lista principală pentru a vedea detaliile.</p>';
            echo '<a href="index.php" class="btn-primary">← Vezi toate mașinile</a>';
            echo '</div>';
        }
        
        $conn->close();
        ?>
    </div>

    <!-- FOOTER -->
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
        <div class="copyright">
            &copy; 2024 AutoNova. Toate drepturile rezervate.
        </div>
    </footer>

    <script>
        // === SISTEM TEMA ÎNTUNECATĂ ===
        class ThemeManager {
            constructor() {
                this.currentTheme = localStorage.getItem('autonova_theme') || 'light';
                this.init();
            }

            init() {
                this.applyTheme(this.currentTheme);
                this.attachEventListeners();
            }

            applyTheme(theme) {
                document.documentElement.setAttribute('data-theme', theme);
                localStorage.setItem('autonova_theme', theme);
                this.updateToggleButton(theme);
            }

            toggleTheme() {
                this.currentTheme = this.currentTheme === 'light' ? 'dark' : 'light';
                this.applyTheme(this.currentTheme);
            }

            updateToggleButton(theme) {
                const toggleBtn = document.getElementById('themeToggle');
                if (toggleBtn) {
                    toggleBtn.textContent = theme === 'light' ? '🌙' : '☀️';
                    toggleBtn.title = theme === 'light' ? 'Activează tema întunecată' : 'Activează tema luminoasă';
                }
            }

            attachEventListeners() {
                const toggleBtn = document.getElementById('themeToggle');
                if (toggleBtn) {
                    toggleBtn.addEventListener('click', () => this.toggleTheme());
                }
            }
        }

        // Initialize theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            new ThemeManager();
        });
    </script>
</body>
</html>