<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    //
    protected $table = 'home_slider';
    protected $fillable = ['heading','sub_heading','slider_image','status'];
    public $timestamps = false;


}
