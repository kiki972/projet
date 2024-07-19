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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Ajouter un Sportif</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Nom">Nom:</label>
                <input type="text" class="form-control" name="Nom" id="Nom" required>
            </div>
            <div class="form-group">
                <label for="Prénom">Prénom:</label>
                <input type="text" class="form-control" name="Prénom" id="Prénom" required>
            </div>
            <div class="form-group">
                <label for="Biographie">Biographie:</label>
                <textarea class="form-control" name="Biographie" id="Biographie"></textarea>
            </div>
            <div class="form-group">
                <label for="Palmarès">Palmarès:</label>
                <textarea class="form-control" name="Palmarès" id="Palmarès"></textarea>
            </div>
            <div class="form-group">
                <label for="Photo">Photo:</label>
                <input type="file" class="form-control-file" name="Photo" id="Photo">
            </div>
            <div class="form-group">
                <label for="QR_Code">QR Code:</label>
                <input type="file" class="form-control-file" name="QR_Code" id="QR_Code">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> 
</body>
</html>
