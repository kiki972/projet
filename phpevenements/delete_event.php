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

    // Supprimer l'événement
    if ($event->delete()) {
        echo "<div class='alert alert-success'>Événement supprimé avec succès.</div>";
    } else {
        echo "<div class='alert alert-danger'>Impossible de supprimer l'événement.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un événement</title>
</head>
<body>
    <h2>Supprimer un événement</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
        <label for="id">ID de l'événement:</label>
        <input type="number" name="id" id="id" required>
        <br>
        <input type="submit" value="Supprimer">
    </form>
</body>
</html>