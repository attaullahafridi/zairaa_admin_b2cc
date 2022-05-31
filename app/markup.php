<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class markup extends Model
{
    //
    protected $table = 'markup';
    protected $fillable = ['type','percentage'];
    public $timestamps = false;
}
