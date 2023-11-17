<?php
namespace Twigproject\models;

use PDO;

class DataModel
{
    public static function get()
    {
        $db = new PDO("mysql:host=" . $_SESSION['hostname'] . ";dbname=" . $_SESSION['dbname'], $_SESSION['username'], $_SESSION['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT TABLE_NAME, ENGINE, TABLE_COLLATION, DATA_LENGTH, INDEX_LENGTH, DATA_FREE, AUTO_INCREMENT, TABLE_ROWS FROM information_schema.tables WHERE table_schema = '" . $_SESSION['dbname'] . "'";

        $sql = $db->prepare($query);

        $sql->execute();

        $tables = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $tables;
    }
}
