<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SupplierReturnProduct extends Pivot
{
    protected $fillable = [
        'supplier_return_id',
        'product_id',
        'quantity',
        'list_price'
    ];

    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->list_price;
    }

    protected $appends = ['subtotal'];
}
