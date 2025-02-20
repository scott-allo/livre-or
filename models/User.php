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
        $sql = "SELECT id FROM user WHERE login = :login";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':login' => $login]);

        if ($stmt->fetch()) {
            return "Ce nom d'utilisateur est déjà pris.";
        }

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO user (login, password) VALUES (:login, :password)";
        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute([
                ':login' => $login,
                ':password' => $hashed_password,
            ]);
            return "Utilisateur enregistré avec succès !";
        } catch (PDOException $e) {
            return "Erreur lors de l'enregistrement : " . $e->getMessage();
        }
    }

    // Fonction de connexion
    public function login($login, $password) {
        $login = trim(htmlspecialchars($login));

        $sql = "SELECT id, login, password FROM user WHERE login = :login";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':login' => $login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['login'] = $user['login'];

            if ($user['login'] === 'moderator') {
                header("Location: moderateur.php");
                exit();
            } else {
                header("Location: profil.php");
                exit();
            }
        } else {
            return "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }

    public function getUserById($id) {
        $sql = "SELECT id, login FROM user WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $newLogin, $newPassword) {
        if (empty($newLogin) || empty($newPassword)) {
            return "Veuillez remplir tous les champs.";
        }
    
        $newLogin = trim(htmlspecialchars($newLogin));
        $hashed_password = password_hash($newPassword, PASSWORD_BCRYPT);
    
        $sql = "UPDATE user SET login = :login, password = :password WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
    
        try {
            $stmt->execute([
                ':login' => $newLogin,
                ':password' => $hashed_password,
                ':id' => $id,
            ]);
            return "Profil mis à jour avec succès !";
        } catch (PDOException $e) {
            return "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    }
}
?>