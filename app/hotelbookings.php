<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class hotelbookings extends Model
{

	public $timestamps = false;
    protected $sequence = '';
    protected $table = 'hotel_bookings';
    protected $guarded = [];



    
}
