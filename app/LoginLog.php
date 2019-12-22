<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    protected $table = "Login_Log";
       public function User(){
        return $this->belongsTo('App\User');
    }
}
