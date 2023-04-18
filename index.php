<?php

require_once 'controllers/HomeController.php';
require_once 'controllers/CategoryController.php';
require_once 'controllers/ArticleController.php';

$url = isset($_GET['url']) ? $_GET['url'] : '';
$url = rtrim($url, '/');
$url = explode('/', $url);

$controller = '';
$method = '';
$params = array();

switch ($url[0]) {
    case 'category':
        $controller = new CategoryController();
        $method = isset($url[1]) ? $url[1] : 'index';
        if ($method == 'article' && isset($url[2])) {
            $controller = new ArticleController();
            $method = $url[2];
        }
        break;
    case '':
        $controller = new HomeController();
        $method = 'index';
        break;
    default:
        http_response_code(404);
        exit('Erreur 404 : Page non trouvée.');
}

if (!empty($controller)) {
    if (method_exists($controller, $method)) {
        if (isset($url[3])) {
            $params = array_slice($url, 3);
        }
        call_user_func_array([$controller, $method], $params);
    } else {
        http_response_code(404);
        exit('Erreur 404 : Méthode non trouvée.');
    }
}