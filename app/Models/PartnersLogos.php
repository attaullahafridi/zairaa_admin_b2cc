<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnersLogos extends Model
{
    protected $table = 'about_partners_logos';
    protected $fillable = ['logo'];
    public $timestamps = false;
}
