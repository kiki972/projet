<?php
class Partenaire {
    private $id;
    private $nom;
    private $logo;
    private $description;
    private $date_creation;
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Getters and setters

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

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setLogo($logo) {
        $this->logo = $logo;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    // Create a new partner
    public function create() {
        $query = "INSERT INTO partenaire (Nom, Logo, Description) VALUES (:nom, :logo, :description)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':logo', $this->logo, PDO::PARAM_LOB);
        $stmt->bindParam(':description', $this->description);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read partner details
    public function read($id) {
        $query = "SELECT * FROM partenaire WHERE ID_partenaire = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['ID_partenaire'];
        $this->nom = $row['Nom'];
        $this->logo = $row['Logo'];
        $this->description = $row['Description'];
        $this->date_creation = $row['Date_creation'];
    }

    // Update partner details
    public function update() {
        $query = "UPDATE partenaire SET Nom = :nom, Logo = :logo, Description = :description WHERE ID_partenaire = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':logo', $this->logo, PDO::PARAM_LOB);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete a partner
    public function delete($id) {
        $query = "DELETE FROM partenaire WHERE ID_partenaire = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // List all partners
    public function list() {
        $query = "SELECT * FROM partenaire";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>