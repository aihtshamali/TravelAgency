<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class package extends Model
{
     public function Source(){
        return $this->belongsTo('App\Sector','source_id');
    }
    public function Destination(){
        return $this->belongsTo('App\Sector','destination_id');
    }
}
