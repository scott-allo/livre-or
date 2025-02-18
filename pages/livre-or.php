<?php
require_once __DIR__ . '/../models/Database.php';

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <p> Voir tous les commentaires du livre d'or </p>

    Sur cette page
on voit l’ensemble des commentaires, organisés du plus récent au plus
ancien. Chaque commentaire doit être composé d’un texte “posté le
"jour/mois/année” par l’utilisateur suivi du commentaire. Si l’utilisateur 
est connecté, sur cette page figure également un lien vers la page
d’ajout de commentaire. Un système de pagination doit être
implémenté pour améliorer la lisibilité du livre d’or.
</body>
</html>