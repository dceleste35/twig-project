<?php
namespace Twigproject\models;

use PDO;

class DataModel
{
    // Méthode statique pour obtenir la liste des bases de données.
    public static function get()
    {
        // Création d'une nouvelle instance PDO avec les informations de connexion enregistrées dans la session.
        $db = new PDO("mysql:host=" . $_SESSION['hostname'], $_SESSION['username'], $_SESSION['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour récupérer la liste des bases de données (en excluant certaines bases système).
        $query = "SHOW DATABASES WHERE `Database` NOT IN ('sys', 'information_schema', 'performance_schema', 'mysql')";

        // Préparation et exécution de la requête.
        $sql = $db->prepare($query);
        $sql->execute();

        // Récupération des résultats de la requête sous forme de tableau associatif.
        $databases = $sql->fetchAll(PDO::FETCH_ASSOC);

        // Retourne le tableau des bases de données.
        return $databases;
    }
}
