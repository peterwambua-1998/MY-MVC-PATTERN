<?php

declare(strict_types=1);

include __DIR__.'/../vendor/autoload.php';

use App\Model\Invoice;
use App\Model\InvoiceItem;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$capsule = new Capsule();

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'php-prac',
    'username' => 'root',
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


$invoice = new Invoice();

$invoice->inv_num = 86312;
$invoice->amount = 45;
$invoice->status = "pending";
$invoice->save();

$items = [['Item 1', 1, 15],['Item 2', 2,7.5],['Item 3', 4, 3.75]];

foreach($items as [$desc, $price, $qty]){
    $invoiceItem = new InvoiceItem();
    $invoiceItem->description = $desc;
    $invoiceItem->unit_price = $price;
    $invoiceItem->quantity = $qty;
    $invoiceItem->invoice()->associate($invoice);
    $invoiceItem->save();
}

