<?php

namespace App;

use App\Models\Flight\FlightBooking;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class booking extends Model
{

	public $timestamps = false;
    protected $sequence = '';
    protected $table = 'booking';
    protected $guarded = [];
    
    public function user(){
    	return $this->belongsTo(User::class,'user_type_id');
    }
    public function flight_booking()
    {
        return $this->belongsTo(FlightBooking::class,'b_id');
    }
}
