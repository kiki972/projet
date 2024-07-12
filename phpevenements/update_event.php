<?php
require_once 'Database.php';
require_once 'Événement.php';

$database = new Database();
$db = $database->getConnection();

$événement = new Événement($db);

if ($_POST) {
    $événement->ID_evénement = $_POST['ID_evénement'];
    $événement->Titre = $_POST['Titre'];
    $événement->Date = $_POST['Date'];
    $événement->Lieu = $_POST['Lieu'];
    $événement->Description = $_POST['Description'];

    if ($événement->update()) {
        echo "Événement mis à jour avec succès.";
    } else {
        echo "Impossible de mettre à jour l'événement.";
    }
}
?>