<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'cuit',
        'business_name',
        'phone',
        'address',
        'postal_code',
        'email',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
