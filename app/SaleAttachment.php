<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleAttachment extends Model
{
    protected $table="sale_attachments";
    public function Sale(){   
        return $this->belongsTo('App\Sale');
    }
}
