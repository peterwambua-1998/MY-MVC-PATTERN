<?php 

namespace App;



use App\Interface\PaymentGatewayServiceInterface;
use App\Services\PaymentGatewayService;


class App {
    static public ?App $instance = null;
    static public ?DB $db = null;
    static private ?Route $router = null;
    private ?Container $container = null;

    private function __construct(Route $router, Container $container) {
        if (self::$db == null) {
            self::$db = DB::instantiate();
        }

        if (self::$router == null) {
            self::$router = $router;
        }

        if ($this->container === null) {
            $this->container = $container;
        }

    }

    static public function create(Route $router, Container $container)
    {
        if (self::$instance === null) {
            self::$instance = new App($router, $container);
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