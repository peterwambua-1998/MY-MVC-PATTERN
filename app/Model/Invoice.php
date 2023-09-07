<?php 

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $inv_num
 * @property string $status
 */
class Invoice extends Model 
{
    // over ride this prop because our table does not have it
    const UPDATED_AT = null;

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}