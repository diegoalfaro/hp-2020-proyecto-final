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

    public function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    protected $appends = ['full_name'];
}
