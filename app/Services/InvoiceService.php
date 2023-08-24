<?php 


namespace App\Services;

use App\Interface\PaymentGatewayServiceInterface;
use App\Notification\EmailNotification;

class InvoiceService {
    public function __construct(
        protected PaymentGatewayServiceInterface $paymentGatewayService, 
        protected EmailNotification $email
    ) 
    {
        
    }

    public function charge(float $amount, string $description)
    {
       return $this->paymentGatewayService->charge($amount, $description);
    }
}