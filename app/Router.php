<?php
namespace Twigproject;

use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Router
{

    // Méthode statique pour définir les routes de l'application.
    public static function getRoutes(): RouteCollection
    {
        // Création d'une nouvelle collection de routes.
        $routes = new RouteCollection();

        // Ajout des routes avec les URL associées aux contrôleurs et méthodes correspondantes.
        $routes->add('home', new Route('/', ['_controller' => 'controllers\\Home::index']));
        $routes->add('database', new Route('/database', ['_controller' => 'controllers\\Database::get']));
        $routes->add('tables', new Route('/database/{database}', ['_controller' => 'controllers\\Table::all']));
        $routes->add('requestsql', new Route('/database/{database}/requestsql', ['_controller' => 'controllers\\SqlRequest::index']));
        $routes->add('structure', new Route('/database/{database}/{table}', ['_controller' => 'controllers\\Table::structure']));
        $routes->add('content', new Route('/database/{database}/{table}/rows', ['_controller' => 'controllers\\Table::content']));
        $routes->add('logout', new Route('/logout', ['_controller' => 'controllers\\Logout::index']));

        // Retourne la collection de routes.
        return $routes;
    }

    // Méthode pour gérer le contrôleur en fonction de l'URL demandée.
    public function controllerFromURL()
    {
        // Charger les routes à partir de la méthode getRoutes() de la même classe.
        $routes = self::getRoutes();

        // Créer un contexte de requête.
        $context = new RequestContext();
        $context->fromRequest(Request::createFromGlobals());

        // Créer un routeur.
        $matcher = new UrlMatcher($routes, $context);
        try {
            // Tenter de faire correspondre l'URL à une route.
            $parameters = $matcher->match($context->getPathInfo());

            // Extraire le contrôleur et la méthode de la route.
            [$controller, $method] = explode('::', $parameters['_controller']);

            // Charger le contrôleur et appeler la méthode avec les paramètres.
            $controller = 'Twigproject\\' . $controller;
            $controllerInstance = new $controller();
            call_user_func_array([$controllerInstance, $method], []);

        } catch (ResourceNotFoundException $e) {
            // Gérer l'erreur 404 Not Found.
            http_response_code(404);
            echo '404 Not Found';

        } catch (MethodNotAllowedException $e) {
            // Gérer l'erreur 405 Method Not Allowed.
            $allowedMethods = $e->getAllowedMethods();
            http_response_code(405);
            echo '405 Method Not Allowed';
        }
    }
}
