@extends('layouts.master')
@section('content')
<div class="content-wrapper">
        {{-- Header Start --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 pl-0" >
                        <h1 class="m-0 text-dark">Welcome {{Auth::user()->name}},</h1>
                    </div> 
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li> 
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- Header End --}}
</div>
    
@endsection