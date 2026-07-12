<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkshopSetting extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'latitude',
        'longitude',
        'max_service_radius_km',
        'default_home_service_fee',
        'updated_at',
    ];
}