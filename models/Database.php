<?php
class Database {
    private $conn;
    //  private $username = 'oliviadondas';
   // private $password = 'kzCFKQbU3N@t9j7';

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=localhost;dbname=olivia-dondas_livreor",
                "root",
                "root",
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
                    PDO::ATTR_EMULATE_PREPARES => false, 
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4" 
                ]
            );
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>