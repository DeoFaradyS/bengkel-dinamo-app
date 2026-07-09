<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingSparepart extends Model
{
    public $timestamps = false;

    protected $table = 'booking_spare_parts';

    protected $fillable = [
        'booking_id',
        'spare_part_stock_id',
        'quantity',
        'price',
    ];

    public function sparePartStock()
    {
        return $this->belongsTo(SparePartStock::class);
    }
}