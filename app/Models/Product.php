<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'product_brand_id',
        'name',
        'cost_price',
        'list_price',
        'initial_stock'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function product_brand()
    {
        return $this->belongsTo(ProductBrand::class);
    }

    public function getProfitAttribute()
    {
        return $this->list_price - $this->cost_price;
    }

    public function getStockAttribute()
    {
        return $this->initial_stock;
    }

    protected $appends = ['profit', 'stock'];
}
