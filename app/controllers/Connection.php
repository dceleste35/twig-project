<?php
namespace Twigproject\controllers;

use PDO;
use PDOException;

class Connection
{
    public static bool $result = true;

    public static function index()
    {
        try {
            $conn = new PDO("mysql:host=" . $_POST['hostname'] . ";dbname=" . $_POST['dbname'], $_POST['username'], $_POST['password']);
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
