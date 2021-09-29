<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerPayment extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'customer_id',
        'date',
        'amount',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withTrashed();
    }
}
