@extends('layouts.userLayout')
@section('styleTags')   
    <link rel="stylesheet" href="{{asset('css/userCustom.css')}}">
    <style>
 
table thead th{    
    font-weight: 400;
    background-color: rgb(31,38,45);
    color: #ffffff;
    text-align: center;
}
table tbody td{
 font-weight: 400;
 text-align: center;
}
td img,th img{
    height: 16px;
    width:16px;
}
.summarytable tbody td{
padding: 5px !important;
vertical-align: -webkit-baseline-middle !important;
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
                        <h1 class="m-0 text-dark"><b>Roles list</b></h1>
                    </div> 
                </div>
            </div>
        </div>
        {{-- Header End --}} 
   
            <div class="card">
             <div class="card-header">
                    <h4><b>Details</b></h4>
                </div>
             <div class="card-body">
              <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Role Description</th>
                                    <th>User Assigned</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role )
                                    <tr>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->discription}}</td>
                                    <td>
                                    <a href="{{route('assignedUsertoRoles',$role->id)}}">View Users</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
             </div>
            </div>
                 @if(isset($searched_Role->name))
              <div class="card">
                <div class="card-header">
                <h4><b>Search Results for <span style="color:firebrick;">{{$searched_Role->name}}</span></b></h4>
                </div>
                <div class="card-body">
                <table class="table table-bordered summarytable">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Full Name</th>
                            <th>Account Created</th>
                            <th>Login Status</th>
                            <th>Last Access</th>
                            <th>Account Active</th>
                            <th>View</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($assigned_rolesUsers[0]->name) && $assigned_rolesUsers[0]->name!=null) 
                        @foreach ($assigned_rolesUsers as $userRole )
                            <tr>
                                <td>{{$userRole->user_name}}</td>
                                <td>{{$userRole->name}}</td>
                              
                                <td>
                                    {{Date('d-M-y',strtotime($userRole->created_at))}}
                                    | {{Date('h:i:s A',strtotime($userRole->created_at))}}
                                </td>
                                <td>
                                    @if($userRole->login_status == '1')
                                   Online <img alt="Online" src="{{asset('images/online.png')}}">
                                    @elseif($userRole->login_status == '0')
                                   Offline <img alt="Offline" src="{{asset('images/offline.png')}}">
                                    @endif 
                                </td>
                                <td>
                                    {{Date('d-M-y',strtotime($userRole->updated_at))}}
                                    | {{Date('h:i:s A',strtotime($userRole->updated_at))}}
                                </td>
                                <td>
                                @if($userRole->status == '1')
                                   Active <img alt="active" src="{{asset('images/active.png')}}">
                                    @elseif($userRole->status == '0')
                                   Blocked <img alt="blocked" src="{{asset('images/blocked.png')}}">
                                    @endif 
                                </td>
                                <td>
                                  <form action="{{route('userDetails',$userRole->id)}}" >
                                    <input type="hidden" name="userId" value="{{$userRole->id}}">
                                    <button type="submit" class="btn btn-sm btn-primary">View</button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan='8'>
                        No Result Found
                        </td>
                    </tr>
                    @endif
                    </tbody>
                </table>
                </div>
             </div>
            <div class="clearfix"></div>
            @endif
    </div>
@endsection