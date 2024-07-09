<?php
class Commentaire {
    private $id_commentaire;
    private $contenu;
    private $date_commentaire;
    private $id_article;
    private $id_utilisateur;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour initialiser un commentaire
    public function initialize($contenu, $date_commentaire, $id_article, $id_utilisateur) {
        $this->contenu = $contenu;
        $this->date_commentaire = $date_commentaire;
        $this->id_article = $id_article;
        $this->id_utilisateur = $id_utilisateur;
    }

    // Méthode pour insérer un nouveau commentaire
    public function inserer() {
        $sql = "INSERT INTO commentaires (Contenu, Date_commentaire, ID_article, ID_utilisateur) VALUES (:contenu, :date_commentaire, :id_article, :id_utilisateur)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':contenu' => $this->contenu,
            ':date_commentaire' => $this->date_commentaire,
            ':id_article' => $this->id_article,
            ':id_utilisateur' => $this->id_utilisateur,
        ]);
        $this->id_commentaire = $this->pdo->lastInsertId();
    }

    // Méthode pour mettre à jour un commentaire
    public function mettreAJour($id_commentaire) {
        $sql = "UPDATE commentaires SET Contenu = :contenu, Date_commentaire = :date_commentaire, ID_article = :id_article, ID_utilisateur = :id_utilisateur WHERE ID_commentaire = :id_commentaire";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':contenu' => $this->contenu,
            ':date_commentaire' => $this->date_commentaire,
            ':id_article' => $this->id_article,
            ':id_utilisateur' => $this->id_utilisateur,
            ':id_commentaire' => $id_commentaire,
        ]);
    }

    // Méthode pour supprimer un commentaire
    public function supprimer($id_commentaire) {
        $sql = "DELETE FROM commentaires WHERE ID_commentaire = :id_commentaire";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_commentaire' => $id_commentaire]);
    }

    // Méthode pour récupérer un commentaire par ID
    public function recupererParID($id_commentaire) {
        $sql = "SELECT * FROM commentaires WHERE ID_commentaire = :id_commentaire";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_commentaire' => $id_commentaire]);
        $commentaire = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($commentaire) {
            $this->id_commentaire = $commentaire['ID_commentaire'];
            $this->contenu = $commentaire['Contenu'];
            $this->date_commentaire = $commentaire['Date_commentaire'];
            $this->id_article = $commentaire['ID_article'];
            $this->id_utilisateur = $commentaire['ID_utilisateur'];
        }
        return $commentaire;
    }

    // Méthode pour récupérer tous les commentaires
    public function recupererTous() {
        $sql = "SELECT * FROM commentaires";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour afficher un commentaire
    public function afficherCommentaire($commentaire) {
        echo '<div class="commentaire">';
        echo '<h3>Commentaire #' . htmlspecialchars($commentaire['ID_commentaire']) . '</h3>';
        echo '<p><strong>Article ID:</strong> ' . htmlspecialchars($commentaire['ID_article']) . '</p>';
        echo '<p><strong>Utilisateur ID:</strong> ' . htmlspecialchars($commentaire['ID_utilisateur']) . '</p>';
        echo '<p><strong>Date:</strong> ' . htmlspecialchars($commentaire['Date_commentaire']) . '</p>';
        echo '<p>' . nl2br(htmlspecialchars($commentaire['Contenu'])) . '</p>';
        echo '</div>';
    }

    // Méthode pour afficher tous les commentaires
    public function afficherTousLesCommentaires() {
        $commentaires = $this->recupererTous();
        foreach ($commentaires as $commentaire) {
            $this->afficherCommentaire($commentaire);
        }
    }
}

// Exemple d'utilisation de la classe Commentaire
try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=sports', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Création d'un objet Commentaire
    $commentaire = new Commentaire($pdo);
    $commentaire->initialize('Ceci est un commentaire.', '2024-07-09 12:00:00', 1, 1);

    // Insertion du commentaire dans la base de données
    $commentaire->inserer();

    // Mise à jour du commentaire
    $commentaire->initialize('Commentaire mis à jour.', '2024-07-09 12:30:00', 1, 1);
    $commentaire->mettreAJour($commentaire->id_commentaire);

    // Suppression du commentaire
    $commentaire->supprimer($commentaire->id_commentaire);

    // Récupération d'un commentaire par ID
    $commentaire->recupererParID(1);

    // Affichage de tous les commentaires
    $commentaire->afficherTousLesCommentaires();

} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>
