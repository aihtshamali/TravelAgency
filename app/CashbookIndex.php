<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashbookIndex extends Model
{
    protected $table="CashBook_Index";
     public function User(){
        return $this->belongsTo('App\User','closed_by_id');
    }
}
