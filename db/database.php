<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            // on pointe vers le fichier SQLite
            $this->pdo = new PDO("sqlite:" . __DIR__ . "/portfolio.db");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur connexion BDD : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}
?>
