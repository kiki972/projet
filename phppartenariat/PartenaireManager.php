<?php
class PartenaireManager {
    private $conn;
    private $table_name = "partenaire";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getPartenaires() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $partenaires = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $partenaire = new Partenaire(
                $row['ID_partenaire'],
                $row['Nom'],
                $row['Logo'],
                $row['Description'],
                $row['Date_creation']
            );
            $partenaires[] = $partenaire;
        }
        return $partenaires;
    }

    public function addPartenaire($nom, $logo, $description) {
        $query = "INSERT INTO " . $this->table_name . " (Nom, Logo, Description) VALUES (:nom, :logo, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':logo', $logo);
        $stmt->bindParam(':description', $description);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updatePartenaire($id, $nom, $logo, $description) {
        $query = "UPDATE " . $this->table_name . " SET Nom = :nom, Logo = :logo, Description = :description WHERE ID_partenaire = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':logo', $logo);
        $stmt->bindParam(':description', $description);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function deletePartenaire($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_partenaire = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>