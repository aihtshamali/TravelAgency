<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
  public function CashbookData(){
        return $this->hasMany('App\CashbookData');
    }
     public function Payment(){
        return $this->hasMany('App\Payment');
    }
}
