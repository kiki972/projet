<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des sportifs</title>
</head>
<body>
    <h1>Gestion des sportifs</h1>

    <h2>Ajouter un sportif</h2>
    <form action="ajouter_sportif.php" method="post" enctype="multipart/form-data">
        <label>Nom :</label>
        <input type="text" name="nom" required><br>
        <label>Prénom :</label>
        <input type="text" name="prenom" required><br>
        <label>Biographie :</label><br>
        <textarea name="biographie" rows="4" cols="50"></textarea><br>
        <label>Palmarès :</label><br>
        <textarea name="palmares" rows="4" cols="50"></textarea><br>
        <label>Photo :</label>
        <input type="file" name="photo" accept="image/*"><br>
        <label>QR Code :</label>
        <input type="file" name="qr_code" accept=".png, .jpg, .jpeg"><br>
        <input type="submit" value="Ajouter">
    </form>

    <h2>Liste des sportifs</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Biographie</th>
            <th>Palmarès</th>
            <!-- <th>Actions</th> -->
        </tr>
        <?php
        // Inclure la classe Sportif et la connexion à la base de données
        include_once 'Database.php';
        include_once 'Sportif.php';

        // Instancier la base de données et la classe Sportif
        $database = new Database();
        $db = $database->getConnection();

        $sportif = new Sportif($db);

        // Récupérer la liste des sportifs depuis la base de données
        $stmt = $sportif->lire();

        // Vérifier si des sportifs sont présents
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Assurez-vous que les champs existent avant de les extraire
                $ID_sportif = isset($row['ID_sportif']) ? $row['ID_sportif'] : '';
                $Nom = isset($row['Nom']) ? $row['Nom'] : '';
                $Prenom = isset($row['Prénom']) ? $row['Prénom'] : '';
                $Biographie = isset($row['Biographie']) ? $row['Biographie'] : '';
                $Palmares = isset($row['Palmarès']) ? $row['Palmarès'] : '';

                echo "<tr>";
                echo "<td>{$ID_sportif}</td>";
                echo "<td>{$Nom}</td>";
                echo "<td>{$Prenom}</td>";
                echo "<td>{$Biographie}</td>";
                echo "<td>{$Palmares}</td>";
                // echo "<td>";
                // echo "<a href='modifier_sportif.php?id_sportif={$ID_sportif}'>Modifier</a> | ";
                // echo "<a href='supprimer_sportif.php?id_sportif={$ID_sportif}'>Supprimer</a>";
                // echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Aucun sportif trouvé.</td></tr>";
        }
        ?>
    </table>

    <h2>Modifier un sportif</h2>
    <form action="modifier_sportif.php" method="post">
        <label>ID du sportif :</label>
        <input type="number" name="id_sportif" required><br>
        <label>Nom :</label>
        <input type="text" name="nom" required><br>
        <label>Prénom :</label>
        <input type="text" name="prenom" required><br>
        <label>Biographie :</label><br>
        <textarea name="biographie" rows="4" cols="50" required></textarea><br>
        <label>Palmarès :</label><br>
        <textarea name="palmares" rows="4" cols="50" required></textarea><br>
        <input type="submit" value="Modifier">
    </form>

    <h2>Supprimer un sportif</h2>
    <form action="supprimer_sportif.php" method="post">
        <label>ID du sportif :</label>
        <input type="number" name="id_sportif" required><br>
        <input type="submit" value="Supprimer">
    </form>
</body>
</html>