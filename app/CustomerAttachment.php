<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerAttachment extends Model
{
   protected $table="customer_attachments";
    public function Customer(){   
        return $this->belongsTo('App\Customer');
    }
}
