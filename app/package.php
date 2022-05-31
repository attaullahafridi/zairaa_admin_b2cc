<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class package extends Model
{
    protected $table = 'package';
    protected $fillable = ['sub_cat_id','name','description','thumbnail','package_price_adult','package_price_child','status','header_image'];
    public $timestamps = false;
	public function subcategory()
    {
    	return $this->hasOne(subcat::class,'id','sub_cat_id');
    }

  
    public function category()
	{
	   return $this->hasOneThrough(category::class , subcat::class ,'id','id','sub_cat_id','cat_id');
	}



}
