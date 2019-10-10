<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table ="CRM_Sale";
    protected $primaryKey = "SaleID";

    //
    public function Leadtype(){
        return $this->hasOne('App\LeadType','id');
    }
    public function PostedUser(){
        return $this->hasOne('App\User','id');
    }
    public function Sector(){
        return $this->hasOne('App\Sector','id');
    }
    public function UserBranch(){
        return $this->hasOne('App\UserBranch','id');
    }
    public function ActionBy(){
        return $this->belongsTo('App\User','action_by');
    }
}
