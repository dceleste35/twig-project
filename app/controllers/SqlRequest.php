<?php

namespace Twigproject\controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twigproject\traits\UriParser;
use Twigproject\enums\RequestEnum;
use Twigproject\models\TableModel;

class SqlRequest
{
    use UriParser;

    // Méthode principale pour gérer les requêtes SQL.
    public function index()
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
            // Préparation des données pour le template.
            $data = [
                'title' => 'Tables de ' . $database,
            ];

            // Vérification si une requête SQL a été soumise.
            if(isset($_POST['sql'])) {
                // Vérification si la requête SQL est une requête valide.
                if(self::findQueryAsk()) {
                    $method = self::findQueryAsk();
                    $method = $method->method();

                    // Exécution de la méthode de la classe TableModel correspondante à la requête SQL.
                    $response = TableModel::$method($_POST['sql']);

                    // Gestion des résultats de la requête.
                    if(is_null($response) || is_array($response)) {
                        // Si la requête est un SELECT, affiche les résultats dans un template de tableau.
                        if(self::findQueryAsk() == RequestEnum::Select) {
                            $response ? $data['nbColumn'] = count($response[0]) : null;
                            $data['response'] = $response;
                            $data['database'] = $database;
                            $data['table'] = self::getTable();
                            echo $twig->render('table.twig', $data);
                        } else {
                            // Si la requête est autre que SELECT, affiche un message de réussite.
                            $data['response'] = 'La requête a bien été exécutée';
                            echo $twig->render('requestsql.twig', $data);
                        }
                    } else {
                        // Si la requête échoue, affiche le message d'erreur.
                        $data['response'] = $response;
                        echo $twig->render('requestsql.twig', $data);
                    }
                } else {
                    // Si la requête n'est pas valide, affiche un message d'erreur.
                    $data['response'] = 'La requête n\'est pas valide';
                    echo $twig->render('requestsql.twig', $data);
                }
            } else {
                // Si aucune requête n'a été soumise, affiche la page avec le formulaire de requête.
                echo $twig->render('requestsql.twig', $data);
            }
        } else {
            // Si la connexion à la base de données échoue, redirige vers la page d'accueil.
            header("Location: /");
        }
    }

    // Méthode privée pour déterminer le type de requête SQL (SELECT, INSERT, etc.).
    private function findQueryAsk()
    {
        $query = $_POST['sql'];
        $firstWord = explode(' ', $query)[0];
        $value = RequestEnum::tryFrom($firstWord);

        return $value;
    }

    // Méthode privée pour obtenir le nom de la table à partir de la requête SQL.
    private static function getTable()
    {
        // Sélectionne la chaîne de caractères après le mot FROM dans la requête SQL.
        $table = explode('FROM ', $_POST['sql'])[1];

        return $table;
    }
}
