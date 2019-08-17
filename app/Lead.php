<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = "CRM_Leads";
    protected $primaryKey = "LeadID";
    const CREATED_AT = 'CreatedOn';
    const UPDATED_AT = 'LastUpdatedOn';

    public function Source(){
        return $this->belongsTo('App\Sector','LeadID');
    }
    public function Destination(){
        return $this->belongsTo('App\Sector','LeadID');
    }
    public function LastUpdatedBy(){
        return $this->belongsTo('App\User','LeadID');
    }
    public function ClosedBy(){
        return $this->belongsTo('App\User','LeadID');
    }
    public function TakenOverBy(){
        return $this->belongsTo('App\User','LeadID');
    }
    public function Leadtype(){
        return $this->belongsTo('App\LeadType','LeadID');
    }
    public function Customer(){
        return $this->belongsTo('App\Customer','CustomerIDRef');
    }
}
