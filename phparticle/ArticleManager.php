<?php
require_once 'Article.php';

class ArticleManager {
    private $pdo;

    public function __construct($host, $dbname, $username, $password) {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $this->pdo = new PDO($dsn, $username, $password);
    }

    // Create
    public function createArticle(Article $article) {
        $sql = "INSERT INTO article (Titre, Date_publication, ID_auteur, Photo) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $article->getTitre(),
            $article->getDatePublication(),
            $article->getIdAuteur(),
            $article->getPhoto()
        ]);
        return $this->pdo->lastInsertId();
    }

    // Read
    public function getArticleById($id) {
        $sql = "SELECT * FROM article WHERE ID_article = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Article($row['ID_article'], $row['Titre'], $row['Date_publication'], $row['ID_auteur'], $row['Date_modification'], $row['Photo']);
        }
        return null;
    }

    public function getAllArticles() {
        $sql = "SELECT * FROM article";
        $stmt = $this->pdo->query($sql);
        $articles = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $articles[] = new Article($row['ID_article'], $row['Titre'], $row['Date_publication'], $row['ID_auteur'], $row['Date_modification'], $row['Photo']);
        }
        return $articles;
    }

    // Update
    public function updateArticle(Article $article) {
        $sql = "UPDATE article SET Titre = ?, Date_publication = ?, ID_auteur = ?, Photo = ? WHERE ID_article = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $article->getTitre(),
            $article->getDatePublication(),
            $article->getIdAuteur(),
            $article->getPhoto(),
            $article->getId()
        ]);
    }

    // Delete
    public function deleteArticle($id) {
        $sql = "DELETE FROM article WHERE ID_article = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>