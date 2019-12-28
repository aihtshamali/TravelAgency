<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    public function Lead(){
        return $this->hasOne('App\Lead');
    }
}
