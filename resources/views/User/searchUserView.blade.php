@extends('layouts.userLayout')
@section('styleTags')   
   <style>
   label{
    font-weight: 500 !important;
}
.card-footer{
    background: white !important;
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
                                <option value="uid">User ID</option>
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
                            <input type="text" class="form-control">
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-md btn-info " type="submit">Search User</button>
                    </div>
                </div>

            <div class="clearfix"></div>
        </form>
    </div>
@endsection