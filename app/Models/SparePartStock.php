<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparePartStock extends Model
{
    protected $fillable = [
        'spare_part_id',
        'condition',
        'stock',
        'price',
    ];

    protected $casts = [
        'condition' => 'string',
        'price' => 'decimal:2',
    ];

    public function sparePart()
    {
        return $this->belongsTo(SparePart::class);
    }
}