<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoNova - Piața auto nr. 1 din România | Mașini second hand</title>
    <style>
        /* RESET & BASE STYLES */
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

        /* THEME TOGGLE */
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

        /* HEADER */
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

        /* SEARCH */
        .search-section {
            background: var(--bg-secondary);
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .search-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .search-box {
            display: flex;
            gap: 10px;
            max-width: 600px;
            margin: 0 auto;
        }

        .search-box input {
            flex: 1;
            padding: 12px 15px;
            border: 2px solid var(--accent-color);
            border-radius: 8px;
            font-size: 16px;
            background: var(--bg-secondary);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .search-box input::placeholder {
            color: var(--text-muted);
        }

        .search-btn {
            background: var(--accent-color);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }

        .search-btn:hover {
            background: var(--accent-hover);
        }

        /* FILTERS */
        .filters {
            background: var(--bg-secondary);
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .filter-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-select {
            padding: 8px 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background: var(--bg-secondary);
            color: var(--text-primary);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        /* MAIN CONTENT */
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .page-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: var(--text-primary);
            font-weight: 600;
        }

        /* CATALOG GRID */
        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        /* CAR CARD */
        .car-card {
            background: var(--bg-secondary);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px var(--shadow-color);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            border: 1px solid var(--border-color);
        }

        .car-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px var(--shadow-color);
        }

        .car-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: var(--accent-color);
            color: white;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            z-index: 2;
        }

        .car-image {
            width: 100%;
            height: 180px;
            position: relative;
            overflow: hidden;
        }

        .car-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .car-card:hover .car-image img {
            transform: scale(1.05);
        }

        .favorite-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--bg-secondary);
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 2px 5px var(--shadow-color);
            color: var(--text-muted);
            font-size: 16px;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .favorite-btn:hover {
            background: var(--accent-color);
            color: white;
        }

        .car-content {
            padding: 15px;
        }

        .car-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            color: var(--text-primary);
        }

        .car-seller {
            font-size: 12px;
            color: var(--text-secondary);
            margin-bottom: 10px;
        }

        .car-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 15px;
            font-size: 12px;
            color: var(--text-secondary);
        }

        .car-detail {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .car-price {
            font-size: 18px;
            font-weight: bold;
            color: var(--accent-color);
            margin-bottom: 10px;
        }

        .car-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .details-btn {
            background: var(--accent-color);
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.3s;
        }

        .details-btn:hover {
            background: var(--accent-hover);
        }

        .compare-btn {
            background: transparent;
            border: 1px solid var(--border-color);
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s;
            color: var(--text-primary);
        }

        .compare-btn:hover {
            background: var(--bg-primary);
        }

        /* FOOTER */
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

            .catalog-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }

            .filter-container {
                justify-content: center;
            }

            .theme-toggle {
                top: 10px;
                right: 10px;
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <!-- THEME TOGGLE BUTTON -->
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

    <!-- SEARCH SECTION -->
    <section class="search-section">
        <div class="search-container">
            <div class="search-box">
                <input type="text" placeholder="Caută mașină după marcă, model, etc...">
                <button class="search-btn">Caută</button>
            </div>
        </div>
    </section>

    <!-- FILTERS -->
    <section class="filters">
        <div class="filter-container">
            <select class="filter-select">
                <option>Toate mărcile</option>
                <option>Volvo</option>
                <option>Toyota</option>
                <option>BMW</option>
                <option>Mercedes</option>
                <option>Audi</option>
                <option>Volkswagen</option>
                <option>Skoda</option>
                <option>Dacia</option>
            </select>
            <select class="filter-select">
                <option>Toate modelele</option>
            </select>
            <select class="filter-select">
                <option>Anul fabricației</option>
                <option>2020-2024</option>
                <option>2015-2019</option>
            </select>
            <select class="filter-select">
                <option>Preț</option>
                <option>Sub 5.000 €</option>
                <option>5.000 - 10.000 €</option>
                <option>10.000 - 20.000 €</option>
                <option>20.000 - 30.000 €</option>
                <option>Peste 30.000 €</option>
            </select>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <div class="container">
        <h1 class="page-title">Mașini second hand în România</h1>
        
        <div class="catalog-grid">
            <?php
            // === PARTEA PHP - CITIRE DIN BAZA DE DATE ===
            
            // Încearcă să includă config.php
            $config_path = __DIR__ . '/config.php';
            if (file_exists($config_path)) {
                include 'config.php';
            } else {
                // Dacă nu există config.php, creează o conexiune directă
                $conn = new mysqli("localhost", "root", "", "autonova");
            }
            
            // Verifică conexiunea
            if ($conn->connect_error) {
                echo '<div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: #ffe6e6; border-radius: 10px; border: 2px solid #ff6a00;">';
                echo '<h3 style="color: #ff6a00;">⚠️ Eroare la baza de date!</h3>';
                echo '<p style="margin: 10px 0;">Nu mă pot conecta la baza de date.</p>';
                echo '<p style="font-size: 14px; color: #666;">';
                echo 'Verifică dacă:<br>';
                echo '1. Baza de date "autonova" există în phpMyAdmin<br>';
                echo '2. Serverul MySQL rulează în XAMPP<br>';
                echo '3. Ai fișierul config.php în folder';
                echo '</p>';
                echo '</div>';
            } else {
                // Interogare pentru a prelua toate mașinile cu imaginea principală
                $sql = "SELECT m.*, 
                               (SELECT url_imagine FROM imagini_masini 
                                WHERE masina_id = m.id AND este_principala = TRUE LIMIT 1) as imagine_principala
                        FROM masini m 
                        ORDER BY m.an DESC, m.pret ASC";
                
                $result = $conn->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    while($masina = $result->fetch_assoc()) {
                        // Determină badge-ul în funcție de caracteristici
                        $badge = '';
                        if ($masina['featured'] == 1) {
                            $badge = 'NOU';
                        } elseif ($masina['kilometraj'] < 30000) {
                            $badge = 'REDUS';
                        } elseif ($masina['pret'] < 10000) {
                            $badge = 'ECONOMIC';
                        }
                        
                        // Folosește imaginea principală dacă există, altfel cea veche
                        $imagine_afisare = !empty($masina['imagine_principala']) ? 
                                          $masina['imagine_principala'] : $masina['imagine'];
                        
                        // Formatare preț
                        $pret_formatat = number_format($masina['pret'], 0, ',', '.') . ' €';
                        
                        // Generare link detaliu
                        $link_detalii = "detalii.php?id=" . $masina['id'];
                        
                        // Afișează cardul mașinii
                        echo '
                        <div class="car-card">
                            ' . ($badge ? '<div class="car-badge">' . $badge . '</div>' : '') . '
                            <div class="car-image">
                                <img src="' . htmlspecialchars($imagine_afisare) . '" alt="' . htmlspecialchars($masina['marca'] . ' ' . $masina['model']) . '">
                                <button class="favorite-btn">♥</button>
                            </div>
                            <div class="car-content">
                                <h3 class="car-title">' . htmlspecialchars($masina['marca'] . ' ' . $masina['model']) . '</h3>
                                <p class="car-seller">Dealer auto</p>
                                <div class="car-details">
                                    <div class="car-detail">📅 ' . htmlspecialchars($masina['an']) . '</div>
                                    <div class="car-detail">🛣️ ' . number_format($masina['kilometraj'], 0, ',', '.') . ' km</div>
                                    <div class="car-detail">⛽ ' . htmlspecialchars($masina['combustibil']) . '</div>
                                    <div class="car-detail">⚙️ ' . htmlspecialchars($masina['cutie_viteze']) . '</div>
                                </div>
                                <div class="car-price">' . $pret_formatat . '</div>
                                <div class="car-actions">
                                    <a href="' . $link_detalii . '" class="details-btn">Vezi detalii</a>
                                    <button class="compare-btn" data-id="' . $masina['id'] . '">Compară</button>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    // Dacă nu sunt mașini în baza de date
                    echo '<div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: var(--bg-secondary); border-radius: 12px; border: 2px dashed var(--border-color);">';
                    echo '<h3 style="margin-bottom: 15px; color: var(--text-secondary);">🚗 Nu există mașini în baza de date</h3>';
                    echo '<p style="margin-bottom: 20px; color: var(--text-muted);">Adaugă mașini în baza de date sau verifică conexiunea.</p>';
                    echo '<a href="adauga.html" style="background: var(--accent-color); color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none;">➕ Adaugă mașină</a>';
                    echo '</div>';
                }
                
                // Închide conexiunea
                $conn->close();
            }
            // === SFÂRȘIT PARTEA PHP ===
            ?>
        </div>
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

        // === SISTEM NAVIGAȚIE DINAMICĂ ===
        
        // Verifică dacă utilizatorul este logat
        function isLoggedIn() {
            return localStorage.getItem('autonova_current_user') !== null;
        }

        // Obține utilizatorul curent
        function getCurrentUser() {
            return JSON.parse(localStorage.getItem('autonova_current_user'));
        }

        // Actualizează navigația
        function updateNavigation() {
            const loginLink = document.getElementById('loginLink');
            if (loginLink && isLoggedIn()) {
                const user = getCurrentUser();
                loginLink.innerHTML = `Bună, ${user.username} | <a href="logout.html" style="color: white; text-decoration: none;">Logout</a>`;
            }
        }

        // Script pentru butoanele favorite
        document.addEventListener('DOMContentLoaded', function() {
            // Initializează tema
            new ThemeManager();
            
            // Actualizează navigația la încărcarea paginii
            updateNavigation();

            // Funcționalitate pentru butoanele favorite
            const favoriteBtns = document.querySelectorAll('.favorite-btn');
            favoriteBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    this.classList.toggle('active');
                    if (this.classList.contains('active')) {
                        this.style.color = 'red';
                        this.innerHTML = '❤';
                        
                        // Obține numele mașinii
                        const carTitle = this.closest('.car-card').querySelector('.car-title').textContent;
                        alert('❤ ' + carTitle + ' a fost adăugată la favorite!');
                    } else {
                        this.style.color = 'var(--text-muted)';
                        this.innerHTML = '♥';
                    }
                });
            });

            // Căutare simplă
            const searchInput = document.querySelector('.search-box input');
            const searchBtn = document.querySelector('.search-btn');
            const carCards = document.querySelectorAll('.car-card');

            searchBtn.addEventListener('click', function() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                
                if (searchTerm === '') {
                    // Dacă căutarea e goală, arată toate mașinile
                    carCards.forEach(card => {
                        card.style.display = 'block';
                    });
                    return;
                }
                
                let foundAny = false;
                
                carCards.forEach(card => {
                    const title = card.querySelector('.car-title').textContent.toLowerCase();
                    const details = card.querySelector('.car-details').textContent.toLowerCase();
                    
                    if (title.includes(searchTerm) || details.includes(searchTerm)) {
                        card.style.display = 'block';
                        foundAny = true;
                    } else {
                        card.style.display = 'none';
                    }
                });
                
                if (!foundAny) {
                    // Dacă nu s-a găsit nimic
                    const container = document.querySelector('.catalog-grid');
                    if (!container.querySelector('.no-results')) {
                        const noResults = document.createElement('div');
                        noResults.className = 'no-results';
                        noResults.style.gridColumn = '1 / -1';
                        noResults.style.textAlign = 'center';
                        noResults.style.padding = '40px';
                        noResults.style.background = 'var(--bg-secondary)';
                        noResults.style.borderRadius = '12px';
                        noResults.innerHTML = `
                            <h3 style="margin-bottom: 15px; color: var(--text-secondary);">🔍 Nu s-au găsit rezultate</h3>
                            <p style="color: var(--text-muted);">Nu există mașini care să corespundă căutării: "${searchTerm}"</p>
                        `;
                        container.appendChild(noResults);
                    }
                } else {
                    // Șterge mesajul "nu s-au găsit rezultate" dacă există
                    const noResults = document.querySelector('.no-results');
                    if (noResults) {
                        noResults.remove();
                    }
                }
            });

            // Reset search on empty input
            searchInput.addEventListener('input', function() {
                if (this.value === '') {
                    carCards.forEach(card => {
                        card.style.display = 'block';
                    });
                    
                    // Șterge mesajul "nu s-au găsit rezultate" dacă există
                    const noResults = document.querySelector('.no-results');
                    if (noResults) {
                        noResults.remove();
                    }
                }
            });

            // Funcționalitate pentru butoanele de comparare
            const compareBtns = document.querySelectorAll('.compare-btn');
            compareBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const carId = this.getAttribute('data-id');
                    const carTitle = this.closest('.car-card').querySelector('.car-title').textContent;
                    alert('✅ ' + carTitle + ' a fost adăugată la comparație!\n\nPoți compara maximum 3 mașini.');
                });
            });

            console.log('✅ Site-ul AutoNova este încărcat și conectat la baza de date! 🚗💾');
        });
    </script>
</body>
</html>