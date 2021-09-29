<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'identity',
        'address',
        'phone'
    ];

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }

    public function customerPayments()
    {
        return $this->hasMany(CustomerPayment::class);
    }

    public function customerReturns()
    {
        return $this->hasMany(CustomerReturn::class);
    }

    public function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    protected $appends = ['full_name'];
}
