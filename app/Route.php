<?php 

namespace App;

use App\Exception\RouteNotFoundException;

class Route {
    private array $routes = [];

    public function __construct() {
        
    }

    public function register(string $method, string $route, array|callable $concrete)
    {
        // $routes[method][route] = [App\Controller\HomeController, 'index'];
        $this->routes[$method][$route] = $concrete;

        return $this;
    }

    public function get(string $route, array|callable $concrete){
        $this->register('GET', $route, $concrete);
    }

    public function post(string $route, array|callable $concrete){
        $this->register('POST', $route, $concrete);
    }

    public function resolve(string $method, string $route)
    {
        // 1. is to check if route exists
        $concrete = $this->routes[$method][$route];


        if (! isset($concrete)) {
            throw new RouteNotFoundException("404 not found");
        }

        //2. check if its callable
        if (is_callable($concrete)) {
            return $concrete();
        }

        //3. if it 
        if (is_array($concrete)) {
            [$class, $method] = $concrete;

            if (! class_exists($class)) {
                throw new \Exception("404 not found");
            }

            if (! method_exists($class, $method)) {
                throw new RouteNotFoundException("404 not found");
            }

            $class = new $class;

            return call_user_func_array([$class, $method],[]);
        }

        throw new RouteNotFoundException("404 not found");
    }
}