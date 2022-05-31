<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class packagedetails extends Model
{
    //
    protected $table = 'package_detail';
    protected $fillable = ['p_id','overview'];
    public $timestamps = false;



	// public function subcategory()
 //    {
 //    	return $this->hasOne(subcat::class,'id','sub_cat_id');
 //    }

        public function packagename()
    {
        return $this->hasOne(package::class,'id','p_id');
    }
  
 //    public function category()
	// {
	//    return $this->hasOneThrough(category::class , subcat::class ,'id','id','sub_cat_id','cat_id');
	// }



}
