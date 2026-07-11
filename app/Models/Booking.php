<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'booking_code',
        'vehicle_id',
        'customer_name',
        'customer_phone',
        'service_type',
        'customer_address',
        'customer_lat',
        'customer_lng',
        'distance_km',
        'home_service_fee',
        'scheduled_at',
        'complaint',
        'status',
        'approved_by',
        'approved_at',
        'rejection_reason',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function services()
    {
        return $this->hasMany(BookingService::class);
    }

    public function spareParts()
    {
        return $this->hasMany(BookingSparepart::class);
    }

    public function notificationLogs()
    {
        return $this->hasMany(NotificationLog::class);
    }
}