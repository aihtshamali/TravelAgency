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
}
