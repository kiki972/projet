<?php
class Partenaire {
    private $id;
    private $nom;
    private $logo;
    private $description;
    private $date_creation;

    public function __construct($id, $nom, $logo, $description, $date_creation) {
        $this->id = $id;
        $this->nom = $nom;
        $this->logo = $logo;
        $this->description = $description;
        $this->date_creation = $date_creation;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getLogo() {
        return $this->logo;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDateCreation() {
        return $this->date_creation;
    }
}
?>