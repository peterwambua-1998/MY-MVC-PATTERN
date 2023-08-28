<?php 

namespace App\Controller;

use App\Container;
use App\DB;
use App\Services\InvoiceService;
use App\View;

class HomeController {
    public function __construct(private InvoiceService $invoiceService, protected DB $db) {
        
    }

    public function index()
    {
        //echo $this->invoiceService->charge(100, 'amount');

        //$total = $container->get(InvoiceService::class)->charge(100, 'amount');

        $invoices = [1, 2, 4];
        //echo "Your total is: " .$total;
        return View::make('home',["invoices" => $invoices]);
    }
}