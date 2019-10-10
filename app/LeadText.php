<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadText extends Model
{
    protected $table = "CRM_Leads_Text";
    protected $primaryKey = "LeadRef";
    const CREATED_AT = null;
    const UPDATED_AT = null;


    public function Lead(){
        return $this->belongsTo('App\Lead','LeadRef');
    }
}
