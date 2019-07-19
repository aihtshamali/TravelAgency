<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "CRM_Customers";
    const CREATED_AT = 'CreatedOn';
    const UPDATED_AT = 'UpdatedOn';

    public static function boot() {
        parent::boot();

        static::creating(function($model){
            foreach ($model->attributes as $key => $value) {
                $model->{$key} = empty($value) ? NULL : $value;
            }
        });

        static::updating(function($model){
            foreach ($model->attributes as $key => $value) {
                $model->{$key} = empty($value) ? NULL : $value;
            }
        });
    }
}
