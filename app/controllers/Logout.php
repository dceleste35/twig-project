<?php

namespace Twigproject\controllers;

class Logout
{
    // Méthode pour déconnecter l'utilisateur.
    public function index()
    {
        // Détruit la session actuelle.
        session_destroy();

        // Supprime toutes les données de la session.
        unset($_SESSION);

        // Supprime le cookie de session.
        setcookie(session_name(), '');

        // Redirige l'utilisateur vers la page d'accueil.
        header("Location: /");
    }
}
