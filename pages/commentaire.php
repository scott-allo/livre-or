

<?php
require_once __DIR__ . '/../models/Database.php';

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
<div class="body">
            <header>
                <?php
                include($_SERVER['DOCUMENT_ROOT'] . "/livre-or/models/Header.php");

                ?>
            </header>
       
    <p> Un formulaire d’ajout de commentaire (commentaire.php) : ce
formulaire ne contient qu’un champ permettant de rentrer son
commentaire et un bouton de validation. Il n’est accessible qu’aux
utilisateurs connectés. Chaque utilisateur peut poster plusieurs
commentaires. </p>

    <a href="profil.php">Profil</a>
    <a href="commentaire.php">Commentaire</a>
    <a href="register.php">Inscription</a>
    <a href="livre-or.php">Livre d'or</a>
</body>
</html>