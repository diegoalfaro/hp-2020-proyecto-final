<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'customer_id',
        'date',
        'due_date',
        'workforce_cost',
        'observations',
    ];

    protected $with = ['customer', 'products'];

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withTrashed();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'budget_product')
            ->using(BudgetProduct::class)
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
