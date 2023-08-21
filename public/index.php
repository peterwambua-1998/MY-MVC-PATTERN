<?php

use App\App;
use App\Route;
use Dotenv\Dotenv;

include __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$route = new Route;

$route->get('/', [\App\Controller\HomeController::class, 'index']);
$route->get('/create', [\App\Controller\UserController::class, 'create']);
$route->post('/register', [\App\Controller\UserController::class, 'register']);

App::create($route);

App::run($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);