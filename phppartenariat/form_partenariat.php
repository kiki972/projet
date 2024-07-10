<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Partenariats</title>
</head>
<body>
    <h1>Ajouter/Modifier un Partenariat</h1>
    <form action="process_partenariat.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo isset($partenaire) ? $partenaire->getId() : ''; ?>">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo isset($partenaire) ? $partenaire->getNom() : ''; ?>" required><br>
        <label for="logo">Logo:</label>
        <input type="file" id="logo" name="logo" <?php echo !isset($partenaire) ? 'required' : ''; ?>><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo isset($partenaire) ? $partenaire->getDescription() : ''; ?></textarea><br>
        <button type="submit" name="action" value="add">Ajouter</button>
        <button type="submit" name="action" value="update">Mettre à jour</button>
    </form>
</body>
</html>