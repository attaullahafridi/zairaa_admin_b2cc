<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inspiration extends Model
{
    //
    protected $table = 'inspirations';
    protected $fillable = ['heading','details','status'];
    public $timestamps = false;


}
