<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repair extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'customer_id',
        'vehicle_id',
        'date',
        'workforce_cost',
        'observations',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withTrashed();
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class)->withTrashed();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'repair_product')
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
