# Twig-project


## Prérequis

Assurez-vous d'avoir les éléments suivants installés avant de démarrer :

- [PHP](https://www.php.net/) (version recommandée)
- [Composer](https://getcomposer.org/)
- [Base de données](https://chat.openai.com/c/68c9f556-70d6-419b-bf8a-38edee542358#) (MySQL)

## Installation

1. Clonez le référentiel sur votre machine locale.

bashCopy code

`git clone https://github.com/dceleste35/twig-project`

2. Installez les dépendances via Composer.

bashCopy code

`composer install`

3. Lancez votre serveur PHP

`php -S localhost:8000`

## Utilisation

1. Accédez à l'application via votre navigateur.

2. Connectez-vous avec vos informations de connexion à la base de données.

3. Explorez les fonctionnalités disponibles, telles que la liste des bases de données, des tables, la saisie de requêtes SQL personnalisées, etc.


## Fonctionnalités

- Page de connexion : Saisissez votre hostname, username et password pour accéder à l'application.
- Liste des bases de données : Choisissez la base de données à interroger.
- Liste des tables : Explorez toutes les tables de la base de données sélectionnée.
- Requête SQL personnalisée : Effectuez des requêtes SQL personnalisées.
- Affichage de la structure de la table : Visualisez la structure d'une table spécifique.
- Affichage des données de la table : Affichez les données d'une table spécifique (limité à 5 lignes pour le moment).
- Déconnexion : Déconnectez-vous de l'application.

## Limitations

- Pour le moment, seules les requêtes SELECT, INSERT, DELETE, UPDATE sont recommandées.
- Les données retournées sont limitées à 5 lignes pour le moment en raison de contraintes de temps.

## Erreurs PDO

En cas d'erreur PDO, elle sera affichée sur la même page pour faciliter le débogage.
