<?php

require_once __DIR__ . '/../models/Database.php';
class Comment {
    private $pdo;
    private $table = "comments";

    public $id;
    public $topic_id;
    public $comment_txt;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    // Créer une comment
    public function create() {
        try {
            $query = "INSERT INTO " . $this->table . " (topic_id, comment_txt) VALUES (:topic_id, :comment_txt)";
            $stmt = $this->pdo->prepare($query);

            // Sécuriser les entrées
            $this->topic_id = htmlspecialchars(strip_tags($this->topic_id));
            $this->comment_txt = htmlspecialchars(strip_tags($this->comment_txt));

            $stmt->bindParam(":topic_id", $this->topic_id);
            $stmt->bindParam(":comment_txt", $this->comment_txt);

            if ($stmt->execute()) {
                return ["success" => true, "message" => "comment ajoutée avec succès."];
            }
            return ["success" => false, "message" => "Échec de l'ajout de la comment."];
        } catch (PDOException $e) {
            return ["success" => false, "message" => "Erreur SQL : " . $e->getMessage()];
        }
    }

    // Lire toutes les comments
    public function read() {
        try {
            $query = "SELECT * FROM " . $this->table;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            return ["success" => false, "message" => "Erreur lors de la récupération : " . $e->getMessage()];
        }
    }

    // Mettre à jour un comment
    public function update() {
        try {
            $query = "UPDATE " . $this->table . " SET comment_txt = :comment_txt WHERE id = :id";
            $stmt = $this->pdo->prepare($query);


            $this->comment_txt = htmlspecialchars(strip_tags($this->comment_txt));
            $this->id = htmlspecialchars(strip_tags($this->id));

         
            $stmt->bindParam(":comment_txt", $this->comment_txt);
            $stmt->bindParam(":id", $this->id);

            if ($stmt->execute()) {
                return ["success" => true, "message" => "Mise à jour réussie."];
            }
            return ["success" => false, "message" => "Échec de la mise à jour."];
        } catch (PDOException $e) {
            return ["success" => false, "message" => "Erreur SQL : " . $e->getMessage()];
        }
    }

    // Supprimer un comment
    public function delete() {
        try {
            $query = "DELETE FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->pdo->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bindParam(":id", $this->id);

            if ($stmt->execute()) {
                return ["success" => true, "message" => "Suppression réussie."];
            }
            return ["success" => false, "message" => "Échec de la suppression."];
        } catch (PDOException $e) {
            return ["success" => false, "message" => "Erreur SQL : " . $e->getMessage()];
        }
    }
}