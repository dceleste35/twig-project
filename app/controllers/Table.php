<?php
namespace Twigproject\controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twigproject\traits\UriParser;
use Twigproject\models\TableModel;

class Table
{
    use UriParser;

    // Méthode pour afficher toutes les tables d'une base de données.
    public function all()
    {
        // Création d'une instance du chargeur de fichiers Twig avec le répertoire des modèles.
        $loader = new FilesystemLoader('app/views/templates');
        $twig = new Environment($loader);

        // Obtention du nom de la base de données à partir de l'URI.
        $database = self::getDatabase();

        // Tentative de seconde connexion à la base de données avec la méthode secondConnection de la classe Connection.
        $connection = Connection::secondConnection();

        // Vérification de la connexion à la base de données.
        if($connection) {
            // Obtention de la liste de toutes les tables de la base de données.
            $tables = TableModel::all();

            // Préparation des données pour le template.
            $data = [
                'title' => 'Tables de ' . $database,
                'tables' => $tables,
                'database' => $database
            ];

            // Affichage du template tables.twig avec les données préparées.
            echo $twig->render('tables.twig', $data);
        } else {
            // Si la connexion à la base de données échoue, redirige vers la page d'accueil.
            header("Location: /");
        }
    }

    // Méthode pour afficher la structure d'une table spécifique.
    public function structure()
    {
        // Création d'une instance du chargeur de fichiers Twig avec le répertoire des modèles.
        $loader = new FilesystemLoader('app/views/templates');
        $twig = new Environment($loader);

        // Obtention du nom de la base de données à partir de l'URI.
        $database = self::getDatabase();

        // Tentative de seconde connexion à la base de données avec la méthode secondConnection de la classe Connection.
        $connection = Connection::secondConnection();

        // Vérification de la connexion à la base de données.
        if($connection) {
            // Obtention du nom de la table à partir de l'URI.
            $table = self::getTable();

            // Obtention de la structure de la table spécifiée.
            $structure = TableModel::getStructure($table);

            // Préparation des données pour le template.
            $data = [
                'title' => 'Structure de la table ' . $table,
                'response' => $structure,
                'database' => $database,
                'nbColumn' => count($structure[0]),
                'table' => $table
            ];

            // Affichage du template table.twig avec les données préparées.
            echo $twig->render('table.twig', $data);
        } else {
            // Si la connexion à la base de données échoue, redirige vers la page d'accueil.
            header("Location: /");
        }
    }

    // Méthode pour afficher le contenu d'une table spécifique.
    public function content()
    {
        // Création d'une instance du chargeur de fichiers Twig avec le répertoire des modèles.
        $loader = new FilesystemLoader('app/views/templates');
        $twig = new Environment($loader);

        // Obtention du nom de la base de données à partir de l'URI.
        $database = self::getDatabase();

        // Tentative de seconde connexion à la base de données avec la méthode secondConnection de la classe Connection.
        $connection = Connection::secondConnection();

        // Vérification de la connexion à la base de données.
        if($connection) {
            // Obtention du nom de la table à partir de l'URI.
            $table = self::getTable();

            // Obtention des données de la table spécifiée.
            $response = TableModel::getTable($table);

            // Vérification du nombre de colonnes dans les données.
            $response ? $count = count($response[0]) : null;

            // Préparation des données pour le template.
            $data = [
                'title' => 'Données de la table ' . $table,
                'response' => $response,
                'database' => $database,
                'table' => $table,
                'nbColumn' => $count
            ];

            // Affichage du template table.twig avec les données préparées.
            echo $twig->render('table.twig', $data);
        } else {
            // Si la connexion à la base de données échoue, redirige vers la page d'accueil.
            header("Location: /");
        }
    }
}
