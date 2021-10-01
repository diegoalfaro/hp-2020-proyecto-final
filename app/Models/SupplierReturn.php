<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierReturn extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'supplier_id',
        'date',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withTrashed();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'supplier_return_product')
            ->using(SupplierReturnProduct::class)
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
