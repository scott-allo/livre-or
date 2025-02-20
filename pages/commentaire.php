<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/Comment.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérification de la connexion
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, redirection vers livre-or.php
    header("Location: livre-or.php");
    exit();
}

// Connexion à la base
$database = new Database();
$db = $database->getConnection();
$commentModel = new Comment($db);

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['comment'])) {
    $newComment = htmlspecialchars($_POST['comment']);
    $result = $commentModel->create($newComment);

    if ($result['success']) {
        $message = "Votre commentaire a été ajouté avec succès.";
    } else {
        $message = $result['message'];
    }
}

// Récupération des commentaires
$comments = $commentModel->read();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commentaire</title>
    <link rel="stylesheet" href="/livre-or/css/global.css">
    <link rel="stylesheet" href="/livre-or/css/commentaire.css">
</head>
<body>
<div class="content-wrapper">
    <header>
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/livre-or/models/Header.php"); ?>
    </header>

    <!-- Message de retour après ajout de commentaire -->
    <?php if (isset($message)): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <!-- Formulaire pour écrire un commentaire -->
    <form action="commentaire.php" method="POST">
        <label for="comment">Votre commentaire :</label>
        <textarea id="comment" name="comment" required></textarea>
        <button type="submit">Envoyer</button>
    </form>

    <!-- Affichage des commentaires -->
    <h2>Commentaires</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($comments) && is_array($comments)): ?>
            <?php foreach ($comments as $com): ?>
                <tr>
                    <td><?= htmlspecialchars($com['login']) ?></td>
                    <td><?= htmlspecialchars($com['comment']) ?></td>
                    <td><?= htmlspecialchars($com['date']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Aucun commentaire trouvé.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
