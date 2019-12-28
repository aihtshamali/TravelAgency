<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleAttachment extends Model
{
   protected $table ="CRM_Sale";
      protected $primaryKey = "SaleID";
    public function Sale(){   
        return $this->belongsTo('App\Sale','Sale_id');
    }
}
