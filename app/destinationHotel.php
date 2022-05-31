<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class destinationHotel extends Model
{
    //
    protected $table = 'dest_hotels';
    protected $fillable = ['hotel_name','hotel_image','star','price','top_dest_id'];
    public $timestamps = false;
}
