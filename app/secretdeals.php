<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class secretdeals extends Model
{
    //
    protected $table = 'secret_deals';
    protected $fillable = ['heading','description','deal_image','status'];
    public $timestamps = false;


}
