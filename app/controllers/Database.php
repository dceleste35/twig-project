<?php

namespace Twigproject\controllers;

use PDO;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twigproject\models\DataModel;
use Twigproject\controllers\Connection;

class Database
{
    public function index()
    {
        $loader = new FilesystemLoader('app/views/templates');
        $twig = new Environment($loader);

        $connection = Connection::index();
        if($connection) {

            $tables = DataModel::get();
            $data = [
                'title' => 'Tables de la base',
                'tables' => $tables
            ];

            echo $twig->render('database.twig.html', $data);

        } else {
            header("Location: /");
        }
    }

    public function tables()
    {

    }
}
