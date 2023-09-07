<?php

declare(strict_types=1);

include __DIR__.'/../vendor/autoload.php';

use App\Model\Invoice;
use App\Model\InvoiceItem;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$capsule = new Capsule();

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => $_ENV['DB_DATABASE'],
    'username' => $_ENV['DB_USER'],
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

// Updating a modal
$invoiceId = 1;
Invoice::query()->where('id', $invoiceId)->update([
    'status' => 'PAID'
]);

Invoice::where('status','PAID')->get()->each(function(Invoice $invoice) {
    echo $invoice->id . ', ' . $invoice->status . ', ' . $invoice->created_at . PHP_EOL;
});


