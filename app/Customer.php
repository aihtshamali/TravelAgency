<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "CRM_Customers";
    const CREATED_AT = 'CreatedOn';
    const UPDATED_AT = 'UpdatedOn';
}
