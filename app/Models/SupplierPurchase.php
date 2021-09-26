<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierPurchase extends Model
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
        return $this->belongsToMany(Product::class, 'supplier_purchase_product')
            ->using(SupplierPurchaseProduct::class)
            ->as('detail')
            ->withPivot('quantity', 'cost_price')
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
