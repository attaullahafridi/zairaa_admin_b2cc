<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class actsearchpage extends Model
{
    //
    protected $table = 'act_search_page';
    protected $fillable = ['ad_banner_1','ad_banner_2','ad_banner_3','status','search_image'];
    public $timestamps = false;


}
