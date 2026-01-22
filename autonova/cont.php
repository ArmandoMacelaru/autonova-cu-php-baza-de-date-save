<?php
session_start();

// dacă nu e logat → login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Contul meu - AutoNova</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .box {
            max-width: 500px;
            margin: 60px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            margin: 10px 0;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #ff6a00;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>👤 Contul meu</h2>

    <p><strong>Username:</strong> <?= htmlspecialchars($_SESSION['username']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email']) ?></p>

    <a href="index.php">⬅ Înapoi la site</a>
    <a href="logout.php">🚪 Logout</a>
</div>

</body>
</html>
