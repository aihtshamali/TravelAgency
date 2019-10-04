<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadType extends Model
{
    public function Lead(){
        return $this->hasOne('App\Lead','LeadID');
    }
    public function Sale(){
        return $this->hasOne('App\Sale','SaleID');
    }
}
