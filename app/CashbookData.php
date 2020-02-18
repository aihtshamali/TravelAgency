<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashbookData extends Model
{
    protected $table="CashBook_Data";
    protected $primaryKey  = "RecordID";
    public $timestamps = false;
    public $incrementing = false;
       public function PaymentForm(){
        return $this->belongsTo('App\PaymentForm');
    }
      public function Bank(){
        return $this->belongsTo('App\Bank');
    }
     public function User(){
        return $this->belongsTo('App\User','posted_by_id');
    }
}
