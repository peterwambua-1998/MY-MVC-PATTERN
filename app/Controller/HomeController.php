<?php 

namespace App\Controller;

use App\Container;
use App\Services\InvoiceService;

class HomeController {
    public function __construct(private InvoiceService $invoiceService) {
        
    }

    public function index()
    {


        echo $this->invoiceService->charge(100, 'amount');

        //$total = $container->get(InvoiceService::class)->charge(100, 'amount');


        //echo "Your total is: " .$total;
    }
}