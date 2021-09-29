<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function balanceReport()
    {
        $sales = array_map(function($item){
            return [
                'type' => __('document_types.sale'),
                'date' => $item['date'],
                'amount' => -floatval($item['total']),
            ];
        }, $this->sales()->get()->toArray());

        $repairs = array_map(function($item){
            return [
                'type' => __('document_types.repair'),
                'date' => $item['date'],
                'amount' => -floatval($item['total']),
            ];
        }, $this->repairs()->get()->toArray());

        $payments = array_map(function($item){
            return [
                'type' => __('document_types.payment'),
                'date' => $item['date'],
                'amount' => floatval($item['amount']),
            ];
        }, $this->customerPayments()->get()->toArray());

        $items = array_merge($sales, $repairs, $payments);

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

    public function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    protected $appends = ['full_name'];
}
