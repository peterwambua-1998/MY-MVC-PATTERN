<?php

use App\App;
use App\Container;
use App\Interface\PaymentGatewayServiceInterface;
use App\Mailer;
use App\Route;
use App\Services\PaymentGatewayService;
use Doctrine\DBAL\DriverManager;
use Dotenv\Dotenv;
use Symfony\Component\Mailer\MailerInterface;

include __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$connectionParams = [
    'dbname' => $_ENV['DB_DATABASE'],
    'user' => 'root',
    'password' => '',
    'host' => $_ENV['DB_HOST'],
    'driver' => 'pdo_mysql',
];

$conn = DriverManager::getConnection($connectionParams);

$builder = $conn->createQueryBuilder();

$users = $builder->select('full_name')->from('users')->fetchAllAssociative();

var_dump($users);

/*

$container = new Container;
$route = new Route($container);

$container->set(PaymentGatewayServiceInterface::class, 
    function(Container $container) {
        return $container->get(PaymentGatewayService::class);
    }
);

$container->set(MailerInterface::class, 
    function(Container $container) {
        return $container->get(Mailer::class);
    }
);

App::create($route, $container);

$route->get('/', [\App\Controller\HomeController::class, 'index']);
$route->get('/create', [\App\Controller\UserController::class, 'create']);
$route->post('/register', [\App\Controller\UserController::class, 'register']);

App::run($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
*/

