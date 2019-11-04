<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\UserDetail;
use App\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id)->with('UserDetail')->first();
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
