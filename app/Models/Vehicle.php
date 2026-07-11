<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'license_plate',
        'vehicle_model',
        'year',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}