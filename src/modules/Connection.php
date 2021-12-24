<?php

namespace LaJoie\modules;

use PDO;
use PDOException;


class Connection
{
    private static $con;

    private static $instance = null;
    private static $DB_HOST = 'sql604.main-hosting.eu';
    private static $DB_USERNAME = 'u670916410_fark';
    private static $DB_PASSWORD = 'Maulana123';
    private static $DB_NAME = 'u670916410_lajoie';

    private function __construct()
    {

        $host = self::$DB_HOST;
        $username = self::$DB_USERNAME;
        $password = self::$DB_PASSWORD;
        $databaseName = self::$DB_NAME;
        try {
            self::$con = new PDO("mysql:host=$host;dbname=$databaseName", $username, $password);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    protected static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return self::$con;
    }
}
