<?php
require_once 'ArticleManager.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $articleManager = new ArticleManager('localhost', 'sports', 'root', 'root');
    $newArticle = new Article(null, $_POST['titre'], $_POST['date_publication'], $_POST['id_auteur'], null, file_get_contents($_FILES['photo']['tmp_name']));
    $articleManager->createArticle($newArticle);
    header('Location: list_articles.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Article</title>
</head>
<body>
    <form action="add_article.php" method="post" enctype="multipart/form-data">
        <label for="titre">Titre:</label>
        <input type="text" id="titre" name="titre" required>
        <br>
        <label for="date_publication">Date de Publication:</label>
        <input type="datetime-local" id="date_publication" name="date_publication" required>
        <br>
        <label for="id_auteur">ID de l'Auteur:</label>
        <input type="number" id="id_auteur" name="id_auteur">
        <br>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo">
        <br>
        <input type="submit" value="Ajouter">
    </form>
    <button onclick="window.location.href='index.html'">Annuler</button>
</body>
</html>