<?php
// Vérifier si le formulaire a été soumis
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Inclure la classe Sportif et la connexion à la base de données
    include_once 'Database.php';
    include_once 'Sportif.php';

    // Instancier la base de données et la classe Sportif
    $database = new Database();
    $db = $database->getConnection();

    $sportif = new Sportif($db);

    // Récupérer les données du formulaire
    $sportif->Nom = $_POST['nom'];
    $sportif->Prenom = $_POST['prenom'];
    $sportif->Biographie = $_POST['biographie'];
    $sportif->Palmares = $_POST['palmares'];

    // Gérer l'upload de la photo
    if(isset($_FILES['photo'])){
        $photo_tmp = $_FILES['photo']['tmp_name'];
        $photo_content = file_get_contents($photo_tmp);
        $sportif->Photo = $photo_content;
    }

    // Gérer l'upload du QR Code
    if(isset($_FILES['qr_code'])){
        $qr_tmp = $_FILES['qr_code']['tmp_name'];
        $qr_content = file_get_contents($qr_tmp);
        $sportif->QR_Code = $qr_content;
    }

    // Ajouter le sportif dans la base de données
    if($sportif->creer()){
        echo "<p>Sportif ajouté avec succès.</p>";
    } else{
        echo "<p>Erreur lors de l'ajout du sportif.</p>";
    }
}
?>