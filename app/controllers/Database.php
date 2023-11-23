<?php

namespace Twigproject\controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twigproject\models\DataModel;
use Twigproject\controllers\Connection;

class Database
{
    // Méthode pour obtenir et afficher les informations sur les bases de données.
    public function get()
    {
        // Création d'une instance du chargeur de fichiers Twig avec le répertoire des modèles.
        $loader = new FilesystemLoader('app/views/templates');

        // Création d'une instance de l'environnement Twig.
        $twig = new Environment($loader);

        // Vérification de la connexion à la base de données à l'aide de la méthode index de la classe Connection.
        if(Connection::index()) {
            // Si la connexion réussit, obtient les informations sur les bases de données à l'aide de la méthode get de la classe DataModel.
            $databases = DataModel::get();

            // Préparation des données à transmettre au template.
            $data = [
                'title' => 'Bases de données',
                'databases' => $databases
            ];

            // Affichage du template database.twig avec les données préparées.
            echo $twig->render('database.twig', $data);
        } else {
            // Si la connexion échoue, redirige vers la page d'accueil.
            header("Location: /");
        }
    }
}
