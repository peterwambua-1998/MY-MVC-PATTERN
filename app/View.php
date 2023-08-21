<?php

namespace App;

use App\Exception\RouteNotFoundException;

class View {
    const BASE_URL = __DIR__ . '/../views/';

    static public function render(string $name, array $parameters = [])
    {
        $view_path = self::BASE_URL . $name . '.php';

        if (! file_exists($view_path)) {
            throw new RouteNotFoundException("404 route not found");
        }

        ob_start();

        include $view_path;

        ob_end_flush();
    }
}