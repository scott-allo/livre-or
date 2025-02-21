<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Database.php';


$database = new Database();
$user = new User($database);


if (isset($_SESSION['username'])) {
    header("Location: commentaire.php");
    exit();
}

$message = ''; // Initialisation de la variable pour stocker les messages

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération et nettoyage des entrées
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($username) && !empty($password)) {
        // Appel de la fonction de connexion
        $loginMessage = $user->login($username, $password);

        if ($loginMessage === "Connexion réussie") {
            $_SESSION['username'] = $username;

            // Vérifier le rôle et rediriger
            if ($_SESSION['login'] === "moderator") {
                header("Location: moderateur.php");
                exit();
            }

           
            header("Location: livre-or.php");
            exit();
        } else {
            $message = $loginMessage; 
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
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

                <!-- Affichage des messages d'erreur ou de succès -->
                <?php if (!empty($message)) : ?>
                    <p class="message"><?php echo htmlspecialchars($message); ?></p>
                <?php endif; ?>
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
    </div>
</body>
</html>
