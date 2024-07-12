<?php
require_once 'database.php';
require_once 'Partenaire.php';

$db = new Database();
$conn = $db->getConnection();
$partenaire = new Partenaire($conn);
$partners = $partenaire->list();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Partenaires</title>
</head>
<body>
    <h1>Liste des Partenaires</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Logo</th>
            <th>Description</th>
            <th>Date de Création</th>
        </tr>
        <?php while ($row = $partners->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['ID_partenaire']; ?></td>
                <td><?php echo $row['Nom']; ?></td>
                <td><img src="data:image/jpeg;base64,<?php echo base64_encode($row['Logo']); ?>" width="100"/></td>
                <td><?php echo $row['Description']; ?></td>
                <td><?php echo $row['Date_creation']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>