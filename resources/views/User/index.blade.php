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
        <form action="#" method="post">
         @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body greentick">
                        <div><img alt="" src="{{asset('images/checkmark.png')}}"></div> 
                        <span>
                            <strong>6</strong><br> Active Users
                        </span>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="card">
                         <div class="card-body redtick">
                        <div><img alt="" src="{{asset('images/cross.png')}}"></div> 
                        <span>
                            <strong>2</strong><br> Blocked Users
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </form>
    </div>
@endsection