<?php
require_once __DIR__ . '/../models/Database.php';

class User {
    private $pdo;

    public function __construct(Database $database) {
        $this->pdo = $database->getConnection();
    }

    // Fonction pour enregistrer un utilisateur
    public function register($login, $password) {
        if (empty($login) || empty($password)) {
            return "Veuillez remplir tous les champs.";
        }

        $login = trim(htmlspecialchars($login));

        // Vérifier si l'utilisateur existe déjà
        $sql = "SELECT id FROM admin WHERE login = :login";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':login' => $login]);

        if ($stmt->fetch()) {
            return "Ce nom d'utilisateur est déjà pris.";
        }

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO admin (login, password) VALUES (:login, :password)";
        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute([
                ':login' => $login,
                ':password' => $hashed_password,
            ]);
            return "Utilisateur enregistré avec succès !";
        } catch (PDOException $e) {
            return "Erreur lors de l'enregistrement.";
        }
    }

    // Fonction de connexion
    public function login($login, $password) {
        $login = trim(htmlspecialchars($login));

        $sql = "SELECT * FROM admin WHERE login = :login";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':login' => $login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['login'] = $user['login'];
            return "Connexion réussie !";
        } else {
            return "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }
}

// Gestion de l'inscription et de l'authentification
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $database = new Database();
    $user = new User($database);

    if (isset($_POST['register'])) {
        $message = $user->register($_POST['login'], $_POST['password']);
    } elseif (isset($_POST['login'])) {
        $message = $user->login($_POST['login'], $_POST['password']);
    }
    echo $message;
}

// Vérification si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Création de l'instance de Database et User
    $database = new Database();
    $user = new User($database);

    // Tentative de connexion
    $message = $user->login($_POST['login'], $_POST['password']);
    
    // Si la connexion est réussie, rediriger vers database.php
    if ($message === "Connexion réussie") {  // Assure-toi que ta méthode login retourne ce message ou un indicateur de succès
        header("Location: database.php");
        exit();  // Important pour arrêter l'exécution du script après la redirection
    }
}
?>
