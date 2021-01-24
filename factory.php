<?php

interface DatabaseInterface
{
    public function connect($params);
    public function query($query);
}

class DBPgsql implements DatabaseInterface
{
    public function connect($params)
    {
        // Implémentation spécifique
    }

    public function query($query)
    {
        // Implémentation spécifique
    }
}

class DBMysql implements DatabaseInterface
{
    public function connect($params)
    {
        // Implémentation spécifique
    }

    public function query($query)
    {
        // Implémentation spécifique
    }
}

class DatabaseFactory
{
    public static function create($type)
    {
        switch ($type) {
            case 'pgsql':
                $db = new DBPgsql(/* on passe en argument les infos de connexion */);
            break;
            case 'mysql':
                $db = new DBMysql(/* on passe en argument les infos de connexion */);
            default:
                throw new Exception('Unknown database');
        }

        return $db;
    }
}

// utilisation
$db = DatabaseFactory:create('pgsql');
$db = DatabaseFactory:create('mysql');


/*

Cette classe permet au code client de se libérer de toute responsabilité 
(implémentation, configuration et instanciation).

source :
https://www.christophe-meneses.fr/article/exemple-d-utilisation-de-la-fabrique-factory

*/