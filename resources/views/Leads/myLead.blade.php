@extends('layouts.master')
@section('styleTags')
    <link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"/>
@endsection
@section('content')
    <div class="content-wrapper">

        {{-- Header Start --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Leads</h1>
                    </div> 
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li> 
                            <li class="breadcrumb-item active">My Leads
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- Header End --}}  
    <div class="row mr-2">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header"><h3 class="card-title font-weight-bold">My Leads</h3></div>
            <div class="card-body">
                <table class="table table-hover">
                    <caption>List of Pending Leads</caption>
                    <thead class="thead-dark">
                        <th>Lead ID</th>
                        <th>Customer</th>
                        <th>Phone Number</th>
                        <th>Type</th>
                        <th>Subject</th>
                        <th>Service Date</th>
                        <th>Working Since</th>
                    </thead>
                    <tbody>
                        @forelse ($leads as $lead)
                            <tr>
                                <td> <a href="{{route('leads.show',$lead->LeadID)}}">{{$lead->LeadID}}</a></td>
                                <td>{{$lead->Customer->CustomerName}}</td>
                                <td>{{$lead->Customer->PhoneNumber}}</td>
                                <td>
                                    {{$lead->LeadType->name}}
                                </td>
                                <td>{{$lead->LeadSubject}}</td>
                                <td>{{$lead->ServiceDate}}</td>
                                <td>{{$lead->CreatedOn}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-centered">No Data Found</td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
    </div>
    </div>
@endsection