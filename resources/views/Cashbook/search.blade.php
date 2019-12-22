@extends('layouts.cashbookLayout')
@section('styleTags')   
<link rel="stylesheet" href="{{asset('css/cashbookCustom.css')}}">
@endsection 
@section('content')
    <div class="content-wrapper">
        @include('inc/flashMessages')
        {{-- Header Start --}}
         <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><b>Search</b></h1>
                    </div> 
                </div>
            </div>
        </div>
        {{-- Header End --}} 
            <div class="card">
            <form action="{{route('summarydetails')}}" method="get">
             @csrf
             <div class="card-body">
                <div class="form-group">
                    <label for="" class="label1">Select Branch</label>
                    <select name="branch" class="form-control">
                    <option value="" disabled Selected>Choose Option</option>
                     <option value="HDQ">HDQ</option>
                    </select>
                </div>
                  <div class="form-group">
                     <label for="" class="label1">Select Date</label>
                     <input type="date" name="date" class="form-control">
                </div>
                  <div class="form-group">
                  <button class="btn btn-lg btn-success">Search</button>
                </div>
              </div>
            </form>
            </div>
    </div>
@endsection
    