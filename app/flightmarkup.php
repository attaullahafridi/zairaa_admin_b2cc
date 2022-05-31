<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class flightmarkup extends Model
{
    //
    protected $table = 'flight_markup';
    protected $fillable = ['flight_name','flight_code','amount','percentage'];
    public $timestamps = false;
}
