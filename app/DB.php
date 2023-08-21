<?php 

namespace App;

class DB {
    static private ?\PDO $instance = null;

    private function __construct() 
    {
        try {
            self::$instance = new \PDO(
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
        if (self::$instance === null) {
            return new DB();
        }

        return self::$instance;
    }

}