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
                        <h1 class="m-0 text-dark"><b>Quick Info</b></h1>
                    </div> 
                </div>
            </div>
        </div>
        {{-- Header End --}}  
        
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                            <a href="{{route('activeUser')}}" class="activeshadow"> 
                        <div class="card-body greentick">
                        <div><img alt="" src="{{asset('images/checkmark.png')}}"></div> 
                        <span>
                        <strong>{{$active_users}}</strong><br> Active Users
                        </span>
                        </div>
                    </a>
                    </div>
                </div>
                 <div class="col-md-6">
                     <div class="card">
                            <a href="{{route('blockUser')}}" class="blockshadow"> 
                         <div class="card-body redtick">
                        <div><img alt="" src="{{asset('images/cross.png')}}"></div> 
                        <span>
                            <strong>{{$block_users}}</strong><br> Blocked Users
                        </span>
                        </div>
                    </a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
    </div>
@endsection