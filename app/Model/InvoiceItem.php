<?php 

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model 
{
    // over ride this prop because our table does not have it
    const UPDATED_AT = null;
    const CREATED_AT = null;

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}