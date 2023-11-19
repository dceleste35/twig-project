<?php
namespace Twigproject;

trait UriParser
{
    public static function getDatabase()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uriArray = explode('/', $uri);

        return $uriArray[2];
    }

    public function getTable()
    {

    }
}
