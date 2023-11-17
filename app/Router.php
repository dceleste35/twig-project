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

    public static function getRoutes(): RouteCollection
    {
        $routes = new RouteCollection();

        $routes->add('home', new Route('/', ['_controller' => 'controllers\\Home::index']));
        $routes->add('database', new Route('/database', ['_controller' => 'controllers\\Database::index']));
        $routes->add('tables', new Route('/database/{database}', ['_controller' => 'controllers\\Database::tables']));
        $routes->add('structure', new Route('/database/{database}/{table}', ['_controller' => 'controllers\\Table::structure']));
        $routes->add('content', new Route('/database/{database}/{table}/rows', ['_controller' => 'controllers\\Table::content']));

        return $routes;
    }

    public function controllerFromURL()
    {
        // Charger les routes à partir de la méthode getRoutes() de la même classe
        $routes = self::getRoutes();

        // Créer un contexte de requête
        $context = new RequestContext();
        $context->fromRequest(Request::createFromGlobals());

        // Créer un routeur
        $matcher = new UrlMatcher($routes, $context);

        try {
            $parameters = $matcher->match($context->getPathInfo());

            var_dump($parameters);
            // Extraire le contrôleur et la méthode
            [$controller, $method] = explode('::', $parameters['_controller']);

            // Charger le contrôleur et appeler la méthode avec les paramètres
            $controller = 'Twigproject\\' . $controller;
            $controllerInstance = new $controller();
            call_user_func_array([$controllerInstance, $method], []);

        } catch (ResourceNotFoundException $e) {
            // 404 Not Found
            http_response_code(404);
            echo '404 Not Found';

        } catch (MethodNotAllowedException $e) {
            // 405 Method Not Allowed
            $allowedMethods = $e->getAllowedMethods();
            http_response_code(405);
            echo '405 Method Not Allowed';
        }
    }
}
