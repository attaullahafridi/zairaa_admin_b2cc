<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class generalcomments extends Model
{
    //
    protected $table = 'general_comments';
    protected $fillable = ['name','description','comm_image','status'];
    public $timestamps = false;


}
