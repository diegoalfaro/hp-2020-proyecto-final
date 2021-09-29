<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function supplierPurchases()
    {
        return $this->hasMany(SupplierPurchase::class);
    }

    public function supplierPayments()
    {
        return $this->hasMany(SupplierPayment::class);
    }

    public function supplierReturns()
    {
        return $this->hasMany(SupplierReturn::class);
    }

    public function balanceReport()
    {
        $sales = array_map(function($item){
            return [
                'type' => __('document_types.supplier_purchase'),
                'date' => $item['date'],
                'amount' => -floatval($item['total']),
            ];
        }, $this->supplierPurchases()->get()->toArray());

        $payments = array_map(function($item){
            return [
                'type' => __('document_types.payment'),
                'date' => $item['date'],
                'amount' => floatval($item['amount']),
            ];
        }, $this->supplierPayments()->get()->toArray());

        $items = array_merge($sales, $payments);

        usort($items, function($a, $b) {
            return strcmp($a['date'], $b['date']);
        });

        $total = array_reduce($items, function($carry, $item){
            return $carry + $item['amount'];
        }, 0);

        return [
            'items' => $items,
            'total' => $total
        ];
    }
}
