<?php
include_once 'database.php';
include_once 'Event.php';

// Vérifier si l'ID de l'événement est passé dans l'URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Instancier la base de données et la connexion
    $database = new Database();
    $db = $database->getConnection();

    // Instancier un objet Event
    $event = new Event($db);

    // Définir l'ID de l'événement
    $event->id = $id;

    // Lire les détails de l'événement
    $event_details = $event->read_single();
}

if ($_POST) {
    // Définir les nouvelles propriétés de l'événement
    $event->titre = $_POST['titre'];
    $event->date = $_POST['date'];
    $event->lieu = $_POST['lieu'];
    $event->description = $_POST['description'];

    // Mettre à jour l'événement
    if ($event->update()) {
        echo "<div class='alert alert-success'>Événement mis à jour avec succès.</div>";
    } else {
        echo "<div class='alert alert-danger'>Impossible de mettre à jour l'événement.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un événement</title>
</head>
<body>
    <h2>Modifier un événement</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id={$id}"; ?>" method="post">
        <label for="titre">Titre:</label>
        <input type="text" name="titre" id="titre" value="<?php echo $event_details['Titre']; ?>" required>
        <br>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" value="<?php echo $event_details['Date']; ?>" required>
        <br>
        <label for="lieu">Lieu:</label>
        <input type="text" name="lieu" id="lieu" value="<?php echo $event_details['Lieu']; ?>" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description"><?php echo $event_details['Description']; ?></textarea>
        <br>
        <input type="submit" value="Mettre à jour">
    </form>
</body>
</html>