<?php
// Classe pour gérer la connexion à la base de données
class Database {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    // Constructeur pour initialiser les informations de connexion
    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    // Méthode pour établir la connexion à la base de données
    public function connect() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("La connexion a échoué: " . $this->conn->connect_error);
        }
    }

    // Méthode pour insérer un nouvel utilisateur dans la base de données
    public function insertUser($nom, $prenom, $email, $mot_de_passe) {
        $sql = "INSERT INTO utilisateur (Nom, Prénom, Email, Mot_de_passe) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $nom, $prenom, $email, $mot_de_passe);

        if ($stmt->execute()) {
            return true; // Succès de l'insertion
        } else {
            return false; // Échec de l'insertion
        }

        $stmt->close();
    }

    // Méthode pour fermer la connexion à la base de données
    public function close() {
        $this->conn->close();
    }
}

// Récupérer les données du formulaire
$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlspecialchars($_POST['prenom']);
$email = htmlspecialchars($_POST['email']);
$mot_de_passe = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Configuration de la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "sports";

// Création d'une instance de la classe Database
$database = new Database($servername, $username, $password, $dbname);

// Connexion à la base de données
$database->connect();

// Insertion des données de l'utilisateur
if ($database->insertUser($nom, $prenom, $email, $mot_de_passe)) {
    echo "Nouvel enregistrement créé avec succès";
    header("Location: pagedaccueil.html");
    exit();
} else {
    echo "Erreur lors de l'insertion des données";
}

// Fermeture de la connexion à la base de données
$database->close();
?>