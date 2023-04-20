<?php
require_once 'models/Article.php'; 

class ArticleController {
    private $articleModel; 

    public function __construct() { // je crée un constructeur qui va me permettre d'instancier la classe Article
        $this->articleModel = new Article(); // je crée une instance de la classe Article
    }

    public function page_1() {
        $articles = $this->articleModel->getAllArticles(); // je récupère tous les articles
        require_once 'views/page_1.php'; 
    }

    public function page_2() {
        require_once 'views/page_2.php';
    }

    public function page_3() {
        require_once 'views/page_3.php';
    }
}