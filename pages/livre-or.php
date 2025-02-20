<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/Comment.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$database = new Database();
$db = $database->getConnection();
$commentModel = new Comment($db);

// Traitement de la recherche
$searchQuery = '';
if (!empty($_GET['search'])) {
    $searchQuery = htmlspecialchars($_GET['search']); // Protection contre les injections XSS
    $comment = $commentModel->search($searchQuery);
} else {
    $comment = $commentModel->read();
}
// Pagination
$commentsPerPage = 4; 
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $commentsPerPage;


$totalCommentaires = $commentModel->countComments();
$commentairesParPage = 4;
$totalPages = ceil($totalCommentaires / $commentairesParPage);


if (!empty($_GET['search'])) {
    $comment = $commentModel->search($searchQuery, $commentsPerPage, $offset);
} else {
    $comment = $commentModel->read($commentsPerPage, $offset);
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/livre-or.css">
</head>
<body>
<div class="content-wrapper">
    <header>
    <?php require_once __DIR__ . '/../models/Header.php'; ?>
    </header>

    <h2>Bienvenue sur le livre d'or</h2>

    <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Formulaire pour écrire un commentaire -->
        <form method="POST" action="add_comment.php">
            <textarea name="commentaire" placeholder="Écrivez votre commentaire ici..." required></textarea>
            <button type="submit">Envoyer</button>
        </form>
    <?php else: ?>
        <p>Veuillez vous connecter pour écrire un commentaire.</p>
    <?php endif; ?>
    

    <!-- Recherche par mot-clé -->
    <form action="livre-or.php" method="GET">
        <input type="text" name="search" placeholder="Rechercher un commentaire" value="<?= htmlspecialchars($searchQuery) ?>">
        <button type="submit">Rechercher</button>
    </form>

    <!-- Affichage des commentaires -->
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($comment) && is_array($comment)): ?>
            <?php foreach ($comment as $com): ?>
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
    <!-- Liens de pagination -->
<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1; ?>&search=<?= urlencode($searchQuery) ?>">Précédent</a>
    <?php endif; ?>

    Page <?= $page; ?> / <?= $totalPages; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page + 1; ?>&search=<?= urlencode($searchQuery) ?>">Suivant</a>
    <?php endif; ?>
</div>
</div>


</body>
</html>
