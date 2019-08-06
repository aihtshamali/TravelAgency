<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = "CRM_Leads";
    protected $primaryKey = "LeadID";
    const CREATED_AT = 'CreatedOn';
    const UPDATED_AT = 'LastUpdatedOn';

    public function Leadtype(){
        return $this->belongsTo('App\LeadType');
    }
    // public function Customer(){
    //     return $this->hasMany('App\Customer','CustomerID');
    // }
}
