<?php

namespace App\Services;

use App\Interface\PaymentGatewayServiceInterface;

class PaymentGatewayService implements PaymentGatewayServiceInterface {
    public function __construct(private TaxService $tax) {
    }

    public function charge(float $amount, string $description) {
        $tax_amout = $this->tax->cal($amount);

        $total = $amount + $tax_amout;

        return $total;
    }
}