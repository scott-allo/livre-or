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
            <form action="action.php" method="post">
   <label>Votre nom :</label>
   <input name="nom" id="nom" type="text" />

   <label>Votre âge :</label>
   <input name="age" id="age" type="number" /></p>

   <button type="submit">Valider</button>
</form>
        </tbody>
    </table>
</div>
</body>
</html>