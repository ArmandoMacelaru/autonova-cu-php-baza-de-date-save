<?php
session_start();
require_once 'config.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare(
        "SELECT id, username, email, password_hash 
         FROM users 
         WHERE email = ? 
         LIMIT 1"
    );
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password_hash'])) {

        // 🔥 AICI ERA PROBLEMA – acum folosim USERUL REAL
        $_SESSION['user_id'] = (int)$user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        header("Location: index.php");
        exit;
    } else {
        $error = "Email sau parolă incorectă!";
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - AutoNova</title>
  <style>
    /* păstrăm stilul tău (am scurtat aici) */
    body { font-family: Arial; background:#f8f9fa; }
    .login-form{ max-width:400px;margin:40px auto;background:#fff;padding:30px;border-radius:12px; }
    .message{ padding:10px;border-radius:6px;margin-bottom:15px;text-align:center;}
    .success{ background:#e8f5e8;color:#2e7d32;border:1px solid #c8e6c9;}
    .error{ background:#ffebee;color:#c62828;border:1px solid #ffcdd2;}
    input{ width:100%;padding:12px;border:1px solid #ddd;border-radius:6px;margin-bottom:12px; }
    button{ width:100%;padding:12px;background:#ff6a00;color:#fff;border:0;border-radius:6px;font-weight:bold;cursor:pointer; }
  </style>
</head>
<body>
  <div class="login-form">
    <?php if (isset($_GET['registered'])): ?>
      <div class="message success">✅ Cont creat! Te poți loga acum.</div>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
      <div class="message error">❌ Email sau parolă incorectă!</div>
    <?php endif; ?>

    <form method="POST" action="login.php">
    <label>Email</label>
    <input type="email" name="email" placeholder="email@exemplu.ro" required>

    <label>Parolă</label>
    <input type="password" name="password" placeholder="Parola" required>

    <button type="submit">Intră în cont</button>
</form>


    <p style="text-align:center;margin-top:12px;">
      <a href="register.php">Nu ai cont? Înregistrează-te</a>
    </p>
  </div>
</body>
</html>
