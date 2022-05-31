<?php

namespace App\Models\Flight;

use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    //
    protected $table = 'flight_booking';
    protected $guarded = [];

    public function flight_main_booking()
    {
        return $this->hasOne(Booking::class,'b_id');
    }
    public function flight_segments()
    {
        return $this->hasMany(FlightSegments::class,'book_id');
    }

    public function flight_customers()
    {
        return $this->hasMany(FlightCustomers::class,'booking_id');
    }
}
