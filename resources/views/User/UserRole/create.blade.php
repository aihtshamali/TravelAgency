@extends('layouts.userLayout')
@section('content')
    <div class="content-wrapper">
        @include('inc/flashMessages')
        {{-- Header Start --}}
         <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Create Role</h1>
                    </div> 
                </div>
            </div>
        </div>
        {{-- Header End --}}  
        <form action="{{route('')}}" method="post">
        
        </form>
    </div>
@endsection