<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'name',
        'mark',
        'cost',
        'gains',
        'list_price',
        'existence'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
