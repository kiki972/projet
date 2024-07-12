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
</head>
<body>
    <h1>Liste des Articles</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Date de Publication</th>
            <th>ID Auteur</th>
            <th>Date de Modification</th>
            <th>Photo</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= $article->getId() ?></td>
                <td><?= $article->getTitre() ?></td>
                <td><?= $article->getDatePublication() ?></td>
                <td><?= $article->getIdAuteur() ?></td>
                <td><?= $article->getDateModification() ?></td>
                <td><img src="data:image/jpeg;base64,<?= base64_encode($article->getPhoto()) ?>" width="100"/></td>
                <td>
                    <button onclick="window.location.href='edit_article.php?id=<?= $article->getId() ?>'">Modifier</button>
                    <button onclick="window.location.href='delete_article.php?id=<?= $article->getId() ?>'">Supprimer</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <button onclick="window.location.href='gestiondesarticles.html'">Retour</button>
</body>
</html>