<?php
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/User.php';

$message = ''; // Initialisation du message

$database = new Database();
$user = new User($database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        // Gestion de l'inscription
        if ($_POST['password'] !== $_POST['confirm_password']) {
            $message = "Les mots de passe ne correspondent pas.";
        } else {
            $message = $user->register($_POST['username'], $_POST['password']);
            if ($message === "Inscription réussie") {
                $message = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            }
        }
    } elseif (isset($_POST['login'])) {
        // Gestion de la connexion
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username === "moderator" && $password === "Ioipb*(&(*^970") {
            session_start();
            $_SESSION['username'] = "moderator";
            header("Location: moderateur.php"); // Redirection pour le modérateur
            exit();
        } else {
            $loginMessage = $user->login($username, $password);
            if ($loginMessage === "Connexion réussie") {
                session_start();
                $_SESSION['username'] = $username;
                header("Location: profil.php"); // Redirection pour les autres utilisateurs
                exit();
            } else {
                $message = "Nom d'utilisateur ou mot de passe incorrect.";
            }
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
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
    <div class="body">
            <header>
                <?php
                include($_SERVER['DOCUMENT_ROOT'] . "/livre-or/models/Header.php");

                ?>
            </header>
       

    <div class="auth-section">
        <h2>Connexion</h2>
        <p>Connectez-vous pour accéder à votre compte.</p>

        <!-- Formulaire de connexion -->
        <form action="register.php" method="POST">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required>

            <button type="submit" name="login">Se connecter</button>
        </form>
    </div>

    <div class="container">
        <h2>Créer un compte</h2>
        <form action="register.php" method="POST">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required>

            <label for="confirm_password">Confirmez le mot de passe :</label>
            <input type="password" name="confirm_password" id="confirm_password" required>

            <button type="submit" name="register">S'enregistrer</button>
        </form>
    </div>

    <!-- Affichage des messages d'erreur ou de succès -->
    <?php if (!empty($message)) : ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

</body>
</html>