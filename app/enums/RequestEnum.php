<?php
namespace Twigproject\enums;

// Définition de l'énumération RequestEnum avec des valeurs de type string.
enum RequestEnum: string
{
    // Déclaration des cas pour chaque type de requête SQL.
    case Insert = 'INSERT';
    case Update = 'UPDATE';
    case Delete = 'DELETE';
    case Select = 'SELECT';

    // Méthode pour obtenir un message de réponse correspondant à chaque type de requête.
    public function response(): string
    {
        return match ($this) {
            self::Insert => 'Les données ont bien été ajoutées',
            self::Update => 'Les données ont bien été modifiées',
            self::Delete => 'Les données ont bien été supprimées',
            self::Select => 'Les données ont bien été récupérées',
        };
    }

    // Méthode pour obtenir le nom de la méthode correspondante à chaque type de requête.
    public function method(): string
    {
        return match ($this) {
            self::Insert => 'insertRows',
            self::Update => 'updateRows',
            self::Delete => 'deleteRows',
            self::Select => 'getTableByQuery',
        };
    }
}
