<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class topFlight extends Model
{
    //
    protected $table = 'top_flight';
    protected $fillable = ['title','origion','destination','depart_date','description','image','status'];
    public $timestamps = false;
    protected $guarded = ['_token'];
}
