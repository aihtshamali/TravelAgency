<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadType extends Model
{
    public function Lead(){
        return $this->hasMany('App\Lead','LeadID');
    }
    public function Sale(){
        return $this->hasMany('App\Sale');
    }
}
