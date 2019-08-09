<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    public function Customer(){
        return $this->hasOne('App\Customer','CustomerID');
    }
}
