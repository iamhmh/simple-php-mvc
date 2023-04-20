<?php

require_once 'Database.php';

class Article {
    private $db; // je crée une variable qui va contenir la connexion à la base de données

    public function __construct() {  // je crée un constructeur qui va me permettre de récupérer la connexion à la base de données
        $this->db = Database::getInstance()->getConnection(); // je récupère la connexion à la base de données
    }

    public function getAllArticles() { // je crée une méthode qui va me permettre de récupérer tous les articles
        $art = $this->db->prepare("SELECT * FROM articles"); // je prépare ma requête
        $art->execute(); // j'exécute ma requête
        return $art->fetchAll(PDO::FETCH_ASSOC); // je retourne le résultat de ma requête
    }
}