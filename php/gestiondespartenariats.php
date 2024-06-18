<?php
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbname = "sports";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Échec de la connexion : " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function close() {
        $this->conn->close();
    }
}

class Partenaire {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($nom, $logo, $description) {
        $logo = addslashes(file_get_contents($logo['tmp_name']));
        $sql = "INSERT INTO partenaire (Nom, Logo, Description) VALUES ('$nom', '$logo', '$description')";
        return $this->db->query($sql);
    }

    public function read() {
        $sql = "SELECT * FROM partenaire";
        return $this->db->query($sql);
    }

    public function update($id, $nom, $description) {
        $sql = "UPDATE partenaire SET Nom='$nom', Description='$description' WHERE ID_partenaire=$id";
        return $this->db->query($sql);
    }

    public function delete($id) {
        $sql = "DELETE FROM partenaire WHERE ID_partenaire=$id";
        return $this->db->query($sql);
    }
}

// Utilisation des classes
$db = new Database();
$partenaire = new Partenaire($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $partenaire->create($_POST['nom'], $_FILES['logo'], $_POST['description']);
    } elseif (isset($_POST['update'])) {
        $partenaire->update($_POST['id'], $_POST['nom'], $_POST['description']);
    } elseif (isset($_POST['delete'])) {
        $partenaire->delete($_POST['id']);
    }
}

$result = $partenaire->read();
$db->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Partenaires</title>
</head>
<body>
    <h1>Créer un nouveau partenaire</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="file" name="logo" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <button type="submit" name="create">Créer</button>
    </form>

    <h1>Liste des partenaires</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Logo</th>
            <th>Description</th>
            <th>Date de création</th>
            <th>Actions</th>
        </tr>
        <?php if ($result->num_rows > 0) : ?>
            <?php while($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['ID_partenaire']; ?></td>
                    <td><?php echo $row['Nom']; ?></td>
                    <td><img src="data:image/jpeg;base64,<?php echo base64_encode($row['Logo']); ?>" height="50" /></td>
                    <td><?php echo $row['Description']; ?></td>
                    <td><?php echo $row['Date_creation']; ?></td>
                    <td>
                        <form action="" method="post" style="display:inline-block;">
                            <input type="hidden" name="id" value="<?php echo $row['ID_partenaire']; ?>">
                            <input type="text" name="nom" value="<?php echo $row['Nom']; ?>" required>
                            <textarea name="description" required><?php echo $row['Description']; ?></textarea>
                            <button type="submit" name="update">Mettre à jour</button>
                        </form>
                        <form action="" method="post" style="display:inline-block;">
                            <input type="hidden" name="id" value="<?php echo $row['ID_partenaire']; ?>">
                            <button type="submit" name="delete">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else : ?>
            <tr>
                <td colspan="6">Aucun partenaire trouvé</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>