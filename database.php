<?php

require_once 'config.php'; // je vais chercher le fichier config.php

class Database {
    private static $instance = null; // je crée une variable qui va contenir l'instance de la classe Database
    private $connection; // je crée une variable qui va contenir la connexion à la base de données

    private function __construct() { // je crée un constructeur privé pour empêcher l'instanciation de la classe
        $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); // je crée une connexion à la base de données
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // je configure la connexion pour qu'elle lance des exceptions en cas d'erreur
    }

    public static function getInstance() { // je crée une méthode qui va me permettre d'instancier la classe
        if (!self::$instance) { // si l'instance n'existe pas
            self::$instance = new Database(); // je l'instancie
        }
        return self::$instance; // je retourne l'instance
    }

    public function getConnection() { // je crée une méthode qui va me permettre de récupérer la connexion à la base de données
        return $this->connection; // je retourne la connexion
    }
}