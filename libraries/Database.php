<?php

/**
 * Database
 * 
 * Connexion à la BDD
 */
class Database
{

    /**
     *  Pour éviter d'ouvrir plusieurs connexion à la bdd
     * 
     * @var null
     */
    private static $instance = null;

    /**
     * Retourne une connexion à la base de données
     *
     * @return PDO
     */
    public static function getPdo(): PDO
    {
        if (self::$instance === null) {
            self::$instance = $pdo = new PDO(
                'mysql:host=localhost;dbname=boutique;charset=utf8', 'root', 'root', 
                [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        }
        return self::$instance;
    }
}
