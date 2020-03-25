@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        @include('inc/flashMessages')

        {{-- Header Start --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><b>Create New Lead</b></h1>
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        {{-- Header End --}}
        <form action="{{route('customerLead')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                       
                        <div class="card-body">
                        <h3 class="card-title mb-2"><b>Customer's Phone Number</b></h3>
                            <div class="form-group">
                                <input type="text" required name="PhoneNumber" placeholder="03xxxxxxxxx" id="search-number" class="form-control">
                            </div>
                                <input type="submit" value="Search" class="btn btn-primary pull-left">
                        </div> 
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection