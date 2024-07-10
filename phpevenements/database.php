<?php
class Database {
    // Spécifiez vos propres paramètres de base de données
    private $host = "localhost";
    private $db_name = "sports";
    private $username = "root";
    private $password = "root";
    public $conn;

    // Méthode pour obtenir la connexion à la base de données
    public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Erreur de connexion : " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>