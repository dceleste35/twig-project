<?php
namespace Twigproject;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twigproject\controllers\Database;

class Route
{
    private const ROUTES = [
            '/connexion' => 'Connexion::index',
            '/database' => 'Database::getTables',
            '/database/{nom database}/tables/{nom table}' => ''
        ];

    public function controllerFromURL()
    {
        $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (array_key_exists($requestPath, self::ROUTES)) {
            // Récupération du contrôleur et de la méthode à appeler
            list($controller, $method) = explode('::', self::ROUTES[$requestPath]);

            // Appel du contrôleur en utilisant un switch
            switch ($controller) {
                case 'Database':
                    $controllerInstance = new Database();
                    break;
                    // Ajoutez d'autres cas pour chaque contrôleur
                default:
                    // Gestion des erreurs 404 ou autres
                    header('HTTP/1.0 404 Not Found');
                    echo 'Page not found';
                    exit;
            }

            // Appel de la méthode
            $controllerInstance->$method();
        } else {
            $data = [
                'title' => 'Connexion à la base de donnée',
            ];

            $loader = new FilesystemLoader('app/views/templates');
            $twig = new Environment($loader);
            echo $twig->render('index.twig.html', $data);
        }
    }
}
