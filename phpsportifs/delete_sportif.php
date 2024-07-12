<?php
include_once 'Database.php';
include_once 'Sportif.php';

$database = new Database();
$db = $database->connect();

$sportif = new Sportif($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sportif->ID_sportif = $_POST['ID_sportif'];

    if ($sportif->delete()) {
        echo "Sportif supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du sportif.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un Sportif</title>
</head>
<body>
    <form method="POST">
        <label for="ID_sportif">ID Sportif:</label>
        <input type="text" name="ID_sportif" id="ID_sportif" required><br>
        <button type="submit">Supprimer</button>
    </form>
</body>
</html>