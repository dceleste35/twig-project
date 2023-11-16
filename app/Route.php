<?php

namespace Twigproject;

class Router
{
    //Tes routes : map entre Methode+URL et Un controleur
    private const ROUTES = [];

    //Retourne des arguments sur l'URL s'il y'en a
    private function argsFromURL()
    {
    }

    //Inspecte la requête, regarde dans ROUTES et retourne le controler,
    //Une réponse avec le status 404 sinon
    public function controllerFromURL()
    {
    }
}
