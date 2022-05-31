<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class promotionalfair extends Model
{
    protected $table = 'promotionalfair';
    protected $fillable = ['flight_code','origin','destination','selling_date','travel_date','promotion_amount'];
    public $timestamps = false;
}
