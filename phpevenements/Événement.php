<?php
require_once 'Database.php';

class Événement {
    private $conn;
    private $table_name = "événement";

    public $ID_evénement;
    public $Titre;
    public $Date;
    public $Lieu;
    public $Description;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET Titre=:Titre, Date=:Date, Lieu=:Lieu, Description=:Description";
        $stmt = $this->conn->prepare($query);

        $this->Titre = htmlspecialchars(strip_tags($this->Titre));
        $this->Date = htmlspecialchars(strip_tags($this->Date));
        $this->Lieu = htmlspecialchars(strip_tags($this->Lieu));
        $this->Description = htmlspecialchars(strip_tags($this->Description));

        $stmt->bindParam(":Titre", $this->Titre);
        $stmt->bindParam(":Date", $this->Date);
        $stmt->bindParam(":Lieu", $this->Lieu);
        $stmt->bindParam(":Description", $this->Description);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET Titre = :Titre, Date = :Date, Lieu = :Lieu, Description = :Description WHERE ID_evénement = :ID_evénement";
        $stmt = $this->conn->prepare($query);

        $this->Titre = htmlspecialchars(strip_tags($this->Titre));
        $this->Date = htmlspecialchars(strip_tags($this->Date));
        $this->Lieu = htmlspecialchars(strip_tags($this->Lieu));
        $this->Description = htmlspecialchars(strip_tags($this->Description));
        $this->ID_evénement = htmlspecialchars(strip_tags($this->ID_evénement));

        $stmt->bindParam(':Titre', $this->Titre);
        $stmt->bindParam(':Date', $this->Date);
        $stmt->bindParam(':Lieu', $this->Lieu);
        $stmt->bindParam(':Description', $this->Description);
        $stmt->bindParam(':ID_evénement', $this->ID_evénement);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_evénement = :ID_evénement";
        $stmt = $this->conn->prepare($query);

        $this->ID_evénement = htmlspecialchars(strip_tags($this->ID_evénement));
        $stmt->bindParam(':ID_evénement', $this->ID_evénement);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>