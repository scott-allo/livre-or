
<?php
require_once '../models/Database.php';
require_once '../models/User.php';

session_start();

$database = new Database();
$user = new User($database);

$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    header("Location: login.php");
    exit();
}

// Récupérer les infos de l'utilisateur
$userData = $user->getUserById($userId);

// Traitement de la mise à jour du profil
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newLogin = $_POST['login'] ?? '';
    $newPassword = $_POST['password'] ?? '';

    $message = $user->updateUser($userId, $newLogin, $newPassword);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/profil.css">
    <title>Profil</title>
</head>
<body>
    <section class="content-wrapper">
    <header>
                <?php
                include($_SERVER['DOCUMENT_ROOT'] . "/livre-or/models/Header.php");

                ?>
            </header>
    <h1>Profil de <?php echo htmlspecialchars($userData['login']); ?></h1>

    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="login">Nouveau login :</label>
        <input type="text" name="login" id="login" value="<?php echo htmlspecialchars($userData['login']); ?>" required>
        
        <label for="password">Nouveau mot de passe :</label>
        <input type="password" name="password" id="password" required>
        
        <button type="submit">Mettre à jour</button>
    </form>

    <a href="logout.php">Se déconnecter</a>
    </section>
</body>
</html>

