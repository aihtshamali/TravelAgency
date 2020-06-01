<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    
    public function Sale()
    {
        return $this->hasMany('App\Sale');
    }
    
    public function Lead()
    {
        return $this->hasMany('App\Lead');
    }
    
     public function Package()
    {
        return $this->hasMany('App\Package');
    }
}
