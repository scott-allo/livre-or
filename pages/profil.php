


<?php
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Comment.php';


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <link rel="stylesheet" href="../css/global.css">
</head>
<body>
   
   <?php if(isset($_SESSION['login']) || isset($_SESSION['password']))
                    {
                        echo "<h2>Bonjour ".$_SESSION['login']."</h2>";
                    }
    ?>
                    <p> Cette page possède un formulaire permettant à l’utilisateur de modifier son login et
    son mot de passe. </p>

    <a href="profil.php">Profil</a>
    <a href="commentaire.php">Commentaire</a>
    <a href="register.php">Inscription</a>
    <a href="livre-or.php">Livre d'or</a>
</body>
</html>