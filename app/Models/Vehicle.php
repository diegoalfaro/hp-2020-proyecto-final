<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain',
        'vehicle_brand_id',
        'model',
        'year',
        'observations',
    ];

    public function vehicle_brand()
    {
        return $this->belongsTo(VehicleBrand::class);
    }
}
