@extends('layouts.master')
@section('content')
    <div class="content-wrapper">

        {{-- Header Start --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 pl-0" >
                        <h1 class="m-0 text-dark">Create Lead</h1>
                    </div> 
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li> 
                            <li class="breadcrumb-item">
                                <a href="{{route('leads.searchPhone')}}">Search Lead</a>
                            </li> 
                            <li class="breadcrumb-item">
                                <a href="{{route('Customer.show',$customer->CustomerID)}}">{{$customer->CustomerName}}</a>
                            </li> 
                            </li> 
                            <li class="breadcrumb-item active">New Lead
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- Header End --}}
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <i class="fa fa-user mr-3"></i><a href="{{route('Customer.show',$customer->CustomerID)}}">{{$customer->CustomerName}}</a>
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-phone mr-3"></i> {{$customer->PhoneNumber}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Add Details</h3></div>
                    <div class="card-body">
                        <div class="form-group">
                           <label for="lead_type">Lead Type</label>
                           <select name="lead_type" id="" class="form-control">
                               <option value="">Select Lead Type</option>
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="subject">Subject</label>
                           <input type="text" name="subject" class="form-control" placeholder="From ---- TO ---">
                        </div>
                        <div class="form-group">
                           <label for="service_date">Service Date</label>
                           <input type="date" name="service_date" placeholder="Service Date" class="form-control">
                        </div>
                        <div class="form-group">
                           <label for="details">Details (Max 1000 Characters)</label>
                           <textarea name="details" class="form-control" id="" cols="30" rows="10">
ADT:
CHD:
INF:
RETURN DATE:
AIRLINE:
CLASS:
                           </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection