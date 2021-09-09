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
        'list_price',
        'initial_stock'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function getProfitAttribute()
    {
        return $this->list_price - $this->cost;
    }

    protected $appends = ['profit'];
}
