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
        <form action="{{route('User.update',$user->id)}}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @method('patch')
            {{ csrf_field() }}
            <div class="row mr-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" required autocomplete="off" class="form-control" name="name" id="name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" required autocomplete="off" class="form-control" name="email" id="email">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" required autocomplete="off" class="form-control" name="password" id="password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" name="address" id="address">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dob">DOB(01-29-1999)</label>
                                        <input type="date" class="form-control" name="dob" id="dob">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cnic_no">CNIC #</label>
                                        <input type="password" class="form-control" name="cnic_no" id="cnic_no">
                                    </div>
                                </div>

                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                   <label for=""><h3>Attachments:</h3></label>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cnic_front">CNIC Front</label>
                                        <input type="file" class="form-control" name="cnic_front" id="cnic_front">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cnic_back">CNIC Back</label>
                                        <input type="file" class="form-control" name="cnic_back" id="cnic_back">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group pull-right">
                                        <input type="submit" class="btn btn-success" name="submit" value="Update Details">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection