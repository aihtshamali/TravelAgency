<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\UserDetail;
use App\User;
use App\LoginLog;
use App\LoginAudit;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use DB;
use Auth;
class UserController extends Controller
{
    
      use HasRoles;
    
    public function index()
    {
        // dd('ok');
        $active_users=User::where('status','=',true)->get()->count();
        $block_users=User::where('status','=',false)->get()->count();
       return view("User.index",compact('active_users','block_users'));
    }

    public function create(Request $request)
    {
     return view("User.create");
    }
    
    public function assignRole(Request $request)
    {
        $user=User::find($request->user_id);
        $user=$user->assignRole($request->role_id);
       return redirect()->back()->with('success','Role has been assigned.');
    }
    public function removerole(Request $request)
    {
    
        $user=User::find($request->user_id);
        $user=$user->removeRole($request->role_id);
       return redirect()->back()->with('success','Role has been removed.');
    }
    
    public function searchUserView()
    {
         return view("User.searchUserView");
    }
    
     public function searchUser(Request $request)
    {
        $search="";
        if($request->SearchIn == "name")
        {
          if($request->Criteria == "contains")
        {
            $search=User::where("name","like","%".$request->searchtext."%")->get();
        }
        elseif($request->Criteria == "exact")
         {
         $search=User::where('name','=',$request->searchtext)->get();
         }
        elseif($request->Criteria == "starts")
        {
        $search=User::where("name","like",$request->searchtext."%")->get();
        }
        elseif($request->Criteria == "ends")
        {
         $search=User::where("name","like","%".$request->searchtext)->get();
        }
        else{
         $search="No match Found";
         return view("User.searchUserView",compact('search'));
        }
        return view("User.searchUserView",compact('search'));
            
        }
        elseif($request->SearchIn == "uname")
        {
          if($request->Criteria == "contains")
        {
            $search=User::where("user_name","like","%".$request->searchtext."%")->get();
        }
        elseif($request->Criteria == "exact")
         {
         $search=User::where('user_name','=',$request->searchtext)->get();
         }
        elseif($request->Criteria == "starts")
        {
        $search=User::where("user_name","like",$request->searchtext."%")->get();
        }
        elseif($request->Criteria == "ends")
        {
         $search=User::where("user_name","like","%".$request->searchtext)->get();
        }
          else{
         $search="No match Found";
         return view("User.searchUserView",['search'=>$search]);
        }
      return view("User.searchUserView",['search'=>$search]);
         
    }
       
         
    }
      public function activeUser(Request $request)
    {
       $active_users=User::where('status','=',true)->get();
         return view("User.activeUser",compact('active_users'));
    }
    
    public function blockUser(Request $request)
    {
       $block_users=User::where('status','=',false)->get();
         return view("User.blockUser",compact('block_users'));
    }

    public function userActivitylogView(){
    
      $loginAuditdetails=LoginAudit::all();
         return view("User.userActivitylogView",compact('loginAuditdetails'));
    }

      public function rolesAuthorityView(){
      $roles =Role::all();
   
         return view("User.rolesAuthorityView",compact('roles'));
    }
     public function assignedUsertoRoles($id)
     {
         $roles =Role::all();
         $searched_Role=Role::find($id);
         $assigned_rolesUsers=DB::table('model_has_roles')->where('role_id',$id)
         ->leftjoin('Login_Users','Login_Users.id','=','model_has_roles.model_id')
         ->get();
        //  ->join('roles','roles.id','=','model_has_roles.roles.id')->get();
          return view("User.rolesAuthorityView",compact('assigned_rolesUsers','roles','searched_Role'));
     }
    
    public function userDetails( Request $req){
  
    $user= User::find($req->userId);
    $user_Roles=$user->roles;
    $roles =Role::all();
    $logindetails=LoginLog::where('UserRef','=',$user->user_name)->get();
    $loginAuditdetails=LoginAudit::where('ActionOn','=',$user->user_name)->get();
    $loginAuditBy=LoginAudit::where('ActionOn','=',$user->user_name)->get();
    // dd($loginAuditdetails);
      return view("User.userDetails",compact('user','roles','user_Roles','logindetails','loginAuditdetails'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $request->validate([
          'user_name' => 'required|unique:Login_Users',
          'email' => 'required|unique:Login_Users|email',
          'name' => 'required|unique:Login_Users',
         
        ]);
        $data = DB::select('exec sp_Login_CreateUser "'.$request->user_name.'","'.$request->email.'","'.$request->name.'","'.Hash::make($request->password).'","'.Auth::user()->name.'"');
        if($data[0]->status==0)        
            return redirect()->back()->with('success','User has been created.');
        if($data[0]->status==1)        
            return redirect()->back()->with('error','User already Exist.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id',$id)->with('UserDetail')->first();
        return view('User.details',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('User.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDetails(Request $request)
    {
         $user = User::find($request->id);
         if($user){
             $user->name = $request->name; 
             $user->email = $request->email; 
             if($request->password != null)
             {
                $user->password = Hash::make($request->password);
             }
            $user->status=$request->update_status;
            $user->update();
          return redirect()->back()->with('success','Updated Successfully!');

        }
        return redirect()->back()->with('error','No User Found!');
    }
    
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($user){
            $user->name = $request->name; 
            $user->email = $request->email; 
            if($request->password)
                $user->password = Hash::make($request->password);
            $user->update();

            $userDetail = UserDetail::where('user_id',$id)->first();
            if($userDetail->count()==0)
                $userDetail = new UserDetail();
            $userDetail->address = $request->address;
            $userDetail->dob = $request->dob;
            $userDetail->cnic_no = $request->cnic_no;
            if(!is_dir('storage/attachments')){
                mkdir('storage/attachments');
            }
            if(!is_dir('storage/attachments/'.$user->id)){
                mkdir('storage/attachments/'.$user->id);
            }
            if($request->hasFile('cnic_front'))
            {
                $request->file('cnic_front')->store('public/attachments/'.$user->id.'/');
                $userDetail->cnic_attachment_front = $request->file('cnic_front')->hashName();
            }
            if($request->hasFile('cnic_back'))
            {
                $request->file('cnic_back')->store('public/attachments/'.$user->id.'/');
                $userDetail->cnic_attachment_back = $request->file('cnic_back')->hashName();
            }
            if($request->hasFile('profile_pic'))
            {
                $request->file('profile_pic')->store('public/attachments/'.$user->id.'/');
                $userDetail->profile_pic = $request->file('profile_pic')->hashName();
            }
            $userDetail->user_id = $user->id;
            $userDetail->save();

            return redirect()->route('User.show',$id)->with('success','Updated Successfully!');

        }
        return redirect()->back()->with('error','No User Found!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
