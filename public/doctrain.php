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

$queryBuilder = $entityManager->createQueryBuilder();

$query = $queryBuilder->select('i.createdAt','i.amount')->from(Invoice::class,'i')
            ->where('i.amount > :amount')->setParameter(':amount', 100)
            ->getQuery();
$invoices = $query->getResult();

echo "<pre>";
var_dump($invoices);
echo "<pre>";

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
// $invoice = $entityManager->find(Invoice::class, 2);

// $invoice->setStatus('paid');
// $entityManager->flush();

//echo $entityManager->getUnitOfWork()->size();
