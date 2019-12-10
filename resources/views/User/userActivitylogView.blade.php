@extends('layouts.userLayout')
@section('styleTags')   
    <link rel="stylesheet" href="{{asset('css/userCustom.css')}}">
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
                 <td>
                 {{$loginAuditdetail->RecordID}}</td>
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

