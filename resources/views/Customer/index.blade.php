@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        {{-- Header Start --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Customers</h1>
                    </div> 
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li> 
                            <li class="breadcrumb-item active">Customers
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- Header End --}}
        <form action="{{route('customer-search')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Search by Name</h3></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="search-name">Customer Name</label>
                                <input type="text" name="name" id="search-name" class="form-control">
                            </div>
                                <input type="submit" value="Search" class="btn btn-primary pull-right">
                        </div> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Search by Phone</h3></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="search-phone">Customer Phone</label>
                                <input type="text" name="phone" placeholder="03xxxxxxxxx" id="search-phone" class="form-control">
                            </div>
                                <input type="submit" value="Search" class="btn btn-primary pull-right">
                        </div> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Search by Account</h3></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="search-account">Customer Account No.</label>
                                <input type="text" name="account" placeholder="" id="search-account" class="form-control">
                            </div>
                                <input type="submit" value="Search" class="btn btn-primary pull-right">
                        </div> 
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection