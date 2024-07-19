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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Ajouter un Article</h2>
        <form action="add_article.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titre">Titre:</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>
            <div class="form-group">
                <label for="date_publication">Date de Publication:</label>
                <input type="datetime-local" class="form-control" id="date_publication" name="date_publication" required>
            </div>
            <div class="form-group">
                <label for="id_auteur">ID de l'Auteur:</label>
                <input type="number" class="form-control" id="id_auteur" name="id_auteur">
            </div>
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" class="form-control-file" id="photo" name="photo">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='gestiondesarticles.html'">Annuler</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>