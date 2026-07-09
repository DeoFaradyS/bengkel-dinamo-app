<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'scheduled_at',
        'complaint',
        'status',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function services()
    {
        return $this->hasMany(BookingService::class);
    }

    public function spareParts()
    {
        return $this->hasMany(BookingSparepart::class);
    }
}