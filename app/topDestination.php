<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class topDestination extends Model
{
    //
    protected $table = 'top_detination';
    protected $fillable = ['city_name','city_code','description','image','status'];
    public $timestamps = false;
    protected $guarded = ['_token'];

    public function destinationHotel()
    {
    	return $this->hasMany(destinationHotel::class,'top_dest_id');
    }
}
