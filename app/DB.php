<?php 

namespace App;

class DB {
    static private ?\PDO $pdo = null;
    static private ?DB $instance = null;

    private function __construct() 
    {
        try {
            self::$pdo = new \PDO(
                "mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_DATABASE'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASS']
            );
        } catch (\PDOException $th) {
            echo $th->getMessage();
        }
    }

    static public function instantiate()
    {
        if (self::$pdo === null) {
            return self::$instance = new DB();
        }

        return self::$instance;
    }

    public function getPDO()
    {
        return self::$pdo;
    }

}