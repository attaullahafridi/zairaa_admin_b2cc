<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class activitybooking extends Model
{

	public $timestamps = false;
    protected $sequence = '';
    protected $table = 'activity_bookings';
    protected $guarded = [];


public function activityusers()
    {
    	return $this->hasMany(actusers::class,'act_id','id');
    }
    
}
