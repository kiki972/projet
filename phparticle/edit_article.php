<?php
require_once 'ArticleManager.php';

$articleManager = new ArticleManager('localhost', 'sports', 'root', 'root');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updatedArticle = new Article($_POST['id_article'], $_POST['titre'], $_POST['date_publication'], $_POST['id_auteur'], null, file_get_contents($_FILES['photo']['tmp_name']));
    $articleManager->updateArticle($updatedArticle);
    header('Location: list_articles.php');
    exit;
}

$article = $articleManager->getArticleById($_GET['id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Article</title>
</head>
<body>
    <form action="edit_article.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_article" value="<?= $article->getId() ?>">
        <label for="titre">Titre:</label>
        <input type="text" id="titre" name="titre" value="<?= $article->getTitre() ?>" required>
        <br>
        <label for="date_publication">Date de Publication:</label>
        <input type="datetime-local" id="date_publication" name="date_publication" value="<?= date('Y-m-d\TH:i', strtotime($article->getDatePublication())) ?>" required>
        <br>
        <label for="id_auteur">ID de l'Auteur:</label>
        <input type="number" id="id_auteur" name="id_auteur" value="<?= $article->getIdAuteur() ?>">
        <br>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo">
        <br>
        <input type="submit" value="Modifier">
    </form>
    <button onclick="window.location.href='list_articles.php'">Annuler</button>
</body>
</html>
