<?php
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbname = "sports";
    public $conn;

    public function __construct() {
        // Créer une connexion
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Vérifier la connexion
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function close() {
        $this->conn->close();
    }
}

class Article {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($titre, $id_auteur) {
        $sql = "INSERT INTO article (Titre, ID_auteur) VALUES ('$titre', '$id_auteur')";
        if ($this->db->query($sql) === TRUE) {
            echo "Nouvel article créé avec succès";
        } else {
            echo "Erreur: " . $sql . "<br>" . $this->db->conn->error;
        }
    }

    public function update($id_article, $titre, $id_auteur) {
        $sql = "UPDATE article SET Titre='$titre', ID_auteur='$id_auteur' WHERE ID_article='$id_article'";
        if ($this->db->query($sql) === TRUE) {
            echo "Article mis à jour avec succès";
        } else {
            echo "Erreur: " . $sql . "<br>" . $this->db->conn->error;
        }
    }

    public function delete($id_article) {
        $sql = "DELETE FROM article WHERE ID_article='$id_article'";
        if ($this->db->query($sql) === TRUE) {
            echo "Article supprimé avec succès";
        } else {
            echo "Erreur: " . $sql . "<br>" . $this->db->conn->error;
        }
    }

    public function read() {
        $sql = "SELECT * FROM article";
        return $this->db->query($sql);
    }
}

$db = new Database();
$article = new Article($db);

// Ajouter un article
if (isset($_POST['create'])) {
    $titre = $_POST['titre'];
    $id_auteur = $_POST['id_auteur'];
    $article->create($titre, $id_auteur);
}

// Mettre à jour un article
if (isset($_POST['update'])) {
    $id_article = $_POST['id_article'];
    $titre = $_POST['titre'];
    $id_auteur = $_POST['id_auteur'];
    $article->update($id_article, $titre, $id_auteur);
}

// Supprimer un article
if (isset($_POST['delete'])) {
    $id_article = $_POST['id_article'];
    $article->delete($id_article);
}

// Lire les articles
$result = $article->read();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des articles</title>
</head>
<body>
    <h1>Créer un article</h1>
    <form method="post" action="">
        Titre: <input type="text" name="titre" required><br>
        ID Auteur: <input type="number" name="id_auteur" required><br>
        <input type="submit" name="create" value="Créer">
    </form>

    <h1>Mettre à jour un article</h1>
    <form method="post" action="">
        ID Article: <input type="number" name="id_article" required><br>
        Titre: <input type="text" name="titre" required><br>
        ID Auteur: <input type="number" name="id_auteur" required><br>
        <input type="submit" name="update" value="Mettre à jour">
    </form>

    <h1>Supprimer un article</h1>
    <form method="post" action="">
        ID Article: <input type="number" name="id_article" required><br>
        <input type="submit" name="delete" value="Supprimer">
    </form>

    <h1>Liste des articles</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Date de publication</th>
            <th>ID Auteur</th>
            <th>Date de modification</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ID_article"] . "</td>";
                echo "<td>" . $row["Titre"] . "</td>";
                echo "<td>" . $row["Date_publication"] . "</td>";
                echo "<td>" . $row["ID_auteur"] . "</td>";
                echo "<td>" . $row["Date_modification"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Aucun article trouvé</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$db->close();
?>