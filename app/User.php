<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    protected $guard_name = 'web'; // or whatever guard you want to use

    use Notifiable;
    protected $table = "Login_Users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function UserBranch()
    {
        return $this->hasMany('App\UserBranch');
    }
    
    public function Lead(){
        return $this->hasOne('App\Lead','LeadID');
    }
    public function Sale(){
        return $this->hasOne('App\Sale','SaleID');
    }
    public function Payment(){
        return $this->hasOne('App\Payment','PaymentID');
    }
    public function UserDetail(){
        return $this->hasOne('App\UserDetail');
    }
    public function Customer(){
        return $this->hasOne('App\Customer','CustomerID');
    }
    
}
