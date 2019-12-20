<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBranch extends Model
{
    protected $table="user_branches";
    public function User(){
        return $this->belongsTo('App\User');
    }
    public function Branch(){
        return $this->belongsTo('App\Branch');
    }
    public function Sale(){
        return $this->hasMany('App\Sale');
    }
}
