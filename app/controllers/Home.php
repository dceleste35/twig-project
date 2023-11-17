<?php

namespace Twigproject\controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Home
{
    public function index()
    {
        $data = [
            'title' => 'Page de connexion'
        ];
        $loader = new FilesystemLoader('app/views/templates');
        $twig = new Environment($loader);
        echo $twig->render('index.twig.html', $data);
    }
}
