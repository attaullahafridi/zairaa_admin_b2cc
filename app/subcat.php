<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subcat extends Model
{
    //
    protected $table = 'sub_cat';
    protected $fillable = ['cat_id','name','pic_main','pic_header','status','description'];
    public $timestamps = false;



public function categories()
    {
    	return $this->hasOne(category::class,'id','cat_id');
    }



}
