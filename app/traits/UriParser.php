<?php
namespace Twigproject\traits;

trait UriParser
{
    // Méthode statique pour obtenir le nom de la base de données à partir de l'URI.
    public static function getDatabase()
    {
        // Récupération de l'URI actuelle depuis la superglobale $_SERVER.
        $uri = $_SERVER['REQUEST_URI'];

        // Explosion de l'URI en un tableau en utilisant le séparateur '/'.
        $uriArray = explode('/', $uri);

        // Retourne le deuxième élément du tableau, qui devrait être le nom de la base de données.
        return $uriArray[2];
    }

    // Méthode non statique pour obtenir le nom de la table à partir de l'URI.
    public function getTable()
    {
        // Récupération de l'URI actuelle depuis la superglobale $_SERVER.
        $uri = $_SERVER['REQUEST_URI'];

        // Explosion de l'URI en un tableau en utilisant le séparateur '/'.
        $uriArray = explode('/', $uri);

        // Retourne le troisième élément du tableau, qui devrait être le nom de la table.
        return $uriArray[3];
    }
}
