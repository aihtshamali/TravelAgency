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
    background-color: rgb(31,38,45);
    color: #ffffff;
    text-align: center;
    padding:1px !important;
}

td img,th img{
    height: 16px;
    width:16px;
}
table.dataTable tbody th, table.dataTable tbody td {
padding:0px !important;
 font-size:14px !important;
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
                        <h1 class="m-0 text-dark"><b>Active User</b></h1>
                    </div> 
                </div>
            </div>
        </div>
        {{-- Header End --}}  
    
                <div class="card">
                    <div class="card-header">
                        <h4><b>User List</b></h4>
                    </div>
                    <div class="card-body ">
                         <table class="table table-bordered " data-page-length="100" id="activeUsers">
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
                              @foreach ($active_users as $userRole )
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
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>

            <div class="clearfix"></div>
    </div>
@endsection
@section('javascript')
<script>
$('#activeUsers').DataTable( {
     dom: 'Bfrtip',
     buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
} );
</script>
@endsection