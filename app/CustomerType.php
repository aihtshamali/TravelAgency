<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    public function Customer(){
        return $this->belongsTo('App\Customer','CustomerID');
    }
}
