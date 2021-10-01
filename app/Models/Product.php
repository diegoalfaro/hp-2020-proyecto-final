<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

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
        return $this->belongsTo(Supplier::class)->withTrashed();
    }

    public function product_brand()
    {
        return $this->belongsTo(ProductBrand::class)->withTrashed();
    }

    public function getProfitAttribute()
    {
        return $this->list_price - $this->cost_price;
    }

    public function getStockAttribute()
    {
        return DB::table('products')
            ->where('id', $this->id)
            ->selectSub('initial_stock', 'quantity')
            ->union(
                DB::table('sale_product')
                    ->where('product_id', $this->id)
                    ->selectSub('-quantity', 'quantity')
            )
            ->union(
                DB::table('repair_product')
                    ->where('product_id', $this->id)
                    ->selectSub('-quantity', 'quantity')
            )
            ->union(
                DB::table('customer_return_product')
                    ->where('product_id', $this->id)
                    ->selectSub('quantity', 'quantity')
            )
            ->union(
                DB::table('supplier_return_product')
                    ->where('product_id', $this->id)
                    ->selectSub('-quantity', 'quantity')
            )
            ->union(
                DB::table('supplier_purchase_product')
                    ->where('product_id', $this->id)
                    ->selectSub('quantity', 'quantity')
            )
            ->sum('quantity');
    }

    protected $appends = ['profit', 'stock'];
}
