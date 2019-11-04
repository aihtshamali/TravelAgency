<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
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
            $user->password = Hash::make($request->email);
            $user->update();

            $userDetail = UserDetail::where('user_id',$id)->get();
            if(!$userDetail)
                $userDetail = new UserDetail();
            $userDetail->address = $request->address;
            $userDetail->dob = $request->dob;
            $userDetail->cnic_no = $request->cnic_no;
            if(!is_dir('storage/uploads/attachments')){
                mkdir('storage/uploads/attachments');
            }
            if(!is_dir('storage/uploads/attachments/'.$user->id)){
                mkdir('storage/uploads/attachments/'.$user->id);
            }
            if($request->hasFile('cnic_front'))
            {
                $request->file('cnic_front')->store('public/uploads/attachments/'.$user->id.'/');
                dd('asd');
        
            }
            $userDetail->attach = $request->cnic_no;

        }
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
