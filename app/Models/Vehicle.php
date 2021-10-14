<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'domain',
        'vehicle_brand_id',
        'model',
        'year',
        'observations',
    ];

    protected $with = ['vehicle_brand'];

    public function vehicle_brand()
    {
        return $this->belongsTo(VehicleBrand::class)->withTrashed();
    }
}
