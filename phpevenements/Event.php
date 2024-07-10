<?php
class Event {
    private $conn;
    private $table = 'événement';

    public $id;
    public $titre;
    public $date;
    public $lieu;
    public $description;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Méthode pour créer un événement
    public function create() {
        $query = "INSERT INTO " . $this->table . " (Titre, Date, Lieu, Description) VALUES (:titre, :date, :lieu, :description)";
        $stmt = $this->conn->prepare($query);

        // Sécuriser les données
        $this->titre = htmlspecialchars(strip_tags($this->titre));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->lieu = htmlspecialchars(strip_tags($this->lieu));
        $this->description = htmlspecialchars(strip_tags($this->description));

        // Lier les paramètres
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':lieu', $this->lieu);
        $stmt->bindParam(':description', $this->description);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Méthode pour lire tous les événements
    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Méthode pour lire un seul événement
    public function read_single() {
        $query = "SELECT * FROM " . $this->table . " WHERE ID_evénement = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour mettre à jour un événement
    public function update() {
        $query = "UPDATE " . $this->table . " SET Titre = :titre, Date = :date, Lieu = :lieu, Description = :description WHERE ID_evénement = :id";
        $stmt = $this->conn->prepare($query);

        // Sécuriser les données
        $this->titre = htmlspecialchars(strip_tags($this->titre));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->lieu = htmlspecialchars(strip_tags($this->lieu));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Lier les paramètres
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':lieu', $this->lieu);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Méthode pour supprimer un événement
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE ID_evénement = :id";
        $stmt = $this->conn->prepare($query);

        // Sécuriser les données
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Lier le paramètre
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>