<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBranch extends Model
{
    //
    public function User(){
        return $this->belongsTo('App\User');
    }
    public function Branch(){
        return $this->belongsTo('App\Branch');
    }
}
