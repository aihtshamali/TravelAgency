@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        @include('inc/flashMessages')
        {{-- Header Start --}}
         <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{$user->name}}'s Details</h1>
                    </div> 
                </div>
            </div>
        </div>
        {{-- Header End --}}  
        <div class="row mr-2">
            <div class="col-md-12">
               <div class="card text-center">
                   <div class="card-body">
                    <table class="table card-body">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Dob</th>
                                <th>Cnic No</th>
                               
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td><a href="mailto:{{$user->email}}">
                                        {{$user->email}}
                                        </a></td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{isset($user->UserDetail->dob) ? $user->UserDetail->dob : '-'}}</td>
                                    <td>{{isset($user->UserDetail->cnic_no) ? $user->UserDetail->cnic_no : '-'}}</td>
                                </tr>
                                
                            </tbody>
                        </table>
                   </div>
               </div>
            </div>
        </div>
    </div>

@endsection