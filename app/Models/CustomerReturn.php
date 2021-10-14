<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerReturn extends Model
{
    use HasFactory;
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
        return $this->belongsToMany(Product::class, 'customer_return_product')
            ->using(CustomerReturnProduct::class)
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
