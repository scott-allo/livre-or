<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/User.php';

$message = '';

$database = new Database();
$user = new User($database);

// Vérification de l'état de connexion
if (isset($_SESSION['username'])) {
    // Si l'utilisateur est déjà connecté, redirection vers commentaire.php
    header("Location: commentaire.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (isset($_POST['register'])) {
        // Vérification des mots de passe
        $confirmPassword = trim($_POST['confirm_password'] ?? '');
        if ($password !== $confirmPassword) {
            $message = "Les mots de passe ne correspondent pas.";
        } else {
            $message = $user->register($username, $password);
            if ($message === "Inscription réussie") {
                $message = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            }
        }
    } elseif (isset($_POST['login'])) {
        // Connexion du modérateur
        if ($username === "moderator" && $password === "Ioipb*(&(*^970") {
            $_SESSION['username'] = "moderator";
            header("Location: moderateur.php");
            exit();
        }

        // Connexion des utilisateurs normaux
        $loginMessage = $user->login($username, $password);
        if ($loginMessage === "Connexion réussie") {
            $_SESSION['username'] = $username;
            header("Location: commentaire.php"); // Redirection vers commentaire.php après connexion
            exit();
        } else {
            $message = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription & Connexion</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="content-wrapper">
        <header>
            <?php include __DIR__ . '/../models/Header.php'; ?>
        </header>

        <section id="auth">
            <!-- Section Connexion -->
            <div class="auth-section">
                <h3>Connexion</h3>
                <p>Connectez-vous pour accéder à votre compte.</p>

                <form action="login.php" method="POST">
                    <label for="login-username">Nom d'utilisateur :</label>
                    <input type="text" name="username" id="login-username" required>

                    <label for="login-password">Mot de passe :</label>
                    <input type="password" name="password" id="login-password" required>

                    <button type="submit" name="login">Se connecter</button>
                </form>

                <!-- Lien pour ouvrir le modal d'inscription -->
                <a href="#register-modal" class="register-link">Créer un compte</a>
            </div>
        </section>

        <!-- MODAL D'INSCRIPTION -->
        <div id="register-modal" class="modal">
            <div class="modal-content">
                <a href="#" class="modal-close">&times;</a>
                <h3>Créer un compte</h3>
                <form action="login.php" method="POST">
                    <label for="register-username">Nom d'utilisateur :</label>
                    <input type="text" name="username" id="register-username" required>

                    <label for="register-password">Mot de passe :</label>
                    <input type="password" name="password" id="register-password" required>

                    <label for="confirm-password">Confirmez le mot de passe :</label>
                    <input type="password" name="confirm_password" id="confirm-password" required>

                    <button type="submit" name="register">S'enregistrer</button>
                </form>
            </div>
        </div>

        <!-- Affichage des messages d'erreur ou de succès -->
        <?php if (!empty($message)) : ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
