@extends('layouts.master')
@section('content')
    <div class="content-wrapper">

        {{-- Header Start --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Create New Lead</h1>
                    </div> 
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li> 
                            <li class="breadcrumb-item active">Phone Search
                            </li>
                        </ol>
                    </div>
                </div>
               
            </div>
        </div>
         @if ($errors->has('Wrong Number'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                    {{ $errors->first('Wrong Number') }}
                </div>
        @endif
        {{-- Header End --}}
        <form action="{{route('customerLead')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Phone Number</h3></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="search-number">Customer Phone Number</label>
                                <input type="text" required name="PhoneNumber" placeholder="03xxxxxxxxx" id="search-number" class="form-control">
                            </div>
                                <input type="submit" value="Search" class="btn btn-primary pull-right">
                        </div> 
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection