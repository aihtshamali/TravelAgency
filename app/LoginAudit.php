<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginAudit extends Model
{
    protected $table="Login_Audit";
    
    public function UserOn(){
        return $this->belongsTo('App\User','ActionOn');
    }
    
    public function UserBy(){
        return $this->belongsTo('App\User','ActionBy');
    }
}
