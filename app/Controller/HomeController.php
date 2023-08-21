<?php 

namespace App\Controller;

use App\Container;
use App\Services\InvoiceService;

class HomeController {
    public function index()
    {
        $container = new Container;

        $invoice =  $container->get(InvoiceService::class);

        echo $invoice->charge(100, 'amount');

        //$total = $container->get(InvoiceService::class)->charge(100, 'amount');


        //echo "Your total is: " .$total;
    }
}