<?php
namespace Twigproject\controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twigproject\models\TableModel;
use Twigproject\UriParser;

class Table
{
    use UriParser;

    public function all()
    {
        $loader = new FilesystemLoader('app/views/templates');
        $twig = new Environment($loader);

        $database = self::getDatabase();

        $connection = Connection::secondConnection();

        if($connection) {

            $tables = TableModel::all();
            $data = [
                'title' => 'Tables de ' . $database,
                'tables' => $tables,
                'database' => $database
            ];

            echo $twig->render('tables.twig.html', $data);

        } else {
            header("Location: /");
        }
    }

    public function structure()
    {

    }

    public function content()
    {

    }
}
