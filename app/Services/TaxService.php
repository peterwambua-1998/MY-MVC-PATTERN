<?php 


namespace App\Services;

class TaxService {
    public function cal($amount)
    {
        return ($amount * 16) / 100;
    }
}