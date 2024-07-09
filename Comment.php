<?php
// Comment.php

class Comment {
    private $id;
    private $content;
    private $created_at;

    public function __construct($content) {
        $this->content = $content;
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function getId() {
        return $this->id;
    }

    public function getContent() {
        return $this->content;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }
}
?>