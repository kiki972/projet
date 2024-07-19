<?php
require_once 'ArticleManager.php';

$articleManager = new ArticleManager('localhost', 'sports', 'root', 'root');
$articles = $articleManager->getAllArticles();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .table-container {
            margin-top: 50px;
        }
        img.article-thumbnail {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container table-container">
        <h1>Liste des Articles</h1>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Date de Publication</th>
                    <th>ID Auteur</th>
                    <th>Date de Modification</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?= $article->getId() ?></td>
                        <td><?= $article->getTitre() ?></td>
                        <td><?= $article->getDatePublication() ?></td>
                        <td><?= $article->getIdAuteur() ?></td>
                        <td><?= $article->getDateModification() ?></td>
                        <td><img src="data:image/jpeg;base64,<?= base64_encode($article->getPhoto()) ?>" class="article-thumbnail"/></td>
                        <td>
                            <a href="edit_article.php?id=<?= $article->getId() ?>" class="btn btn-primary">Modifier</a>
                            <a href="delete_article.php?id=<?= $article->getId() ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='gestiondesarticles.html'">Retour</button>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>