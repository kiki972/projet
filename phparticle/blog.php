<?php
require_once 'Article.php';

// Connexion à la base de données
$host = 'localhost';
$dbname = 'sports';
$username = 'root';
$password = 'root';

$articleManager = new Article($host, $dbname, $username, $password);
$articles = $articleManager->getAllArticles();

// Gestion des actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $titre = $_POST['titre'];
                $id_auteur = $_POST['id_auteur'];
                $photoData = file_get_contents($_FILES['photo']['tmp_name']); // Lecture du fichier image
                $articleManager->createArticle($titre, $id_auteur, $photoData);
                break;
            case 'update':
                $id = $_POST['id'];
                $titre = $_POST['titre'];
                $id_auteur = $_POST['id_auteur'];
                $photoData = file_get_contents($_FILES['photo']['tmp_name']); // Lecture du fichier image
                $articleManager->updateArticle($id, $titre, $id_auteur, $photoData);
                break;
            case 'delete':
                $id = $_POST['id'];
                $articleManager->deleteArticle($id);
                break;
        }
        // Rafraîchir la page pour éviter de renvoyer le formulaire
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Sportifs Martiniquais</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://la1ere.francetvinfo.fr/image/IeBaTSud4nlAV8dReUOlGS2-134/930x620/filters:format(webp)/outremer/2023/10/14/match-martinique-salavdor-aliker-6529ea3524616564255365.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #000;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            text-align: center;
            margin-bottom: 40px;
        }

        header h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        header h2 {
            font-size: 1.5em;
            margin-top: 0;
        }

        main {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
            width: 300px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 100%;
            height: auto;
        }

        .card-content {
            padding: 15px;
        }

        .card-content h3 {
            font-size: 1.2em;
            margin: 0 0 10px 0;
        }

        .card-content p {
            font-size: 1em;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-container h3 {
            margin-top: 0;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container form input,
        .form-container form button {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 1em;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>ACTUALITÉS SUR LES SPORTIFS MARTINIQUAIS</h1>
            <h2>BLOG</h2>
        </header>
        <main>
            <?php foreach ($articles as $article): ?>
            <div class="card">
                <img src="data:image/jpeg;base64,<?= base64_encode($article['Photo']) ?>" alt="<?= htmlspecialchars($article['Titre']) ?>">
                <div class="card-content">
                    <h3><?= htmlspecialchars($article['Titre']) ?></h3>
                    <p>Publié le <?= date('d/m/Y', strtotime($article['Date_publication'])) ?></p>
                    <!-- Formulaire de suppression -->
                    <form method="post" action="">
                        <input type="hidden" name="id" value="<?= $article['ID_article'] ?>">
                        <button type="submit" name="action" value="delete">Supprimer</button>
                    </form>
                    <!-- Formulaire de mise à jour -->
                    <form method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $article['ID_article'] ?>">
                        <input type="text" name="titre" value="<?= htmlspecialchars($article['Titre']) ?>" required>
                        <input type="number" name="id_auteur" value="<?= htmlspecialchars($article['ID_auteur']) ?>" required>
                        <input type="file" name="photo">
                        <button type="submit" name="action" value="update">Mettre à jour</button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </main>
        <!-- Formulaire d'ajout -->
        <div class="form-container">
            <h3>Ajouter un nouvel article</h3>
            <form method="post" action="" enctype="multipart/form-data">
                <input type="text" name="titre" placeholder="Titre" required>
                <input type="number" name="id_auteur" placeholder="ID Auteur" required>
                <input type="file" name="photo" required>
                <button type="submit" name="action" value="add">Ajouter</button>
            </form>
        </div>
    </div>
</body>

</html>