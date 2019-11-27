@extends('layouts.userLayout')
@section('styleTags')   
   <style>
   label{
    font-weight: 500 !important;
}
.card-footer{
    background: white !important;
}
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
                        <h1 class="m-0 text-dark"><b>Active User</b></h1>
                    </div> 
                </div>
            </div>
        </div>
        {{-- Header End --}}  
    <form action="{{route("activeUser")}}" method="post">
         @csrf
           
                <div class="card">
                    <div class="card-header">
                        <h4><b>User List</b></h4>
                    </div>
                    <div class="card-body ">
                         <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Full Name</th>
                                    <th>Account Created</th>
                                    <th>Login Status</th>
                                    <th>Last Access</th>
                                    <th>Account Active</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>admin</td>
                                    <td>Administrator</td>
                                    <td>14-Dec-17 (00:10)</td>
                                    <td><img alt="Offline" src="{{asset('images/online.png')}}"></td>
                                    <td>31-Jan-19 (19:06)</td><td><img alt="Active" src="{{asset('images/active.png')}}"></td>
                                    <td><a href="">View</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>

            <div class="clearfix"></div>
        </form>
    </div>
@endsection