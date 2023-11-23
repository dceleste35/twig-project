<?php


use Twig\Environment;
use Twigproject\Router;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

$loader = new FilesystemLoader('app/views/templates');
$twig = new Environment($loader);

// Namespace dans une constante
defined('NAMESPACE_CONTROLLER') ?: define('NAMESPACE_CONTROLLER', 'Twigproject\\controllers\\');

// Définition des routes
$routes = new Router();
$routes->controllerFromURL();
