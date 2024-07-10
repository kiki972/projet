<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partenariat</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .partenariat-section {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            padding: 30px;
            background-size: cover;
            height: 300px;
            opacity: 0.9;
            height: 100vh;
            background-attachment: fixed;
            background-position: center 50%;
        }

        .partner {
            text-align: center;
        }

        .partner img {
            max-width: 100px;
        }
    </style>
</head>
<body>
    <div class="partenariat-section" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://upload.wikimedia.org/wikipedia/commons/4/4d/Stade_louis_achille4.jpg');">
        <?php
        include_once 'Partenaire.php';
        include_once 'Database.php';
        include_once 'PartenaireManager.php';

        $database = new Database();
        $db = $database->getConnection();
        $partenaireManager = new PartenaireManager($db);
        $partenaires = $partenaireManager->getPartenaires();

        foreach ($partenaires as $partenaire) {
            echo '<div class="partner">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($partenaire->getLogo()) . '" alt="Logo ' . $partenaire->getNom() . '">';
            echo '<br>';
            echo '<a href="form_partenariat.php?id=' . $partenaire->getId() . '">Modifier</a>';
            echo '<form action="process_partenariat.php" method="post" style="display:inline;">';
            echo '<input type="hidden" name="id" value="' . $partenaire->getId() . '">';
            echo '<button type="submit" name="action" value="delete">Supprimer</button>';
            echo '</form>';
            echo '</div>';
        }
        ?>
    </div>
    <div>
        <a href="form_partenariat.php">Ajouter un nouveau partenariat</a>
    </div>
</body>
</html>