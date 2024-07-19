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
    <!-- Inclure Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Modifier un Article</h2>
        <form action="edit_article.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_article" value="<?= $article->getId() ?>">
            
            <div class="form-group">
                <label for="titre">Titre:</label>
                <input type="text" class="form-control" id="titre" name="titre" value="<?= $article->getTitre() ?>" required>
            </div>
            
            <div class="form-group">
                <label for="date_publication">Date de Publication:</label>
                <input type="datetime-local" class="form-control" id="date_publication" name="date_publication" value="<?= date('Y-m-d\TH:i', strtotime($article->getDatePublication())) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="id_auteur">ID de l'Auteur:</label>
                <input type="number" class="form-control" id="id_auteur" name="id_auteur" value="<?= $article->getIdAuteur() ?>">
            </div>
            
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" class="form-control-file" id="photo" name="photo">
            </div>
            
            <button type="submit" class="btn btn-primary">Modifier</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='list_articles.php'">Annuler</button>
        </form>
    </div>
    
    <!-- Inclure Bootstrap JS et dépendances -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>