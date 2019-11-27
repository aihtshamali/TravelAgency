@extends('layouts.userLayout')
<style>
label{
    font-weight: 500 !important;
}
.card-footer{
    background: white !important;
}
.cardgap{
    margin-left: 1%;
}
ol{
    margin-left:-7% !important;
}
ol li{
    padding:2%;
}
</style>
@section('content')
    <div class="content-wrapper">
        @include('inc/flashMessages')
        {{-- Header Start --}}
         {{-- <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><b>Create New User</b></h1>
                    </div> 
                </div>
            </div>
        </div> --}}
        {{-- Header End --}}  
    <form action="{{route('User.store')}}" method="post">
         @csrf
         <div class="row">
            <div class="offset-md-1 col-md-5 col-lg-5 card shadow-lg p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    <h4><b>Create New User</b></h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="" class="">User ID</label>
                        <input type="text" class="form-control" required name="userid" placeholder="Minimum 3 Character">
                    </div>
                    <div class="form-group">
                        <label for="" class="">Full Name</label>
                        <input type="text" class="form-control" required name="user_name" placeholder="Minimum 3 Character">
                    </div>
                    <div class="form-group">
                        <label for="" class="">Email Address</label>
                        <input type="email" class="form-control" required name="user_email" placeholder="Must be a valid email-address.">
                    </div>
                    <div class="form-group">
                        <label for="" class="">Password</label>
                        <input type="password" class="form-control" required name="user_password" placeholder="Minimum 6 Character">
                    </div>
                    </div>
                <div class="card-footer" >
                    <button class="btn btn-md btn-success pull-right" type="submit">Create New User</button>
                    {{-- <button class="btn btn-md btn-danger pull-right" type="submit">Cancel</button> --}}
                </div>
            </div>

             <div class="col-md-5 col-lg-5 card cardgap shadow-lg p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    <h4><b>Instructions</b></h4>
                </div>
                <div class="card-body">
                    <ol>
                        <li>
                            <strong>User ID</strong> must be between 3 to 30 characters long. Only alphabets, numbers, dots, hyphens and underscores are allowed.
                        </li>
                        <li>
                           <strong> Full Name </strong> must be minimum 3 characters long. Only alphabets and spaces are allowed.
                        </li>
                        <li>
                            <strong>Email</strong> must be a valid e-mail address.
                        </li>
                        <li>
                            <strong>Password</strong> minimum 6 characters and maximum 15 characters long.
                        </li>
                    </ol>
                </div>
            </div>
             <div class="col-md-1"></div>
         
            </div>
     

        
        </form>
    </div>
@endsection