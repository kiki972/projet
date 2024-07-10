<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure la classe Sportif et la connexion à la base de données
    include_once 'Database.php';
    include_once 'Sportif.php';

    // Instancier la base de données et la classe Sportif
    $database = new Database();
    $db = $database->getConnection();

    $sportif = new Sportif($db);

    // Récupérer l'ID du sportif à modifier
    if (isset($_POST['id_sportif'])) {
        $sportif->ID_sportif = $_POST['id_sportif'];

        // Récupérer les nouvelles données du formulaire
        $sportif->Nom = isset($_POST['nom']) ? $_POST['nom'] : '';
        $sportif->Prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
        $sportif->Biographie = isset($_POST['biographie']) ? $_POST['biographie'] : '';
        $sportif->Palmares = isset($_POST['palmares']) ? $_POST['palmares'] : '';

        // Mettre à jour le sportif dans la base de données
        if ($sportif->mettreAJour()) {
            echo "<p>Sportif mis à jour avec succès.</p>";
        } else {
            echo "<p>Erreur lors de la mise à jour du sportif.</p>";
        }
    } else {
        echo "<p>Erreur : ID du sportif manquant.</p>";
    }
}
?>