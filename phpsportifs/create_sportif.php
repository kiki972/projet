<?php
include_once 'Database.php';
include_once 'Sportif.php';

$database = new Database();
$db = $database->connect();

$sportif = new Sportif($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sportif->Nom = $_POST['Nom'];
    $sportif->Prénom = $_POST['Prénom'];
    $sportif->Biographie = $_POST['Biographie'];
    $sportif->Palmarès = $_POST['Palmarès'];
    $sportif->Photo = file_get_contents($_FILES['Photo']['tmp_name']);
    $sportif->QR_Code = file_get_contents($_FILES['QR_Code']['tmp_name']);

    if ($sportif->create()) {
        echo "Sportif créé avec succès.";
    } else {
        echo "Erreur lors de la création du sportif.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Sportif</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <label for="Nom">Nom:</label>
        <input type="text" name="Nom" id="Nom" required><br>
        <label for="Prénom">Prénom:</label>
        <input type="text" name="Prénom" id="Prénom" required><br>
        <label for="Biographie">Biographie:</label>
        <textarea name="Biographie" id="Biographie"></textarea><br>
        <label for="Palmarès">Palmarès:</label>
        <textarea name="Palmarès" id="Palmarès"></textarea><br>
        <label for="Photo">Photo:</label>
        <input type="file" name="Photo" id="Photo"><br>
        <label for="QR_Code">QR Code:</label>
        <input type="file" name="QR_Code" id="QR_Code"><br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>