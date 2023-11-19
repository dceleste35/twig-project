<?php
namespace Twigproject\models;

use PDO;
use Twigproject\UriParser;

class TableModel
{
    use UriParser;

    public static function all()
    {

        $db = new PDO("mysql:host=" . $_SESSION['hostname'] . ";dbname=" . self::getDatabase(), $_SESSION['username'], $_SESSION['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT TABLE_NAME, ENGINE, TABLE_COLLATION, DATA_LENGTH, INDEX_LENGTH, TABLE_ROWS FROM information_schema.tables WHERE table_schema = '" . self::getDatabase() . "'";

        $sql = $db->prepare($query);

        $sql->execute();

        $tables = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $tables;
    }

    public static function table()
    {

    }
}
