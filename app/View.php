<?php

namespace App;

use App\Exception\RouteNotFoundException;

class View {
    const BASE_URL = __DIR__ . '/../views/';

    public function __construct(
        protected string $name,
        protected array $params = []
    ) {
    }

    public static function make(string $name, array $parameters = []) {
        return (new static($name, $parameters))->render();
    }

    public function render()
    {
        $view_path = self::BASE_URL . $this->name . '.php';

        if (! file_exists($view_path)) {
            throw new RouteNotFoundException("404 route not found");
        }

        // $$key creates a variable 
        foreach ($this->params as $key => $param) {
            $$key = $param;
        }

        ob_start();

        include $view_path;

        return ob_end_flush();
    }

    public function __get($name)
    {
        return $this->params[$name];
    }
    
}