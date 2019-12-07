@extends('layouts.userLayout')
@section('styleTags')   
   <style>
   label{
    font-weight: 500 !important;
}
.card-footer{
    background: white !important;
}
.table thead th{    
    font-weight: 400;
    background-color: rgb(31,38,45);
    color: #ffffff;
    text-align: center;
    padding:4px;
}
.table tbody td{
 font-weight: 400;
 text-align: center;
 padding:4px;
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
                        <h1 class="m-0 text-dark"><b>Search User</b></h1>
                    </div> 
                </div>
            </div>
        </div>
        {{-- Header End --}}  
    <form action="{{route("searchUser")}}" method="post">
         @csrf
                <div class="card">
                    <div class="card-header">
                        <h4><b>Search Criteria</b></h4>
                    </div>
                    <div class="card-body ">
                        <div class="form-group">
                            <label>Search In</label>
                            <select name="SearchIn" class="form-control">
                                <option value="name">Full Name</option>
                                 <option value="uname">User Name</option>
                            </select>
                            
                        </div>
                        <div class="form-group">
                            <label>Criteria</label>
                            <select name="Criteria" class="form-control">
                                <option value="contains">Contains</option>
                                <option value="exact">Exactly Match</option>
                                <option value="starts">Starts From</option>
                                <option value="ends">Ends At</option>
                            </select>
                        </div>
                         <div class="form-group">
                            <label>Search Text</label>
                            <input type="text" pattern=".{3,}" name="searchtext" class="form-control">
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-md btn-success " type="submit">Search User</button>
                    </div>
                </div>

            <div class="clearfix"></div>
        </form>
        @if(isset($search))
         <div class="row">
          <div class="card  col-md-12">
           <div class="card-body">
                <table class="table table-bordered searchtable">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Login Count</th>
                            <th>Full Name</th>
                            <th>Account Created</th>
                            <th>Login Status</th>
                            <th>Last Access</th>
                            <th>Account Active</th>
                            <th>View</th>
                        </tr>
                       
                    </thead>
                    <tbody>
                      @if(isset($search) && $search!=null )
                        @foreach ($search as $user_search)
                         <tr>
                         <td> {{$user_search->id}} </td>
                         <td> {{$user_search->login_count}}</td>
                         <td>{{$user_search->name}}</td>
                        <td>{{Date('d-M-y',strtotime($user_search->created_at))}}
                           | {{Date('h:i:s A',strtotime($user_search->created_at))}}
                        </td>
                         <td>
                         @if($user_search->login_status == '1')
                          <img alt="Online" src="{{asset('images/online.png')}}">
                         @elseif($user_search->login_status == '0')
                          <img alt="Offline" src="{{asset('images/offline.png')}}">
                         @endif 
                        </td>
                         <td>{{Date('d-M-y',strtotime($user_search->updated_at))}}
                           | {{Date('h:i:s A',strtotime($user_search->updated_at))}}</td>
                         <td>
                         @if($user_search->status == '1')
                         <img alt="Active" src="{{asset('images/active.png')}}">
                         @elseif($user_search->status == '0')
                         <img alt="Block" src="{{asset('images/blocked.png')}}">
                         @endif 
                        </td>
                    <td>
                    <form action="{{route('userDetails',$user_search->id)}}" >
                        <input type="hidden" name="userId" value="{{$user_search->id}}">
                        <button type="submit" class="btn btn-sm btn-primary">View Details</button>
                    </form>
                    </td>
                         </tr>
                         @endforeach
                    @else
                </tr>
                       <td colspan="7">{{$search}}</td>            
                <tr>
                    @endif
                    </tbody>
                </table>
           </div>
          </div>
         </div>
        @endif
    </div>
@endsection