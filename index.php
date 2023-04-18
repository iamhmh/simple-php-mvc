<?php

require_once 'controllers/HomeController.php'; // on va chercher le fichier HomeController.php
require_once 'controllers/CategoryController.php'; // on va chercher le fichier CategoryController.php
require_once 'controllers/ArticleController.php'; // on va chercher le fichier ArticleController.php

$url = isset($_GET['url']) ? $_GET['url'] : ''; // on récupère l'url
$url = rtrim($url, '/'); // on supprime les slashs de fin d'url
$url = explode('/', $url); // on sépare l'url en tableau

$controller = ''; // on initialise la variable controller
$method = ''; // on initialise la variable method
$params = array(); // on initialise la variable params en tableau

switch ($url[0]) { // on récupère le premier élément du tableau
    case 'category': // si c'est category
        $controller = new CategoryController(); // on instancie la classe CategoryController
        $method = isset($url[1]) ? $url[1] : 'index'; // si l'url contient un deuxième élément, on récupère le deuxième élément, sinon on récupère index
        if ($method == 'article' && isset($url[2])) { // si le deuxième élément est article et qu'il y a un troisième élément
            $controller = new ArticleController(); // on instancie la classe ArticleController
            $method = $url[2]; // on récupère le troisième élément de l'url
        }
        break; // on sort du switch
    case '': // si l'url est vide
        $controller = new HomeController(); // on instancie la classe HomeController
        $method = 'index'; // on récupère la méthode index
        break; // on sort du switch
    default: // si l'url ne correspond à aucune des conditions
        http_response_code(404); // on renvoie un code 404
        exit('Erreur 404 : Page non trouvée.'); // on arrête le script
}

if (!empty($controller)) { // si la variable controller n'est pas vide (donc si elle a été instanciée)
    if (method_exists($controller, $method)) { // si la méthode existe dans la classe instanciée
        if (isset($url[3])) { // si l'url contient un quatrième élément (donc si il y a des paramètres)
            $params = array_slice($url, 3); // on récupère les éléments à partir du quatrième élément de l'url
        } 
        call_user_func_array([$controller, $method], $params); // on appelle la méthode avec les paramètres en tableau
    } else { // si la méthode n'existe pas dans la classe instanciée
        http_response_code(404); // on renvoie un code 404
        exit('Erreur 404 : Méthode non trouvée.'); // on arrête le script
    }
}