<?php
// CommentManager.php

require_once 'config.php';
require_once 'Comment.php';

class CommentManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addComment(Comment $comment) {
        $sql = "INSERT INTO comments (content, created_at) VALUES (:content, :created_at)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':content', $comment->getContent());
        $stmt->bindValue(':created_at', $comment->getCreatedAt());
        $stmt->execute();
    }

    public function getComments() {
        $sql = "SELECT * FROM comments ORDER BY created_at DESC";
        $stmt = $this->pdo->query($sql);
        $comments = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $comment = new Comment($row['content']);
            $comment->setId($row['id']);
            $comment->setCreatedAt($row['created_at']);
            $comments[] = $comment;
        }
        return $comments;
    }
}
?>