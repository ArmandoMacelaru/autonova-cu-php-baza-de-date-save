<?php
include 'config.php';

$sql = "SELECT id, marca, model, an, pret FROM masini ORDER BY id";
$result = $conn->query($sql);

echo "<h2>Lista mașinilor din baza de date:</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Marca</th><th>Model</th><th>An</th><th>Preț (€)</th></tr>";

while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['marca'] . "</td>";
    echo "<td>" . $row['model'] . "</td>";
    echo "<td>" . $row['an'] . "</td>";
    echo "<td>" . $row['pret'] . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "<p>Total: " . $result->num_rows . " mașini</p>";

$conn->close();
?>