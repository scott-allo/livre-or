<?php
session_start();

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/Comment.php';
require_once __DIR__ . '/../models/User.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Connexion à la base de données
$database = new Database();
$db = $database->getConnection();
$commentModel = new Comment($db);

// Suppression d'un commentaire si demandé
$message = '';
if (isset($_POST['delete_id'])) {
    $deleteResult = $commentModel->delete($_POST['delete_id']);
    // Message après suppression
    $message = $deleteResult['message']; // Assure-toi que delete() retourne ce message
}

// Récupérer et afficher les commentaires
$comments = $commentModel->read();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des commentaires</title>
    <link rel="stylesheet" href="../css/moderateur.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Lora:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>

<!-- Menu de navigation -->
<nav>
    <ul>
        <li><a href="../index.php">Retour au site</a></li>
        <li><a href="../pages/moderateur.php">Gestion des commentaires</a></li>
        <li><a href="../pages/logout.php">Déconnexion</a></li>
    </ul>
</nav>

<div class="content-wrapper">
    <h1>Modération des commentaires</h1>

    <!-- Affichage du message après la table -->
    <table>
        <thead>
            <tr>
                <th>Nom d'utilisateur</th>
                <th>Commentaire</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td><?= htmlspecialchars($comment['login']) ?></td>
                        <td><?= htmlspecialchars($comment['comment']) ?></td>
                        <td><?= htmlspecialchars($comment['date']) ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="delete_id" value="<?= $comment['id'] ?>">
                                <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ce commentaire ?')">🗑️ Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Aucun commentaire disponible.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Affichage du message de succès ou d'erreur après suppression -->
    <?php if (!empty($message)): ?>
        <p class="success-message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
</div>

</body>
</html>