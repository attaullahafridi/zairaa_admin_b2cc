<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class actusers extends Model
{

	public $timestamps = false;
    protected $sequence = '';
    protected $table = 'activity_users';
    protected $guarded = [];

    
}
