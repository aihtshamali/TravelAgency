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
                        <h1 class="m-0 text-dark"><b>Log Activity List</b></h1>
                    </div> 
                </div>
            </div>
        </div>
        {{-- Header End --}}  
        <div class="card">
         <div class="card-body">
          <table class="table table-bordered" id="activitylogtable">
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
                <tr>
                    <td>43</td>
                <td><a href="">hamza</a></td>
                    <td><a href="ViewUser.aspx?user=qaiser">qaiser</a></td>
                    <td>30-Oct-19 (18:12)</td>
                    <td>Add Role</td>
                    <td>Role (CashBook_User) added</td>
                </tr>
            </tbody>
          </table>
         </div>
        </div>
    </div>
@endsection

