<?php
require_once 'database.php';
require_once 'Partenaire.php';

$db = new Database();
$conn = $db->getConnection();
$partenaire = new Partenaire($conn);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $partenaire->setNom($_POST['nom']);
    $partenaire->setLogo(file_get_contents($_FILES['logo']['tmp_name']));
    $partenaire->setDescription($_POST['description']);

    if($partenaire->create()) {
        echo "Partenaire ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du partenaire.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Partenaire</title>
</head>
<body>
    <form action="create.php" method="post" enctype="multipart/form-data">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>
        <br>
        <label for="logo">Logo:</label>
        <input type="file" id="logo" name="logo" required>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>