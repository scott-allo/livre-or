<?php
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/Comment.php';

$database = new Database();
$db = $database->getConnection();
$commentModel = new Comment($db);
$comments = $commentModel->read();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <link rel="stylesheet" href="/livre-or/css/global.css"/>
</head>
<body>
<div class="content-wrapper">
    <header>
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/livre-or/models/Header.php"); ?>
    </header>

    <h2>Ajouter un message</h2>
<form action="add_comment.php" method="POST">
    <label for="id_user">Nom :</label>
    <input type="text" id="id_user" name="id_user" required>

    <label for="comment">Message :</label>
    <textarea id="comment" name="comment" required></textarea>

    <button type="submit">Envoyer</button>
</form>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Messages</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($comments) && is_array($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td><?= htmlspecialchars($comment['id_user']) ?></td>
                        <td><?= htmlspecialchars($comment['comment']) ?></td>
                        <td><?= htmlspecialchars($comment['date']) ?></td>
                
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Aucun message pour le moment.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>