<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierReturn extends Model
{
    protected $fillable = [
        'supplier_id',
        'date',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'supplier_return_product')
            ->using(SupplierReturnProduct::class)
            ->as('detail')
            ->withPivot('quantity', 'list_price')
            ->withTimestamps();
    }

    public function getTotalAttribute()
    {
        $acc = $this->workforce_cost;

        foreach ($this->products()->get() as $product) {
            $acc += $product['detail']['subtotal'];
        }

        return $acc;
    }

    protected $appends = ['total'];
}
