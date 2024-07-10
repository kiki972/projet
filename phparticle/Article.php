<?php
class Article
{
    private $db;

    public function __construct($host, $dbname, $username, $password)
    {
        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getAllArticles()
    {
        $stmt = $this->db->query("SELECT * FROM article ORDER BY Date_publication DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticleById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM article WHERE ID_article = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createArticle($titre, $id_auteur, $photoData)
    {
        $stmt = $this->db->prepare("INSERT INTO article (Titre, ID_auteur, Photo) VALUES (?, ?, ?)");
        return $stmt->execute([$titre, $id_auteur, $photoData]);
    }

    public function updateArticle($id, $titre, $id_auteur, $photoData = null)
    {
        if ($photoData) {
            $stmt = $this->db->prepare("UPDATE article SET Titre = ?, ID_auteur = ?, Photo = ? WHERE ID_article = ?");
            return $stmt->execute([$titre, $id_auteur, $photoData, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE article SET Titre = ?, ID_auteur = ? WHERE ID_article = ?");
            return $stmt->execute([$titre, $id_auteur, $id]);
        }
    }

    public function deleteArticle($id)
    {
        $stmt = $this->db->prepare("DELETE FROM article WHERE ID_article = ?");
        return $stmt->execute([$id]);
    }
}
?>