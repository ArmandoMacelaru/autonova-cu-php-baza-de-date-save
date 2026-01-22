<?php
// config.php - Configurare baza de date

// Setări pentru conexiunea la MySQL
$host = "localhost";      // Serverul (de obicei localhost pe XAMPP)
$username = "root";       // Utilizatorul (default root pe XAMPP)
$password = "";           // Parola (lasă gol pentru XAMPP)
$dbname = "autonova";     // Numele bazei de date pe care ai creat-o

// Încearcă să creeze conexiunea
$conn = new mysqli($host, $username, $password, $dbname);

// Verifică dacă conexiunea a reușit
if ($conn->connect_error) {
    die("Eroare la conectarea la baza de date: " . $conn->connect_error . 
        "<br>Verifică:<br>
        1. Baza de date 'autonova' există?<br>
        2. Utilizatorul și parola sunt corecte?<br>
        3. Serverul MySQL rulează?");
}

// Setează encoding-ul la UTF-8 (recomandat utf8mb4) pentru caractere românești
$conn->set_charset("utf8mb4");

// IMPORTANT: Nu afișa nimic din config.php.
// Orice output (chiar și un comentariu HTML) poate strica redirect-urile cu header().
?>