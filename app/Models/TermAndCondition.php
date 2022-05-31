<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermAndCondition extends Model
{
    protected $table = 'term_and_conditons';
    protected $fillable = ['text'];
    public $timestamps = false;
}
