<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class homedeals extends Model
{
    //
    protected $table = 'home_deals';
    protected $fillable = ['name','description','deal_image','deal_link','status'];
    public $timestamps = false;


}
