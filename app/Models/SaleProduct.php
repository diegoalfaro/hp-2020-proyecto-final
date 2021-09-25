<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    protected $fillable = [
        'sale_id',
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
