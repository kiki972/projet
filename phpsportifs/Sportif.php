<?php
class Sportif {
    // Propriétés de la classe
    public $ID_sportif;
    public $Nom;
    public $Prenom;
    public $Biographie;
    public $Palmares;
    public $Photo;
    public $QR_Code;
    public $Date_creation;

    private $conn;
    private $table_name = "sportifs";

    public function __construct($db){
        $this->conn = $db;
    }

    // Méthodes CRUD pour gérer les sportifs

    // Méthode pour lire tous les sportifs
    function lire(){
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Méthode pour créer un sportif
    function creer(){
        $query = "INSERT INTO " . $this->table_name . " (Nom, Prénom, Biographie, Palmarès, Photo, QR_Code) VALUES (:nom, :prenom, :biographie, :palmares, :photo, :qr_code)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nom", $this->Nom);
        $stmt->bindParam(":prenom", $this->Prenom);
        $stmt->bindParam(":biographie", $this->Biographie);
        $stmt->bindParam(":palmares", $this->Palmares);
        $stmt->bindParam(":photo", $this->Photo);
        $stmt->bindParam(":qr_code", $this->QR_Code);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // Méthode pour mettre à jour un sportif
    function mettreAJour(){
        $query = "UPDATE " . $this->table_name . " SET Nom=:nom, Prénom=:prenom, Biographie=:biographie, Palmarès=:palmares, Photo=:photo, QR_Code=:qr_code WHERE ID_sportif=:id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->ID_sportif);
        $stmt->bindParam(":nom", $this->Nom);
        $stmt->bindParam(":prenom", $this->Prenom);
        $stmt->bindParam(":biographie", $this->Biographie);
        $stmt->bindParam(":palmares", $this->Palmares);
        $stmt->bindParam(":photo", $this->Photo);
        $stmt->bindParam(":qr_code", $this->QR_Code);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // Méthode pour supprimer un sportif
    function supprimer(){
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_sportif = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID_sportif);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>