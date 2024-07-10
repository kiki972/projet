<?php
// Vérifier si l'ID du sportif à supprimer est défini
if(isset($_POST['id_sportif'])){
    // Inclure la classe Sportif et la connexion à la base de données
    include_once 'Database.php';
    include_once 'Sportif.php';

    // Instancier la base de données et la classe Sportif
    $database = new Database();
    $db = $database->getConnection();

    $sportif = new Sportif($db);

    // Récupérer l'ID du sportif à supprimer
    $sportif->ID_sportif = $_POST['id_sportif'];

    // Supprimer le sportif de la base de données
    if($sportif->supprimer()){
        echo "<p>Sportif supprimé avec succès.</p>";
    } else{
        echo "<p>Erreur lors de la suppression du sportif.</p>";
    }
} else {
    echo "<p>Erreur : ID du sportif non spécifié.</p>";
}
?>