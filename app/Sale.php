<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table ="CRM_Sale";
    protected $primaryKey = "SaleID";

    //
    public function Customer(){
        return $this->belongsTo('App\Customer','CustomerIDRef');
    }
    public function Source(){
        return $this->belongsTo('App\Sector');
    }
    public function Destination(){
        return $this->belongsTo('App\Sector');
    }
    public function UserBranch(){
        return $this->belongsTo('App\UserBranch');
    }
    public function ActionByUser(){
        return $this->belongsTo('App\User','action_by');
    }
    public function PostedByUser(){
        return $this->belongsTo('App\User','posted_by_user');
    }
    public function Leadtype(){   
        return $this->belongsTo('App\LeadType','lead_type_id','id');
    }
     public function SaleAttachment(){   
        return $this->hasMany('App\SaleAttachment','Sale_id');
    }
}
