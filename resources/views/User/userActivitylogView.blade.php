@extends('layouts.userLayout')
@section('styleTags')   
    <link rel="stylesheet" href="{{asset('css/userCustom.css')}}">
     
<style>
table thead th{    
    background-color: rgb(31,38,45);
    color: #ffffff;
    text-align: center;
}

td img,th img{
    height: 16px;
    width:16px;
}
table.dataTable tbody th, table.dataTable tbody td {
padding:4px !important;
 font-size:16px !important;
text-align: center;
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
          <table class="table table-bordered" data-page-length='500' id="activitylogtable">
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
                {{$loginAuditdetail->ActionOn}}
                {{-- <form action="{{route('userDetails',$user->id)}}" method="get">
                @csrf
                        <input type="hidden" name="userId" value="{{$user->id}}">
                        <button type="submit" style="background:lightskyblue; border:none;cursor:pointer;">{{$loginAuditdetail->ActionOn}}</button>
                    </form> --}}
                    </td>
                 <td>
                 {{$loginAuditdetail->ActionBy}}
                  {{-- <form action="{{route('userDetails',$user->id)}}" method="get">
                  @csrf
                        <input type="hidden" name="userId" value="{{$user->id}}">
                        <button type="submit" style="background:mediumpurple; border:none;cursor:pointer;">{{$loginAuditdetail->ActionBy}}</button>
                    </form> --}}
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

