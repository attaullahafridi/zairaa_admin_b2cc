<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $table = 'social_media';
    protected $fillable = ['logo','fav_icon','facebook','youtube','twitter','instagram','linkdin','googleplus','google_map_link'];
    public $timestamps = false;
}
