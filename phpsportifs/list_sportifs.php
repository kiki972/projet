<?php
include_once 'Database.php';
include_once 'Sportif.php';

$database = new Database();
$db = $database->connect();

$sportif = new Sportif($db);
$result = $sportif->read();

$num = $result->rowCount();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Sportifs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .table-container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container table-container">
        <h2>Liste des Sportifs</h2>
        <?php if ($num > 0) : ?>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Biographie</th>
                        <th>Palmarès</th>
                        <th>Date de création</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars_decode($row['ID_sportif'], ENT_QUOTES); ?></td>
                            <td><?php echo htmlspecialchars_decode($row['Nom'], ENT_QUOTES); ?></td>
                            <td><?php echo htmlspecialchars_decode($row['Prénom'], ENT_QUOTES); ?></td>
                            <td><?php echo htmlspecialchars_decode($row['Biographie'], ENT_QUOTES); ?></td>
                            <td><?php echo htmlspecialchars_decode($row['Palmarès'], ENT_QUOTES); ?></td>
                            <td><?php echo htmlspecialchars_decode($row['Date_creation'], ENT_QUOTES); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Aucun sportif trouvé.</p>
        <?php endif; ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>