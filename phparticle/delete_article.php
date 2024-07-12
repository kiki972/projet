<?php
require_once 'ArticleManager.php';

$articleManager = new ArticleManager('localhost', 'sports', 'root', 'root');

if (isset($_GET['id'])) {
    $articleManager->deleteArticle($_GET['id']);
    header('Location: list_articles.php');
    exit;
}
?>