<?php
include_once 'Database.php';
include_once 'Sportif.php';

$database = new Database();
$db = $database->connect();

$sportif = new Sportif($db);
$result = $sportif->read();

$num = $result->rowCount();

if ($num > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Biographie</th><th>Palmarès</th><th>Date de création</th></tr>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        echo "<tr>";
        echo "<td>{$ID_sportif}</td>";
        echo "<td>{$Nom}</td>";
        echo "<td>{$Prénom}</td>";
        echo "<td>{$Biographie}</td>";
        echo "<td>{$Palmarès}</td>";
        echo "<td>{$Date_creation}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Aucun sportif trouvé.";
}
?>