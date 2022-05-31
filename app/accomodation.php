<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class accomodation extends Model
{
    //
    protected $table = 'pk_acc';
    protected $fillable = ['pk_id','destination','hotel_name','hotel_star','image','description'];
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
