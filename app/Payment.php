<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $timestamps = false;
    protected $table ="CRM_Payments";
    protected $primaryKey = "PaymentID";
    const CREATED_AT = 'PostedOn';
}
