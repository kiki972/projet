<?php
require_once 'Database.php';
require_once 'Événement.php';

$database = new Database();
$db = $database->getConnection();

$événement = new Événement($db);

if ($_POST) {
    $événement->Titre = $_POST['Titre'];
    $événement->Date = $_POST['Date'];
    $événement->Lieu = $_POST['Lieu'];
    $événement->Description = $_POST['Description'];

    if ($événement->create()) {
        echo "Événement créé avec succès.";
    } else {
        echo "Impossible de créer l'événement.";
    }
}
?>