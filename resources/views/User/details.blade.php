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
                    <table class="table table-responsive card-body">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Dob</th>
                                <th>Cnic No</th>
                                <th>Cnic Attachment</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td><a href="mailto:{{$user->email}}">
                                        {{$user->email}}
                                        </a></td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->address}}</td>
                                    <td>{{$user->dob}}</td>
                                    <td>{{$user->cnic_no}}</td>
                                    <td>{{$user->cnic_attacment_front || $user->cnic_attacment_end ? 'Attached' : 'N\A'}}</td>
                                    <td><a href="{{route('User.edit',$user->id)}}">Edit</a></td>
                                </tr>
                            </tbody>
                        </table>
                   </div>
               </div>
            </div>
        </div>
    </div>

@endsection