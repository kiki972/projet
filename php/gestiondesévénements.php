<?php
class Event {
    private $conn;

    public function __construct($host, $dbname, $username, $password) {
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function createEvent($title, $date, $location, $description) {
        $sql = "INSERT INTO événement (Titre, Date, Lieu, Description) VALUES (:title, :date, :location, :description)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }

    public function readEvents() {
        $sql = "SELECT * FROM événement";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateEvent($id, $title, $date, $location, $description) {
        $sql = "UPDATE événement SET Titre = :title, Date = :date, Lieu = :location, Description = :description WHERE ID_evénement = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }

    public function deleteEvent($id) {
        $sql = "DELETE FROM événement WHERE ID_evénement = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

// Connexion à la base de données
$host = 'localhost';
$dbname = 'sports';
$username = 'root';
$password = 'root';
$eventManager = new Event($host, $dbname, $username, $password);

// Logique de traitement des formulaires
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $eventManager->createEvent($_POST['title'], $_POST['date'], $_POST['location'], $_POST['description']);
    } elseif (isset($_POST['update'])) {
        $eventManager->updateEvent($_POST['id'], $_POST['title'], $_POST['date'], $_POST['location'], $_POST['description']);
    } elseif (isset($_POST['delete'])) {
        $eventManager->deleteEvent($_POST['id']);
    }
}

// Lecture des événements
$events = $eventManager->readEvents();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Événements</title>
</head>
<body>
    <h1>Créer un événement</h1>
    <form method="POST">
        <input type="text" name="title" placeholder="Titre" required>
        <input type="date" name="date" required>
        <input type="text" name="location" placeholder="Lieu" required>
        <textarea name="description" placeholder="Description"></textarea>
        <button type="submit" name="create">Créer</button>
    </form>

    <h1>Événements</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Date</th>
            <th>Lieu</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($events as $event): ?>
        <tr>
            <td><?php echo $event['ID_evénement']; ?></td>
            <td><?php echo $event['Titre']; ?></td>
            <td><?php echo $event['Date']; ?></td>
            <td><?php echo $event['Lieu']; ?></td>
            <td><?php echo $event['Description']; ?></td>
            <td>
                <form method="POST" style="display:inline-block;">
                    <input type="hidden" name="id" value="<?php echo $event['ID_evénement']; ?>">
                    <input type="text" name="title" value="<?php echo $event['Titre']; ?>" required>
                    <input type="date" name="date" value="<?php echo $event['Date']; ?>" required>
                    <input type="text" name="location" value="<?php echo $event['Lieu']; ?>" required>
                    <textarea name="description"><?php echo $event['Description']; ?></textarea>
                    <button type="submit" name="update">Mettre à jour</button>
                </form>
                <form method="POST" style="display:inline-block;">
                    <input type="hidden" name="id" value="<?php echo $event['ID_evénement']; ?>">
                    <button type="submit" name="delete">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>