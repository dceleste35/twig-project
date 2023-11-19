<?php

namespace Twigproject\controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twigproject\models\DataModel;
use Twigproject\controllers\Connection;

class Database
{
    public function get()
    {
        $loader = new FilesystemLoader('app/views/templates');
        $twig = new Environment($loader);

        $connection = Connection::index();
        if($connection) {

            $databases = DataModel::get();
            $data = [
                'title' => 'Bases de données',
                'databases' => $databases
            ];

            echo $twig->render('database.twig.html', $data);
            var_dump($_SESSION);
        } else {
            header("Location: /");
        }
    }
}
