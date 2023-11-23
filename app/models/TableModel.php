<?php
namespace Twigproject\models;

use PDO;
use Throwable;
use Twigproject\traits\UriParser;

class TableModel
{
    use UriParser;

    // Méthode pour récupérer toutes les tables d'une base de données.
    public static function all()
    {
        // Création d'une nouvelle instance PDO avec les informations de connexion enregistrées dans la session.
        $db = new PDO("mysql:host=" . $_SESSION['hostname'] . ";dbname=" . self::getDatabase(), $_SESSION['username'], $_SESSION['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour récupérer des informations sur toutes les tables de la base de données.
        $query = "SELECT TABLE_NAME, ENGINE, TABLE_COLLATION, DATA_LENGTH, INDEX_LENGTH, TABLE_ROWS FROM information_schema.tables WHERE table_schema = '" . self::getDatabase() . "'";

        // Préparation et exécution de la requête.
        $sql = $db->prepare($query);
        $sql->execute();

        // Récupération des résultats de la requête sous forme de tableau associatif.
        $tables = $sql->fetchAll(PDO::FETCH_ASSOC);

        // Retourne le tableau des informations sur les tables.
        return $tables;
    }

    // Méthode pour exécuter une requête SQL et obtenir les résultats (limités à 5 lignes).
    public static function getTableByQuery($query)
    {
        try {
            // Création d'une nouvelle instance PDO avec les informations de connexion enregistrées dans la session.
            $db = new PDO("mysql:host=" . $_SESSION['hostname'] . ";dbname=" . self::getDatabase(), $_SESSION['username'], $_SESSION['password']);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparation et exécution de la requête SQL avec une limite de 5 lignes.
            $sql = $db->prepare($query . " LIMIT 5");
            $sql->execute();

            // Récupération des résultats de la requête sous forme de tableau associatif.
            $tables = $sql->fetchAll(PDO::FETCH_ASSOC);

            // Retourne le tableau des résultats.
            return $tables;
        } catch (Throwable $e) {
            // En cas d'erreur, retourne le message d'erreur.
            return $e->getMessage();
        }
    }

    // Méthode pour récupérer les premières 5 lignes d'une table spécifique.
    public static function getTable($table)
    {
        // Création d'une nouvelle instance PDO avec les informations de connexion enregistrées dans la session.
        $db = new PDO("mysql:host=" . $_SESSION['hostname'] . ";dbname=" . self::getDatabase(), $_SESSION['username'], $_SESSION['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparation et exécution de la requête SQL pour sélectionner toutes les colonnes de la table (limité à 5 lignes).
        $sql = $db->prepare("SELECT * FROM " . $table . " LIMIT 5");
        $sql->execute();

        // Récupération des résultats de la requête sous forme de tableau associatif.
        $structure = $sql->fetchAll(PDO::FETCH_ASSOC);

        // Retourne le tableau des résultats.
        return $structure;
    }

    // Méthode pour récupérer la structure d'une table spécifique.
    public static function getStructure($table)
    {
        // Création d'une nouvelle instance PDO avec les informations de connexion enregistrées dans la session.
        $db = new PDO("mysql:host=" . $_SESSION['hostname'] . ";dbname=" . self::getDatabase(), $_SESSION['username'], $_SESSION['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparation et exécution de la requête SQL pour décrire la structure de la table.
        $sql = $db->prepare("DESCRIBE " . $table);
        $sql->execute();

        // Récupération des résultats de la requête sous forme de tableau associatif.
        $structure = $sql->fetchAll(PDO::FETCH_ASSOC);

        // Retourne le tableau des résultats.
        return $structure;
    }

    // Méthodes pour exécuter des requêtes d'insertion, de mise à jour et de suppression.
    public static function insertRows($query)
    {
        try {
            // Création d'une nouvelle instance PDO avec les informations de connexion enregistrées dans la session.
            $db = new PDO("mysql:host=" . $_SESSION['hostname'] . ";dbname=" . self::getDatabase(), $_SESSION['username'], $_SESSION['password']);
            $sql = $db->prepare($query);

            // Exécution de la requête d'insertion.
            $sql->execute();
        } catch (Throwable $e) {
            // En cas d'erreur, retourne le message d'erreur.
            return $e->getMessage();
        }
    }

    public static function updateRows($query)
    {
        try {
            // Création d'une nouvelle instance PDO avec les informations de connexion enregistrées dans la session.
            $db = new PDO("mysql:host=" . $_SESSION['hostname'] . ";dbname=" . self::getDatabase(), $_SESSION['username'], $_SESSION['password']);
            $sql = $db->prepare($query);

            // Exécution de la requête de mise à jour.
            $sql->execute();
        } catch (Throwable $e) {
            // En cas d'erreur, retourne le message d'erreur.
            return $e->getMessage();
        }
    }

    public static function deleteRows($query)
    {
        try {
            // Création d'une nouvelle instance PDO avec les informations de connexion enregistrées dans la session.
            $db = new PDO("mysql:host=" . $_SESSION['hostname'] . ";dbname=" . self::getDatabase(), $_SESSION['username'], $_SESSION['password']);
            $sql = $db->prepare($query);

            // Exécution de la requête de suppression.
            $sql->execute();
        } catch (Throwable $e) {
            // En cas d'erreur, retourne le message d'erreur.
            return $e->getMessage();
        }
    }
}
