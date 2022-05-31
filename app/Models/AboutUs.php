<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';
    protected $fillable = ['first_heading','first_sub_heading','first_paragraph','first_image','second_heading','second_sub_heading','second_paragraph','second_image'];
    public $timestamps = false;
}
