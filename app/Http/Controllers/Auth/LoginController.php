<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\UserBranch;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/home';
    private function CopyUserToUserBranch(){
        $users = User::all();
        foreach($users as $user){
            if(!UserBranch::where('user_id',$user->id)->first())
            {
                $userbranch = new UserBranch();
                $userbranch->user_id = $user->id;
                $userbranch->branch_id = 1;
                $userbranch->save(); 
            }
        }
        dump("User Copied in UserBranches");
    }
    private function copyAllUsers(){
       
        $oldUsers= \App\LoginUserOld::all();
        foreach ($oldUsers as $Olduser) {
            $user = new \App\User();
            $user->login_count =  $Olduser->LoginCount;
            $user->user_name =  $Olduser->UserID;
            $user->name =  $Olduser->FullName;
            $user->password =  Hash::make("123456");
            $user->email =  $Olduser->Email;
            $user->login_status=$Olduser->LoginStatus;
            $user->status = $Olduser->IsActive;
            $user->browser_id=$Olduser->BrowserID;
            $user->created_at =  $Olduser->AccountCreated;
            $user->updated_at =  $Olduser->LoginTimeStamp;
         
            $user->save();
            
        }
        dump('User Updated');
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //   $this->copyAllUsers();
        //   $this->CopyUserToUserBranch();
         
        $this->middleware('guest')->except('logout');
    }
    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if($user){
            $user->login_count++;
            $user->update();
            $request->session()->put(['userbranch'=>$user->UserBranch->first()]);
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/');
    }
      /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'user_name';
    }
}
