<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BudgetProduct extends Pivot
{
    protected $fillable = [
        'budget_id',
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
