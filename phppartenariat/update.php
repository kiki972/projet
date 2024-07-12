<?php
require_once 'database.php';
require_once 'Partenaire.php';

$db = new Database();
$conn = $db->getConnection();
$partenaire = new Partenaire($conn);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $partenaire->read($_POST['id']);
    $partenaire->setNom($_POST['nom']);
    $partenaire->setLogo(file_get_contents($_FILES['logo']['tmp_name']));
    $partenaire->setDescription($_POST['description']);

    if($partenaire->update()) {
        echo "Partenaire mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du partenaire.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour un Partenaire</title>
</head>
<body>
    <form action="update.php" method="post" enctype="multipart/form-data">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required>
        <br>
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>
        <br>
        <label for="logo">Logo:</label>
        <input type="file" id="logo" name="logo">
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <br>
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>