<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/Comment.php';
require_once __DIR__ . '/../models/User.php';

// Vérifie si l'utilisateur est connecté (modifie selon ta logique)
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Connexion à la base de données
$database = new Database();
$db = $database->getConnection();
$commentModel = new Comment($db);

// Suppression d'un commentaire si demandé
if (isset($_POST['delete_id'])) {
    $deleteResult = $commentModel->delete($_POST['delete_id']);
    echo $deleteResult['message'];
}

// Récupérer et afficher les commentaires
$comments = $commentModel->read();
foreach ($comments as $comment) {
    echo "<p>" . htmlspecialchars($comment['comment']) . "</p>";
    echo "<form method='POST'>
            <input type='hidden' name='delete_id' value='" . $comment['id'] . "'>
            <button type='submit'>Supprimer</button>
          </form>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des commentaires</title>
    <link rel="stylesheet" href="/livre-or/css/moderateur.css">
</head>
<body>

<!-- Menu de navigation -->
<nav>
    <ul>
        <li><a href="/livre-or/index.php">Retour au site</a></li>
        <li><a href="/livre-or/pages/moderateur.php">Gestion des commentaires</a></li>
        <li><a href="/livre-or/pages/profile.php">Mon profil</a></li>
        <li><a href="/livre-or/pages/logout.php">Déconnexion</a></li>
    </ul>
</nav>

<div class="content-wrapper">
    <h1>Modération des commentaires</h1>

    <?php if (isset($message)): ?>
        <p class="success-message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

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
                        <td><?= htmlspecialchars($comment['id_user']) ?></td>
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
</div>

</body>
</html>