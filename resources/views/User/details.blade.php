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
                                    <td>{{$user->UserDetail->address}}</td>
                                    <td>{{$user->UserDetail->dob}}</td>
                                    <td>{{$user->UserDetail->cnic_no}}</td>
                                    <td><a href="{{$user->UserDetail->cnic_attachment_front ? asset('storage/attachments/'.$user->id.'/'.$user->UserDetail->cnic_attachment_front) : '#'}}" download>{{$user->UserDetail->cnic_attachment_front ? 'Front Attached' : 'Front N\A'}} </a> |
                                    <a href="{{$user->UserDetail->cnic_attachment_back ? asset('storage/attachments/'.$user->id.'/'.$user->UserDetail->cnic_attachment_back) : '#'}}" download>{{$user->UserDetail->cnic_attachment_back ? 'Back Attached' : 'Back N\A'}} </a></td>
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