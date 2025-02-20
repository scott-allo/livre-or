<?php



require_once __DIR__ . '/../models/Database.php';

class Comment {
    private $pdo;
    private $table = "comment";

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Ajouter un commentaire (nécessite d'être connecté)
    public function create($comment) {
        if (!isset($_SESSION['user_id'])) {
            return ["success" => false, "message" => "Vous devez être connecté pour ajouter un commentaire."];
        }

        $id_user = $_SESSION['user_id']; // Récupérer l'ID utilisateur depuis la session

        try {
            $query = "INSERT INTO " . $this->table . " (id_user, comment, date) VALUES (:id_user, :comment, NOW())";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
            $stmt->bindParam(":comment", $comment, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return ["success" => true, "message" => "Commentaire ajouté avec succès."];
            }
            return ["success" => false, "message" => "Échec de l'ajout du commentaire."];
        } catch (PDOException $e) {
            return ["success" => false, "message" => "Erreur SQL : " . $e->getMessage()];
        }
    }
    public function read($limit = 4, $offset = 0) {
        try {
            $query = "
                SELECT c.id, u.login, c.comment, c.date 
                FROM " . $this->table . " c
                JOIN user u ON c.id_user = u.id
                ORDER BY c.date DESC 
                LIMIT :limit OFFSET :offset";
    
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur SQL : " . $e->getMessage());
            return [];
        }
    }
    public function countComments() {
        try {
            $query = "SELECT COUNT(*) as total FROM " . $this->table;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (PDOException $e) {
            error_log("Erreur SQL : " . $e->getMessage());
            return 0;
        }
    }
    
    
    

    // Mettre à jour un commentaire
    public function update($id, $comment) {
        try {
            $query = "UPDATE " . $this->table . " SET comment = :comment WHERE id = :id";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":comment", $comment, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return ["success" => true, "message" => "Mise à jour réussie."];
            }
            return ["success" => false, "message" => "Échec de la mise à jour."];
        } catch (PDOException $e) {
            return ["success" => false, "message" => "Erreur SQL : " . $e->getMessage()];
        }
    }

    // Supprimer un commentaire
    public function delete($id) {
        try {
            $query = "DELETE FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return ["success" => true, "message" => "Suppression réussie."];
            }
            return ["success" => false, "message" => "Échec de la suppression."];
        } catch (PDOException $e) {
            return ["success" => false, "message" => "Erreur SQL : " . $e->getMessage()];
        }
    }

    public function search($keyword) {
        try {
            $query = "
                SELECT c.id, u.login, c.comment, c.date 
                FROM " . $this->table . " c
                JOIN user u ON c.id_user = u.id
                WHERE c.comment LIKE :keyword
                ORDER BY c.date DESC";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur SQL : " . $e->getMessage());
            return [];
        }
    }
    
}
