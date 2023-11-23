<?php
namespace Twigproject\controllers;

class Logout
{
    public function index()
    {
        session_destroy();
        unset($_SESSION);
        setcookie(session_name(), '');

        header("Location: /");
    }
}
