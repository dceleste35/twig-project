<?php

namespace Twigproject\controllers;

class Controler
{

    public function execute(): string
    {
        //Do stuff...
        //Genere une réponse au format HTML par exemple
        return $this->render();
    }

    public function render(): string
    {
        return 'document html/appel à Twig';
    }
}
