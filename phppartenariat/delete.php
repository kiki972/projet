<?php
require_once 'database.php';
require_once 'Partenaire.php';

$db = new Database();
$conn = $db->getConnection();
$partenaire = new Partenaire($conn);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($partenaire->delete($_POST['id'])) {
        echo "Partenaire supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du partenaire.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un Partenaire</title>
</head>
<body>
    <form action="delete.php" method="post">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required>
        <br>
        <button type="submit">Supprimer</button>
    </form>
</body>
</html>