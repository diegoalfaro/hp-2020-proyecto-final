<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'date',
        'due_date',
        'workforce_cost'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getTotalAttribute()
    {
        return $this->workforce_cost;
    }

    protected $appends = ['total'];
}
