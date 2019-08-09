@extends('layouts.master')
@section('content')
    <div class="content-wrapper">

        {{-- Header Start --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Search by Lead ID</h1>
                    </div> 
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li> 
                            <li class="breadcrumb-item active">Search-by-ID
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
        <form action="{{route('leads.show')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Lead By ID</h3></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="search-id">Lead ID</label>
                                <input type="number" min="1" required name="lead_id" placeholder="Enter Lead ID ..." id="search-id" class="form-control">
                            </div>
                                <input type="submit" value="Search" class="btn btn-primary pull-right">
                        </div> 
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection