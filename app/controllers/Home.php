<?php

namespace Twigproject\controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Home
{
    // Méthode pour afficher la page d'accueil.
    public function index()
    {
        // Préparation des données à transmettre au template.
        $data = [
            'title' => 'Page de connexion'
        ];

        // Création d'une instance du chargeur de fichiers Twig avec le répertoire des modèles.
        $loader = new FilesystemLoader('app/views/templates');

        // Création d'une instance de l'environnement Twig.
        $twig = new Environment($loader);

        // Affichage du template index.twig avec les données préparées.
        echo $twig->render('index.twig', $data);
    }
}
