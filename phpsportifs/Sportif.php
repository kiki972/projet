<?php
class Sportif {
    private $conn;
    private $table = 'sportifs';

    public $ID_sportif;
    public $Nom;
    public $Prénom;
    public $Biographie;
    public $Palmarès;
    public $Photo;
    public $QR_Code;
    public $Date_creation;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (Nom, Prénom, Biographie, Palmarès, Photo, QR_Code)
                  VALUES (:Nom, :Prenom, :Biographie, :Palmares, :Photo, :QRCode)';

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->Nom = htmlspecialchars(strip_tags($this->Nom));
        $this->Prénom = htmlspecialchars(strip_tags($this->Prénom));
        $this->Biographie = htmlspecialchars(strip_tags($this->Biographie));
        $this->Palmarès = htmlspecialchars(strip_tags($this->Palmarès));

        // Bind data
        $stmt->bindParam(':Nom', $this->Nom);
        $stmt->bindParam(':Prenom', $this->Prénom);
        $stmt->bindParam(':Biographie', $this->Biographie);
        $stmt->bindParam(':Palmares', $this->Palmarès);
        $stmt->bindParam(':Photo', $this->Photo, PDO::PARAM_LOB);
        $stmt->bindParam(':QRCode', $this->QR_Code, PDO::PARAM_LOB);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Read
    public function read() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read Single
    public function read_single() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE ID_sportif = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID_sportif);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->Nom = $row['Nom'];
        $this->Prénom = $row['Prénom'];
        $this->Biographie = $row['Biographie'];
        $this->Palmarès = $row['Palmarès'];
        $this->Photo = $row['Photo'];
        $this->QR_Code = $row['QR_Code'];
        $this->Date_creation = $row['Date_creation'];
    }

    // Update
    public function update() {
        $query = 'UPDATE ' . $this->table . '
                  SET Nom = :Nom, Prénom = :Prenom, Biographie = :Biographie, Palmarès = :Palmares, Photo = :Photo, QR_Code = :QRCode
                  WHERE ID_sportif = :ID_sportif';

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->Nom = htmlspecialchars(strip_tags($this->Nom));
        $this->Prénom = htmlspecialchars(strip_tags($this->Prénom));
        $this->Biographie = htmlspecialchars(strip_tags($this->Biographie));
        $this->Palmarès = htmlspecialchars(strip_tags($this->Palmarès));

        // Bind data
        $stmt->bindParam(':Nom', $this->Nom);
        $stmt->bindParam(':Prenom', $this->Prénom);
        $stmt->bindParam(':Biographie', $this->Biographie);
        $stmt->bindParam(':Palmares', $this->Palmarès);
        $stmt->bindParam(':Photo', $this->Photo, PDO::PARAM_LOB);
        $stmt->bindParam(':QRCode', $this->QR_Code, PDO::PARAM_LOB);
        $stmt->bindParam(':ID_sportif', $this->ID_sportif);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Delete
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE ID_sportif = :ID_sportif';
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(':ID_sportif', $this->ID_sportif);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
?>