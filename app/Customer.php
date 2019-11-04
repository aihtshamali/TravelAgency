<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "CRM_Customers";
    protected $primaryKey = 'CustomerID';
    const CREATED_AT = 'CreatedOn';
    const UPDATED_AT = 'UpdatedOn';

    public function CustomerType(){
        return $this->belongsTo('App\CustomerType');
    }
    public function Leads(){
        return $this->hasMany('App\Lead','LeadID');
    }
    public function Sales(){
        return $this->hasMany('App\Sale','SaleID');
    }

}
