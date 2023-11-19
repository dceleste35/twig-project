<?php
namespace Twigproject\models;

use PDO;

class DataModel
{
    public static function get()
    {
        $db = new PDO("mysql:host=" . $_SESSION['hostname'], $_SESSION['username'], $_SESSION['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SHOW DATABASES";

        $sql = $db->prepare($query);

        $sql->execute();

        $tables = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $tables;
    }
}
