<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    protected $fillable = [
        'customer_id',
        'date',
        'amount',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
