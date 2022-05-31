<?php

namespace App\Models\Flight;

use Illuminate\Database\Eloquent\Model;

class FlightCustomers extends Model
{
    //
    protected $table = 'flight_customers';

    public function getFullNameAttribute(){
        return "{$this->title} {$this->fname} {$this->lname}";
    }
}
