<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierPayment extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'supplier_id',
        'date',
        'amount',
    ];

    protected $with = ['supplier'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withTrashed();
    }
}
