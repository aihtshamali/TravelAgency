<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = "CRM_Leads";
    protected $primaryKey = "LeadID";
    public $incrementing = true;

    const CREATED_AT = 'CreatedOn';
    const UPDATED_AT = 'LastUpdatedOn';

    public function Source(){
        return $this->belongsTo('App\Sector');
    }
    public function Destination(){
        return $this->belongsTo('App\Sector');
    }
    public function LastUpdatedBy(){
        return $this->belongsTo('App\User','last_updated_by');
    }
    public function ClosedBy(){
        return $this->belongsTo('App\User','closed_by');
    }
    public function TakenOverBy(){
        return $this->belongsTo('App\User','taken_over_by');
    }
    public function LeadType(){
        return $this->belongsTo('App\LeadType');
    }
    public function User(){
        return $this->belongsTo('App\User','user_id');
    }
    public function Customer(){
        return $this->belongsTo('App\Customer','CustomerIDRef');
    }
    public function LeadText(){
        return $this->hasOne('App\LeadText','LeadRef');
    }
}
