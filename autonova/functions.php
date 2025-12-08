<?php
// functions.php - Funcții pentru baza de date

include 'config.php';

function getAllMasini() {
    global $conn;
    $sql = "SELECT * FROM masini ORDER BY an DESC, pret ASC";
    $result = $conn->query($sql);
    
    if (!$result) {
        die("Eroare la interogare: " . $conn->error);
    }
    
    return $result;
}

function getMasinaById($id) {
    global $conn;
    $sql = "SELECT * FROM masini WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    
    return null;
}

function getUniqueMarci() {
    global $conn;
    $sql = "SELECT DISTINCT marca FROM masini ORDER BY marca";
    $result = $conn->query($sql);
    
    $marci = array();
    while($row = $result->fetch_assoc()) {
        $marci[] = $row['marca'];
    }
    
    return $marci;
}
?>