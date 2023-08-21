<?php 


namespace App\Services;

use App\Notification\EmailNotification;

class InvoiceService {
    public function __construct(protected TaxService $tax, protected EmailNotification $email) 
    {
        
    }

    public function charge(float $amount, string $description)
    {
        $tax_amount = $this->tax->cal($amount);

        $total = $amount + $tax_amount;

        return $total;
    }
}