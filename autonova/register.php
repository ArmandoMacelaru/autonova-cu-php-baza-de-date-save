<?php
session_start();
require_once 'config.php';

// DEBUG (poți lăsa, nu strică)
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = null;
$success = null;

// IMPORTANT: NU redirecționăm pe GET. Doar afișăm formularul.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $email === '' || $password === '') {
        $error = "Completează toate câmpurile.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email invalid.";
    } else {

        // verifică dacă tabela users există
        $test = $conn->query("SHOW TABLES LIKE 'users'");
        if (!$test || $test->num_rows === 0) {
            $error = "Tabela 'users' nu există. Importă SQL-ul pentru users în phpMyAdmin.";
        } else {

            // verifică dacă email-ul există deja
            $check = $conn->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
            $check->bind_param("s", $email);
            $check->execute();
            $exists = $check->get_result()->fetch_assoc();

            if ($exists) {
                $error = "Email-ul există deja.";
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
                if (!$stmt) {
                    $error = "Eroare SQL prepare: " . $conn->error;
                } else {
                    $stmt->bind_param("sss", $username, $email, $hash);
                    $stmt->execute();

                    // Succes: redirect către login o singură dată
                    header("Location: login.php?registered=1");
                    exit;
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AutoNova</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f8f9fa; color:#333; }
        .container { max-width: 900px; margin: 30px auto; padding: 0 20px; }
        .box { max-width: 420px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px;
               box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        label { display:block; margin: 10px 0 6px; font-weight:bold; }
        input { width:100%; padding:12px 15px; border:1px solid #ddd; border-radius:6px; font-size:16px; }
        button { width:100%; margin-top:16px; padding:12px; background:#ff6a00; color:white; border:0;
                 border-radius:6px; font-weight:bold; cursor:pointer; }
        .msg { padding:10px; border-radius:6px; margin-bottom:15px; text-align:center; }
        .error { background:#ffebee; color:#c62828; border:1px solid #ffcdd2; }
        .link { text-align:center; margin-top:12px; }
        .link a { color:#ff6a00; text-decoration:none; font-weight:600; }
    </style>
</head>
<body>
<div class="container">
    <h2 style="text-align:center;">Înregistrare</h2>
    <div class="box">
        <?php if ($error): ?>
            <div class="msg error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Parolă</label>
            <input type="password" name="password" required>

            <button type="submit">Creează cont</button>
        </form>

        <div class="link">
            <a href="login.php">Ai deja cont? Autentifică-te</a>
        </div>
    </div>
</div>
</body>
</html>
