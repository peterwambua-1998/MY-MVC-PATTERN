<?php 

namespace App;


class App {
    static public ?App $instance = null;
    static public ?DB $db = null;
    static private ?Route $router = null;

    private function __construct(Route $router) {
        if (self::$db == null) {
            self::$db = DB::instantiate();
        }

        if (self::$router == null) {
            self::$router = $router;
        }

        
    }

    static public function create(Route $router)
    {
        if (self::$instance === null) {
            self::$instance = new App($router);
        }

        return self::$instance;

    }

    public function getDB ()
    {
        return self::$db;
    }

    static public function run($request_method, $request_uri)
    {
      
        return self::$router->resolve($request_method, $request_uri);
    }
}