<?php
include_once 'database.php';
include_once 'Event.php';

if ($_POST) {
    // Instancier la base de données et la connexion
    $database = new Database();
    $db = $database->getConnection();

    // Instancier un objet Event
    $event = new Event($db);

    // Définir les propriétés de l'événement
    $event->titre = $_POST['titre'];
    $event->date = $_POST['date'];
    $event->lieu = $_POST['lieu'];
    $event->description = $_POST['description'];

    // Créer l'événement
    if ($event->create()) {
        echo "<div class='alert alert-success'>Événement ajouté avec succès.</div>";
    } else {
        echo "<div class='alert alert-danger'>Impossible d'ajouter l'événement.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un événement</title>
</head>
<body>
    <h2>Ajouter un événement</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="titre">Titre:</label>
        <input type="text" name="titre" id="titre" required>
        <br>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required>
        <br>
        <label for="lieu">Lieu:</label>
        <input type="text" name="lieu" id="lieu" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
        <br>
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>