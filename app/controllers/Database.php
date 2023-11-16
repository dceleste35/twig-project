<?php

namespace Twigproject\controllers;

use PDO;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twigproject\config\Connection;

class Database
{
    public static function getTables()
    {
        $loader = new FilesystemLoader('app/views/templates');
        $twig = new Environment($loader);

        $connection = Connection::index();
        if($connection) {
            $db = new PDO("mysql:host=" . $_SESSION['hostname'] . ";dbname=" . $_SESSION['dbname'], $_SESSION['username'], $_SESSION['password']);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT TABLE_NAME, ENGINE, TABLE_COLLATION, DATA_LENGTH, INDEX_LENGTH, DATA_FREE, AUTO_INCREMENT, TABLE_ROWS FROM information_schema.tables WHERE table_schema = '" . $_SESSION['dbname'] . "'";

            $sql = $db->prepare($query);

            $sql->execute();

            $tables = $sql->fetchAll(PDO::FETCH_ASSOC);

            $data = [
                'tables' => $tables
            ];
            echo $twig->render('database.twig.html', $data);
        } else {

            $template = $twig->load('index.twig.html');
            echo $template->render(['path' => '/accueil']);
        }
    }
}
