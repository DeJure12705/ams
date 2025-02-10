<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FineSettings extends Model
{
    protected $fillable = [
        'fine_amount',
        'morning_checkin',
        'morning_checkout',
        'afternoon_checkin',
        'afternoon_checkout'
    ];

    protected $casts = [
        'morning_checkin' => 'boolean',
        'morning_checkout' => 'boolean',
        'afternoon_checkin' => 'boolean',
        'afternoon_checkout' => 'boolean',
        'fine_amount' => 'decimal:2'
    ];
}
