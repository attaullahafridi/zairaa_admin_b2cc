<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class flightdeals extends Model
{
    //
    protected $table = 'flight_deals';
    protected $fillable = ['city_name','description','flight_image','status'];
    public $timestamps = false;


}
