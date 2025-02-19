<?php

require_once __DIR__ . '/../models/Database.php';

class Comment {
    private $pdo;
    private $table = "comments";

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Ajouter un commentaire
    public function create($id_user, $comment) {
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

    // Lire tous les commentaires
    public function read() {
        try {
            $query = "SELECT * FROM " . $this->table . " ORDER BY date DESC";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["success" => false, "message" => "Erreur lors de la récupération : " . $e->getMessage()];
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
}