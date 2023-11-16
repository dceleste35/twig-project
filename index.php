<?php

use Twigproject\config\Connexion;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twigproject\controllers\Database;

require_once 'vendor/autoload.php';

//Chargement de la config
$loader = new FilesystemLoader('app/views/templates');
$twig = new Environment($loader);

//Instanciation du router
$router = new Router();
//Instanciation du controller
$controller = $router->controllerFromURL();
//Generation de la réponse
$response = $controller->execute();
//Envoi de la réponse
http_response_code(200);
echo $response;
