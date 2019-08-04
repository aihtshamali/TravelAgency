<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //
    public function UserBranch()
    {
        return $this->hasMany('App\UserBranch');
    }
}
