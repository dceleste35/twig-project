<?php

use Twig\Environment;
use Twigproject\Route;
use Twig\Loader\FilesystemLoader;
use Twigproject\config\Connexion;
use Twigproject\controllers\Database;

require_once 'vendor/autoload.php';

$loader = new FilesystemLoader('app/views/templates');
$twig = new Environment($loader);

// Définition des routes
$routes = new Route();
$routes->controllerFromURL();

// use Twigproject\config\Connexion;
// use Twig\Environment;
// use Twig\Loader\FilesystemLoader;
// use Twigproject\controllers\Database;

// require_once 'vendor/autoload.php';

// $loader = new FilesystemLoader('app/views/templates');
// $twig = new Environment($loader);

// //Vérifie si la formulaire à été envoyé
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {

//     //Essaye une connexion avec la BDD
//     $result = Connexion::try($_POST);

//     //Si la connexion à réussi on enregistre les valeurs en session
//     if (!$result) {
//         $error = 'Vos identifiants sont incorrect';
//         $data = [
//             'title' => 'Connexion à la base de donnée',
//             'error' => 'Connexion failed'
//         ];
//         echo $twig->render('index.twig.html', $data);
//     }
// }

// //On récupère le parametre de l'url
// $route = ltrim($_SERVER['REQUEST_URI'], '/');

// //Vérifie le chemin à effectuer
// if($route === "database") {
//     $tables = Database::getTables();
//     $template = $twig->load('database.twig.html');
//     echo $template->render([
//         'tables' => $tables,
//         'title' => 'Les tables de la BDD'
//     ]);
// } else {
//     $data = [
//         'title' => 'Connexion à la base de donnée'
//     ];
//     echo $twig->render('index.twig.html', $data);
// }
