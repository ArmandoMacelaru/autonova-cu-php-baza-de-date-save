<?php
// adauga.php - Formular pentru vânzare mașină
session_start();
require_once 'config.php';

// Verifică dacă utilizatorul este logat
$isLoggedIn = isset($_SESSION['user_id']) || isset($_COOKIE['autonova_user']);

// Mesaje (vin din redirect-ul din masina_save.php)
$success_message = null;
$error_message = null;

if (isset($_GET['success']) && $_GET['success'] === '1') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    $success_message = $id > 0
        ? "✅ Anunțul tău a fost publicat cu succes! ID mașină: #{$id}"
        : "✅ Anunțul tău a fost publicat cu succes!";

    // Redirect automat după 3 secunde către index
    header("Refresh: 3; url=index.php");
}

if (isset($_GET['error'])) {
    // Nu afișăm erori tehnice brute către user.
    $error_message = "❌ Nu s-a putut publica anunțul. Verifică datele și încearcă din nou.";
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinde Mașină - AutoNova</title>
    <style>
        /* Folosind stilurile din index.php pentru consistență */
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

        /* MAIN CONTENT */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .page-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: var(--text-primary);
            font-weight: 600;
        }

        /* FORM STYLES */
        .form-container {
            background: var(--bg-secondary);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 20px var(--shadow-color);
            border: 1px solid var(--border-color);
            max-width: 800px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 16px;
            background: var(--bg-secondary);
            color: var(--text-primary);
            transition: border 0.3s;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            outline: none;
        }

        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-col {
            flex: 1;
        }

        .btn {
            background: var(--accent-color);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: background 0.3s;
        }

        .btn:hover {
            background: var(--accent-hover);
        }

        .btn-block {
            display: block;
            width: 100%;
            padding: 15px;
            font-size: 18px;
            margin-top: 20px;
        }

        /* MESSAGE STYLES */
        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .message.success {
            background: #e8f5e8;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        .message.error {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }

        .message.info {
            background: #e3f2fd;
            color: #1565c0;
            border: 1px solid #bbdefb;
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

        /* TIPS BOX */
        .tips-box {
            background: var(--bg-secondary);
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
            border: 1px solid var(--border-color);
            border-left: 4px solid var(--accent-color);
        }

        .tips-box h4 {
            color: var(--accent-color);
            margin-bottom: 10px;
        }

        .tips-box ul {
            padding-left: 20px;
        }

        .tips-box li {
            margin-bottom: 5px;
            color: var(--text-secondary);
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

            .form-row {
                flex-direction: column;
                gap: 0;
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
            <a href="index.php" class="logo">AUTONOVA</a>
            <nav class="main-nav">
                <a href="index.php">Mașini</a>
                <a href="adauga.php" style="background: rgba(255,255,255,0.2); padding: 5px 10px; border-radius: 5px;">Vinde mașină</a>
                <a href="login.php" id="loginLink">Contul meu</a>
            </nav>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <div class="container">
        <h1 class="page-title">🏁 Vinde mașina ta pe AutoNova</h1>
        
        <?php if (!empty($success_message)): ?>
            <div class="message success">
                <?php echo htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8'); ?>
                <p>Redirecționare către pagina principală în 3 secunde...</p>
            </div>
        <?php elseif (!empty($error_message)): ?>
            <div class="message error">
                <?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
        
        <div class="form-container">
            <?php if (!$isLoggedIn): ?>
                <div class="message info">
                    <strong>💡 Sfat:</strong> Pentru o experiență mai bună, 
                    <a href="login.php" style="color: #1565c0; font-weight: bold;">conectează-te</a> 
                    sau 
                    <a href="register.php" style="color: #1565c0; font-weight: bold;">înregistrează-te</a>.
                    Poți publica anunț și fără cont.
                </div>
            <?php endif; ?>
            
            <form id="add-car-form" method="POST" action="masina_save.php">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="make">Marca *</label>
                            <input type="text" id="make" name="make" class="form-control" required 
                                   placeholder="ex: BMW, Audi, Mercedes">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="model">Model *</label>
                            <input type="text" id="model" name="model" class="form-control" required 
                                   placeholder="ex: Seria 3, A4, E-Class">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="year">An de fabricație *</label>
                            <input type="number" id="year" name="year" class="form-control" 
                                   min="1990" max="2024" required placeholder="ex: 2021">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="price">Preț (€) *</label>
                            <input type="number" id="price" name="price" class="form-control" 
                                   min="0" step="100" required placeholder="ex: 15000">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="fuel">Combustibil *</label>
                            <select id="fuel" name="fuel" class="form-control" required>
                                <option value="">Selectează combustibilul</option>
                                <option value="benzina">Benzină</option>
                                <option value="motorina">Motorină</option>
                                <option value="gpl">GPL</option>
                                <option value="hibrid">Hibrid</option>
                                <option value="electric">Electric</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="transmission">Transmisie *</label>
                            <select id="transmission" name="transmission" class="form-control" required>
                                <option value="">Selectează transmisia</option>
                                <option value="manual">Manuală</option>
                                <option value="automata">Automată</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="mileage">Kilometraj (km) *</label>
                            <input type="number" id="mileage" name="mileage" class="form-control" 
                                   min="0" required placeholder="ex: 45000">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="color">Culoare *</label>
                            <input type="text" id="color" name="color" class="form-control" required 
                                   placeholder="ex: Alb, Negru, Gri">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Descriere detaliată *</label>
                    <textarea id="description" name="description" class="form-control" rows="4" required
                              placeholder="Descrie starea mașinii, dotările, istoricul de service, accidente (dacă au existat), motivele vânzării..."></textarea>
                    <small style="color: var(--text-muted);">O descriere detaliată crește șansele de vânzare!</small>
                </div>

                <div class="form-group">
                    <label for="images">Imagini (URL-uri separate prin virgulă)</label>
                    <textarea id="images" name="images" class="form-control" rows="2" 
                              placeholder="https://example.com/image1.jpg, https://example.com/image2.jpg"></textarea>
                    <small style="color: var(--text-muted);">
                        💡 Pentru imagini gratuite, folosește: 
                        <a href="https://imgur.com" target="_blank">Imgur</a>, 
                        <a href="https://postimages.org" target="_blank">PostImages</a> sau
                        <a href="https://unsplash.com" target="_blank">Unsplash</a>
                    </small>
                </div>

                <div class="form-group">
                    <label for="contact">Date de contact *</label>
                    <input type="text" id="contact" name="contact" class="form-control" required 
                           placeholder="Telefon (ex: 0722 123 456) sau Email">
                    <small style="color: var(--text-muted);">Aceste date vor fi afișate public în anunț.</small>
                </div>

                <button type="submit" class="btn btn-block">🚀 Publică Anunțul</button>
            </form>
        </div>

        <div class="tips-box">
            <h4>📝 Sfaturi pentru un anunț perfect:</h4>
            <ul>
                <li><strong>✔️ Fotografii de calitate:</strong> Minimum 3-4 imagini (exterior, interior, motor, documente)</li>
                <li><strong>✔️ Descriere detaliată:</strong> Menționează toate dotările și starea reală a mașinii</li>
                <li><strong>✔️ Preț realist:</strong> Verifică prețul pe piață pentru modele similare</li>
                <li><strong>✔️ Informații complete:</strong> Kilometraj real, istoric service, accidente (dacă au existat)</li>
                <li><strong>✔️ Răspuns rapid:</strong> Fii disponibil la telefon/email pentru potențialii cumpărători</li>
            </ul>
            <p style="margin-top: 10px; color: var(--accent-color); font-weight: bold;">
                ⭐ Anunțurile bine făcute se vând mai repede cu până la 70%!
            </p>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="main-footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>Despre AutoNova</h3>
                <a href="#">Cine suntem</a>
                <a href="#">Cum cumpăr</a>
                <a href="adauga.php">Cum vând</a>
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

        // === VALIDARE FORMULAR ===
        document.getElementById('add-car-form').addEventListener('submit', function(e) {
            const year = document.getElementById('year').value;
            const price = document.getElementById('price').value;
            const mileage = document.getElementById('mileage').value;
            const currentYear = new Date().getFullYear();
            
            if (year < 1990 || year > currentYear) {
                alert(`Anul trebuie să fie între 1990 și ${currentYear}`);
                e.preventDefault();
                return false;
            }
            
            if (price < 0 || price > 1000000) {
                alert('Prețul trebuie să fie între 0 și 1.000.000€');
                e.preventDefault();
                return false;
            }
            
            if (mileage < 0 || mileage > 1000000) {
                alert('Kilometrajul trebuie să fie între 0 și 1.000.000 km');
                e.preventDefault();
                return false;
            }
            
            // Confirmare înainte de trimitere
            if (!confirm('Ești sigur că vrei să publici acest anunț?\nDatele vor fi vizibile public.')) {
                e.preventDefault();
                return false;
            }
            
            return true;
        });

        // Auto-completează câteva exemple pentru testare
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize theme
            new ThemeManager();
            
            // Dacă vrei să setezi valori de test (opțional)
            if (window.location.href.includes('test=true')) {
                document.getElementById('make').value = 'BMW';
                document.getElementById('model').value = 'Seria 3';
                document.getElementById('year').value = '2020';
                document.getElementById('price').value = '25000';
                document.getElementById('mileage').value = '45000';
                document.getElementById('color').value = 'Alb';
                document.getElementById('fuel').value = 'motorina';
                document.getElementById('transmission').value = 'automata';
                document.getElementById('description').value = 'Mașină în stare perfectă, întreținută la reprezentantă, fără accidente. Dotări: navigație, camera, senzori, piele.';
                document.getElementById('images').value = 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&h=450&fit=crop';
                document.getElementById('contact').value = '0722 123 456';
            }
            
            console.log('✅ Formularul de vânzare mașină este gata!');
        });
    </script>
</body>
</html>
