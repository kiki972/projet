<?php
class Database {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    public function connect() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("La connexion a échoué: " . $this->conn->connect_error);
        }
    }

    public function close() {
        $this->conn->close();
    }

    public function getConn() {
        return $this->conn;
    }
}

class Sportif {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->getConn();
    }

    public function create($nom, $prenom, $biographie, $palmares, $photo, $qr_code) {
        $stmt = $this->conn->prepare("INSERT INTO sportifs (Nom, Prénom, Biographie, Palmarès, Photo, QR_Code) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nom, $prenom, $biographie, $palmares, $photo, $qr_code);
        $stmt->execute();
        $stmt->close();
    }

    public function read($id = null) {
        if ($id) {
            $stmt = $this->conn->prepare("SELECT * FROM sportifs WHERE ID_sportif = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
            return $data;
        } else {
            $result = $this->conn->query("SELECT * FROM sportifs");
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function update($id, $nom, $prenom, $biographie, $palmares, $photo, $qr_code) {
        $stmt = $this->conn->prepare("UPDATE sportifs SET Nom = ?, Prénom = ?, Biographie = ?, Palmarès = ?, Photo = ?, QR_Code = ? WHERE ID_sportif = ?");
        $stmt->bind_param("ssssssi", $nom, $prenom, $biographie, $palmares, $photo, $qr_code, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM sportifs WHERE ID_sportif = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

// Connexion à la base de données
$db = new Database("localhost", "root", "root", "sports");
$db->connect();
$sportif = new Sportif($db);

// Exemple d'utilisation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        $sportif->create($_POST['nom'], $_POST['prenom'], $_POST['biographie'], $_POST['palmares'], $_POST['photo'], $_POST['qr_code']);
    } elseif (isset($_POST['update'])) {
        $sportif->update($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['biographie'], $_POST['palmares'], $_POST['photo'], $_POST['qr_code']);
    } elseif (isset($_POST['delete'])) {
        $sportif->delete($_POST['id']);
    }
}

$sportifs = $sportif->read();
$db->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Sportifs</title>
</head>
<body>
    <h1>Liste des Sportifs</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Biographie</th>
            <th>Palmarès</th>
            <th>Photo</th>
            <th>QR Code</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($sportifs as $sportif) { ?>
        <tr>
            <td><?php echo htmlspecialchars($sportif['ID_sportif']); ?></td>
            <td><?php echo htmlspecialchars($sportif['Nom']); ?></td>
            <td><?php echo htmlspecialchars($sportif['Prénom']); ?></td>
            <td><?php echo htmlspecialchars($sportif['Biographie']); ?></td>
            <td><?php echo htmlspecialchars($sportif['Palmarès']); ?></td>
            <td><?php echo htmlspecialchars($sportif['Photo']); ?></td>
            <td><?php echo htmlspecialchars($sportif['QR_Code']); ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $sportif['ID_sportif']; ?>">
                    <input type="submit" name="delete" value="Supprimer">
                </form>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $sportif['ID_sportif']; ?>">
                    <input type="text" name="nom" value="<?php echo htmlspecialchars($sportif['Nom']); ?>">
                    <input type="text" name="prenom" value="<?php echo htmlspecialchars($sportif['Prénom']); ?>">
                    <input type="text" name="biographie" value="<?php echo htmlspecialchars($sportif['Biographie']); ?>">
                    <input type="text" name="palmares" value="<?php echo htmlspecialchars($sportif['Palmarès']); ?>">
                    <input type="text" name="photo" value="<?php echo htmlspecialchars($sportif['Photo']); ?>">
                    <input type="text" name="qr_code" value="<?php echo htmlspecialchars($sportif['QR_Code']); ?>">
                    <input type="submit" name="update" value="Mettre à jour">
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>

    <h2>Ajouter un Sportif</h2>
    <form method="POST">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <textarea name="biographie" placeholder="Biographie"></textarea>
        <textarea name="palmares" placeholder="Palmarès"></textarea>
        <input type="text" name="photo" placeholder="Photo">
        <input type="text" name="qr_code" placeholder="QR Code">
        <input type="submit" name="create" value="Ajouter">
    </form>
</body>
</html>