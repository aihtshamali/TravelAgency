@extends('layouts.master')
@section('styleTags')
<style>
.badge{
    padding:7% !important;
    font-size:15px !important;
}
.cardgap{
margin-left:4%;
}
</style>
@endsection 
@section('content')
    <div class="content-wrapper" style="margin-top:2%;">
        @include('inc/flashMessages')
       <div class="row">
            <div class="card col-md-12 ">
        
            </div>
        </div>
    </div>   
@endsection
@section('javascript')

@endsection