<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class exclusion extends Model
{
    //
    protected $table = 'pk_exclusion';
    protected $fillable = ['pk_id','exclusion'];
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
