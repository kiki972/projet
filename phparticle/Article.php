<?php
class Article {
    private $id_article;
    private $titre;
    private $date_publication;
    private $id_auteur;
    private $date_modification;
    private $photo;

    // Constructeur
    public function __construct($id_article = null, $titre = null, $date_publication = null, $id_auteur = null, $date_modification = null, $photo = null) {
        $this->id_article = $id_article;
        $this->titre = $titre;
        $this->date_publication = $date_publication;
        $this->id_auteur = $id_auteur;
        $this->date_modification = $date_modification;
        $this->photo = $photo;
    }

    // Getters et setters
    public function getId() {
        return $this->id_article;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDatePublication() {
        return $this->date_publication;
    }

    public function getIdAuteur() {
        return $this->id_auteur;
    }

    public function getDateModification() {
        return $this->date_modification;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setDatePublication($date_publication) {
        $this->date_publication = $date_publication;
    }

    public function setIdAuteur($id_auteur) {
        $this->id_auteur = $id_auteur;
    }

    public function setDateModification($date_modification) {
        $this->date_modification = $date_modification;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }
}
?>