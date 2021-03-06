<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'customer_id',
        'date',
    ];

    protected $with = ['customer', 'products'];

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withTrashed();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sale_product')
            ->using(BudgetProduct::class)
            ->as('detail')
            ->withPivot('quantity', 'list_price')
            ->withTimestamps();
    }

    public function getTotalAttribute()
    {
        $acc = 0;

        foreach ($this->products()->get() as $product) {
            $acc += $product['detail']['subtotal'];
        }

        return $acc;
    }

    protected $appends = ['total'];
}
