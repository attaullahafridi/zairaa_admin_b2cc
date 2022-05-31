<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class searchlogs extends Model
{

	public $timestamps = false;
    protected $sequence = '';
    protected $table = 'search_logs';
    protected $guarded = [];


	

    
}
