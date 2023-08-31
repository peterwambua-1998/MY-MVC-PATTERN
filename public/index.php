<?php

use App\App;
use App\Container;
use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use App\Interface\PaymentGatewayServiceInterface;
use App\Mailer;
use App\Route;
use App\Services\PaymentGatewayService;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\Setup;
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

$entityManager = new EntityManager(DriverManager::getConnection($connectionParams), ORMSetup::createAnnotationMetadataConfiguration([__DIR__.'/../app/Entity']));

// $items = [['Item 1', 1, 15],['Item 2', 2,7.5],['Item 3', 4, 3.75]];

// $invoice = (new Invoice)
//             ->setAmount(45)
//             ->setInvNum(1)
//             ->setStatus('pending')   
//             ->setDate(new DateTime());

// foreach ($items as [$description, $quantity, $unitPrice]) {
//     $item = (new InvoiceItem)
//             ->setDescription($description)
//             ->setQuantity($quantity)
//             ->setUnitPrice($unitPrice);

//     $invoice->addItem($item);
//     $entityManager->persist($item);

// }

// $entityManager->persist($invoice);
$invoice = $entityManager->find(Invoice::class, 2);

$invoice->setStatus('paid');
$entityManager->flush();

//echo $entityManager->getUnitOfWork()->size();

// $container = new Container;
// $route = new Route($container);

// $container->set(PaymentGatewayServiceInterface::class, 
//     function(Container $container) {
//         return $container->get(PaymentGatewayService::class);
//     }
// );

// $container->set(MailerInterface::class, 
//     function(Container $container) {
//         return $container->get(Mailer::class);
//     }
// );

// App::create($route, $container);

// $route->get('/', [\App\Controller\HomeController::class, 'index']);
// $route->get('/users', [\App\Controller\UserController::class, 'index']);
// $route->get('/create', [\App\Controller\UserController::class, 'create']);
// $route->post('/register', [\App\Controller\UserController::class, 'register']);

// App::run($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

