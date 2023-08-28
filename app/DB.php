<?php 

namespace App;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class DB {
    static private ?Connection $connection = null;
    static private ?DB $instance = null;

    private function __construct() 
    {
        //TODO make sure to move this to 
        $connectionParams = [
            'dbname' => $_ENV['DB_DATABASE'],
            'user' => 'root',
            'password' => '',
            'host' => $_ENV['DB_HOST'],
            'driver' => 'pdo_mysql',
        ];
        
        self::$connection = DriverManager::getConnection($connectionParams);
    }

    static public function instantiate()
    {
        if (self::$connection === null) {
            return self::$instance = new DB();
        }

        return self::$instance;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([self::$connection, $name], $arguments);
    }
  

}