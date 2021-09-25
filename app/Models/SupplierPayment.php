<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    protected $fillable = [
        'supplier_id',
        'date',
        'amount',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
