@extends('layouts.app')
@section('styleTags')
  <style>
    .card
    {
      min-height:220px !important;
    }
  </style>
@endsection
@section('content')
<div class="container">
  
    <div class="row justify-content-center">
      <a href="{{route('home')}}">
      <div class="card mr-3" style="width: 12rem; text-align:center"> 
        <div class="card-body" style="align:center;">
          <img style="width:60%" src="{{url('/images/crm.png')}}">
        </div>
        <div class="card-footer">
            <h5 class="card-title">CRM</h5>
        </div>
      </div>
    </a>
    <a href="#">
      <div class="card mr-3" style="width: 12rem; text-align:center"> 
        <div class="card-body">
          <img style="width:60%" src="{{url('/images/accounts.png')}}">
        </div>
        <div class="card-footer">
            <h5 class="card-title">Cash Book</h5>
        </div>
      </div>
    </a>
    <a href="#">
      <div class="card mr-3" style="width: 12rem; text-align:center"> 
        <div class="card-body">
          <img style="width:60%" src="{{url('/images/user.png')}}">
        </div>
        <div class="card-footer">
            <h5 class="card-title">User Management</h5>
        </div>
      </div>
    </a>
    <a href="#">
      <div class="card mr-3" style="width: 12rem; text-align:center"> 
        <div class="card-body">
          <img style="width:60%" src="{{url('/images/db.png')}}">
        </div>
        <div class="card-footer">
            <h5 class="card-title">Database</h5>
        </div>
      </div>
    </a>
    <a href="#">  
    <div class="card mr-3" style="width: 12rem; text-align:center"> 
      <div class="card-body">
        <img style="width:60%" src="{{url('/images/settings.png')}}">
      </div>
      <div class="card-footer">
        <h5 class="card-title">My Account</h5>
      </div>
    </div>
    </a>
  </div>
</div>
@endsection
