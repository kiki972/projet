<?php
include_once 'Partenaire.php';
include_once 'Database.php';
include_once 'PartenaireManager.php';

$database = new Database();
$db = $database->getConnection();
$partenaireManager = new PartenaireManager($db);

$action = $_POST['action'];
$id = $_POST['id'];
$nom = $_POST['nom'];
$description = $_POST['description'];
$logo = null;

if (!empty($_FILES['logo']['tmp_name'])) {
    $logo = file_get_contents($_FILES['logo']['tmp_name']);
}

if ($action == 'add') {
    if ($partenaireManager->addPartenaire($nom, $logo, $description)) {
        echo "Partenaire ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du partenaire.";
    }
} elseif ($action == 'update') {
    if ($partenaireManager->updatePartenaire($id, $nom, $logo, $description)) {
        echo "Partenaire mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du partenaire.";
    }
} elseif ($action == 'delete') {
    if ($partenaireManager->deletePartenaire($id)) {
        echo "Partenaire supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du partenaire.";
    }
}
?>