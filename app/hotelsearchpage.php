<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hotelsearchpage extends Model
{
    //
    protected $table = 'hotel_search_page';
    protected $fillable = ['ad_banner_1','ad_banner_2','status','search_image'];
    public $timestamps = false;


}
