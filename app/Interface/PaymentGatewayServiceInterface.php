<?php

namespace App\Interface;

interface PaymentGatewayServiceInterface {
    public function charge(float $amount, string $description); 
}