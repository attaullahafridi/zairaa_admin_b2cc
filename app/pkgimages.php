<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pkgimages extends Model
{
    //
    protected $table = 'pk_images';
    protected $fillable = ['pk_id','image_url'];
    public $timestamps = false;



	public function packagename()
    {
    	return $this->hasOne(package::class,'id','pk_id');
    }

  
 //    public function category()
	// {
	//    return $this->hasOneThrough(category::class , subcat::class ,'id','id','sub_cat_id','cat_id');
	// }



}
