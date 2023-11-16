<?php
namespace Twigproject\config;

use PDO;
use PDOException;

class Connexion
{
    public static bool $result = true;

    public static function try($post): bool
    {
        try {
            $db_connection = [
                'hostname' => $post['hostname'],
                'username' => $post['username'],
                'password' => $post['password'],
                'dbname' => $post['dbname'],
            ];

            $conn = new PDO("mysql:host=" . $db_connection['hostname'] . ";dbname=" . $db_connection['dbname'], $db_connection['username'], $db_connection['password']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //si connecté enregistrer les valeurs
            session_start();
            $_SESSION['hostname'] = $_POST['hostname'];
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['dbname'] = $_POST['dbname'];

            return self::$result;
        } catch (PDOException $error) {
            self::$result = false;
            return self::$result;
        }

    }
}
