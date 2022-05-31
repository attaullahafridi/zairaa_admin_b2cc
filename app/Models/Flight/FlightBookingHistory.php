<?php

namespace App\Models\Flight;

use Illuminate\Database\Eloquent\Model;

class FlightBookingHistory extends Model
{
    protected $table = 'flight_booking_history';
    protected $guarded = [];
    public $timestamps = false;
    protected $casts = [
        'flight_meta' => 'array',
        'request_data' => 'array',
    ];
}
