<?php
require_once 'Database.php';
require_once 'Événement.php';

$database = new Database();
$db = $database->getConnection();

$événement = new Événement($db);

if ($_POST) {
    $événement->ID_evénement = $_POST['ID_evénement'];

    if ($événement->delete()) {
        echo "Événement supprimé avec succès.";
    } else {
        echo "Impossible de supprimer l'événement.";
    }
}
?>