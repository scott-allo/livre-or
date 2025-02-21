<?php
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/Comment.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if (!isset($_SESSION['user_id'])) {
        echo "Vous devez être connecté pour ajouter un commentaire.";
        exit;
    }

    // Vérifier si le champ "comment" existe dans $_POST avant de l'utiliser
    if (!isset($_POST['commentaire'])) {
        echo "Erreur : le champ commentaire est manquant.";
        exit;
    }

   
    $commentContent = trim($_POST['commentaire']); // Supprime les espaces au début et à la fin

    if (empty($commentContent)) {
        echo "Le commentaire ne peut pas être vide.";
        exit;
    }

   
    $database = new Database();
    $db = $database->getConnection();
    $commentModel = new Comment($db);

    // Ajout du commentaire
    $result = $commentModel->create($commentContent);

    // Redirection ou message de confirmation
    if ($result['success']) {
        header('Location: livre-or.php'); // Redirection vers la page principale après ajout
        exit;
    } else {
        echo "Erreur : " . $result['message'];
    }
}
