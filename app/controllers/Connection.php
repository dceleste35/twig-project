<?php
namespace Twigproject\controllers;

use PDO;
use PDOException;

class Connection
{
    // Une propriété statique $result initialisée à true.
    public static bool $result = true;

    // Méthode statique index qui tente d'établir une connexion à la base de données.
    public static function index()
    {
        try {
            // Crée une nouvelle instance PDO avec les informations de connexion fournies par l'utilisateur.
            $conn = new PDO("mysql:host=" . $_POST['hostname'], $_POST['username'], $_POST['password']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Si la connexion réussit, enregistre les valeurs dans la session.
            session_start();
            $_SESSION['hostname'] = $_POST['hostname'];
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];

            // Retourne la valeur de la propriété statique $result (true par défaut).
            return self::$result;
        } catch (PDOException $error) {
            // En cas d'erreur (par exemple, informations de connexion incorrectes), définir $result sur false.
            self::$result = false;
            return self::$result;
        }
    }

    // Méthode statique secondConnection qui tente de se reconnecter à la base de données en utilisant les valeurs enregistrées dans la session.
    public static function secondConnection()
    {
        // Démarrer la session.
        session_start();

        try {
            // Crée une nouvelle instance PDO avec les informations de connexion enregistrées dans la session.
            $conn = new PDO("mysql:host=" . $_SESSION['hostname'], $_SESSION['username'], $_SESSION['password']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Retourne la valeur de la propriété statique $result (true par défaut).
            return self::$result;
        } catch (PDOException $error) {
            // En cas d'erreur, définir $result sur false.
            self::$result = false;
            return self::$result;
        }
    }
}
