<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    //
    public function Sale(){
        return $this->hasOne('App\Sale','sector_id');
    }
}
