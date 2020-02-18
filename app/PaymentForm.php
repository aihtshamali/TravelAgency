<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentForm extends Model
{
    public function Payments(){
        return $this->hasMany('App\Payment');
    }
    public function CashbookData(){
        return $this->hasMany('App\CashbookData');
    }
}
