<?php
session_start();

// Détruire toutes les données de session
session_unset();

// Détruire la session
session_destroy();

// Rediriger l'utilisateur vers la page de connexion avec un message de confirmation
header("Location: login.php?logout=success");
exit();
?>