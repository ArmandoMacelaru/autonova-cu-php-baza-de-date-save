<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="main-header">
    <div class="header-container">
        <a href="welcome.html" class="logo">AUTONOVA</a>

        <nav class="main-nav">
            <a href="welcome.html">Acasă</a>
            <a href="index.php">Mașini</a>
            <a href="adauga.php">Vinde mașină</a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="cont.php">Contul meu</a>
            <?php else: ?>
                <a href="login.php">Contul meu</a>
            <?php endif; ?>
        </nav>

        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="nav-user">
                <span>Bună, <?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?></span>
                <span>|</span>
                <a href="logout.php">Logout</a>
            </div>
        <?php endif; ?>
    </div>
</header>
