@extends('layouts.userLayout')
@section('styleTags')   
    <link rel="stylesheet" href="{{asset('css/userCustom.css')}}">
<style>
    table thead th{    
    font-weight: 400 !important;
    background-color: rgb(31,38,45) !important;
    color: #ffffff !important;
    text-align: center !important;
}
table tbody td{
 font-weight: 400 !important;
 text-align: center !important;
}
td img,th img{
    height: 16px !important;
    width:16px !important;
}
.tablecard>.table>tbody>tr>td, .tablecard>.table>thead>tr>th {
    border-top-width: 0;
    padding: 4px;
}
.loginRecordtable thead th , .loginRecordtable tbody td{
padding: 4px;
}
.cardgap{
    margin-left: 4%;
}
    </style>
@endsection 
@section('content')
    <div class="content-wrapper">
        @include('inc/flashMessages')
        {{-- Header Start --}}
         <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><b>{{$user->name}}'s Details</b></h1>
                    </div> 
                </div>
            </div>
        </div>
        {{-- Header End --}}  
      <div class="card">
        <div class="card-body tablecard">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th> 
                    <th>Account Created</th>
                    <th>Login Count</th>
                    <th>Last Access</th>
                    <th>Login Status</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td> {{$user->id}} </td>
                <td>{{Date('d-M-y',strtotime($user->created_at))}}
                |  {{Date('h:i:s A',strtotime($user->created_at))}}
                   </td>
            <td> {{$user->login_count}}</td>
                <td>
                {{Date('d-M-y',strtotime($user->updated_at))}}
                |{{Date('h:i:s A',strtotime($user->updated_at))}}
            </td>
                <td>
                @if($user->login_status == '1')
                Online <img alt="Online" src="{{asset('images/online.png')}}">
                @elseif($user->login_status == '0')
                Offline <img alt="Offline" src="{{asset('images/offline.png')}}">
                @endif 
            </td>
            </tr>
            </tbody>
        </table>
        </div>
      </div>
      
    <form action="{{route('updateDetails')}}" method="Post">
             @csrf
          <div class="card">
              <div class="row card-body">
                <div class="offset-md-1 col-md-5 col-lg-5  shadow-md p-3  bg-white rounded">
                        <div class="form-group">
                            <label for="" class="">Full Name</label>
                        <input type="text" pattern=".{3,}" class="form-control"  value="{{$user->name}}" name="name" placeholder="Minimum 3 Character">
                        </div>
                        <div class="form-group">
                            <label for="" class="">Email Address</label>
                            <input type="email" class="form-control"  name="email"  value="{{$user->email}}" placeholder="Must be a valid email-address.">
                        </div>
              
                  </div>
                <div class=" col-md-5 col-lg-5  shadow-md p-3  bg-white rounded">
                    <div class="form-group">
                            <label for="" class="">Password</label>
                            <input type="password"  pattern=".{6,}"class="form-control"  name="password" placeholder="Minimum 6 Character">
                        </div> 
                        <div class="form-group">
                            <label for="" class="">Account Status</label>
                            <select name="update_status" class="form-control" id="">
                                <option value="" selected disabled>Choose One</option>
                                <option value="1" {{$user->status == '1' ? "selected" : ""}} style="color:white; background:rgba(56, 212, 54, 0.98);">Active</option>
                                <option value="0" {{$user->status == '0' ? "selected" : ""}} style="background:rgb(212, 33, 33); color:white;">Block</option>
                            </select> 
                        </div> 
                </div>
            <input type="hidden" name="id" value="{{$user->id}}">
                <button class="col-md-4 offset-md-4 btn btn-lg btn-info text-center" type="submit">Update Info</button>
            </div>
          </div>
       </form>
          
        <div class="row">
            <div class="card col-md-5 cardgap ">
            <div class="card-body tablecard ">
                <h4><b>Assigned Roles</b></h4>
              <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Role Name</th>
                        <th>Role Details</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($user_Roles as $uRole )
                     <tr>
                     <td>{{$uRole->name}}</td>
                     <td>{{$uRole->discription}}</td>
                        <td>
                        <form action="{{route('removerole')}}" method="Post">
                              @csrf
                              <input type="hidden" name="role_id" value="{{$uRole->id}}">
                              <input type="hidden" name="user_id" value="{{$user->id}}">
                            <button class="btn btn-sm btn-danger"  type="submit">
                                  x
                            </button>
                        </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </table>
            </div>
          </div>
          <div class="card col-md-5 offset-md-1">
            <form action="{{route('assignRole')}}" method="Post">
                 @csrf
             <div class="card-body ">
                <h4><b>Assign New Role</b></h4>
                <div class="form-group">
                <label for="">New Role</label>
                <select class="form-control" name="role_id">
                <option value="" disabled selected>Choose Role</option>
                 @foreach ($roles as $role )
                <option value="{{$role->id}}">{{$role->name}}</option>
                 @endforeach
                </select>
                </div>
                   <input type="hidden" name="user_id" value="{{$user->id}}">
                    <button class="btn btn-md btn-success pull-right" type="submit"> Add Role</button>
                </div>
            </form>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
             <h4><b>Login Record</b></h4>
           </div>
           <div class="card-body">
            <table class="table table-bordered tablecard loginRecordtable" id="">
                <thead>
                    <tr>
                        <th>Login Time</th>
                        <th>Browser</th>
                        <th>IP Address</th>
                        
                    </tr>
                </thead>
                <tbody>
                @foreach ($logindetails as $userlog )
                     <tr>
                     <td>  {{Date('d-M-y',strtotime($userlog->LogTime))}}
                        | {{Date('h:i:s A',strtotime($userlog->LogTime))}}</td>
                        <td>{{$userlog->BrowserID}}</td>
                        <td>{{$userlog->IPAddress}}</td>
                    </tr>
                @endforeach
                   
                </tbody>
            </table>
         </div>
        </div>
        
           <div class="card">
           <div class="card-header">
           <h4><b>Account Actions
           <span style="padding: 1px 5px 1px 5px; background:firebrick; color:white;">{{$user->name}} </span> </b></h4>
           </div>
         <div class="card-body">
          <table class="table table-bordered loginRecordtable" id="">
            <thead>
              <tr>
                    <th>Log ID</th>
                    <th>Action On</th>
                    <th>Action By</th>
                    <th>Time</th>
                    <th>Action Code</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($loginAuditdetails as $loginAuditdetail )
                 <tr>
                 <td>{{$loginAuditdetail->RecordID}}</td>
                <td>  
                     <a href="{{route('showDetailByUserName',$loginAuditdetail->ActionOn)}}">{{$loginAuditdetail->ActionOn}}</a>               
                    </td>
                 <td>
                    <a href="{{route('showDetailByUserName',$loginAuditdetail->ActionBy)}}">{{$loginAuditdetail->ActionBy}}</a>               

                  </td>
                    <td>{{Date('d-M-y',strtotime($loginAuditdetail->ActionTime))}}
                |  {{Date('h:i:s A',strtotime($loginAuditdetail->ActionTime))}}</td>
                    <td>{{$loginAuditdetail->ActionCode}}</td>
                    <td>{{$loginAuditdetail->ActionDetails}}</td>
                </tr>
            @endforeach
               
            </tbody>
          </table>
         </div>
        </div>
    </div>
@endsection