@extends('layouts.master')
@section('styleTags')
    <link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"/>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('inc/flashMessages')

        {{-- Header Start --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Lead Report</h1>
                    </div> 
                    
                </div>
            </div>
        </div>
        {{-- Header End --}}
        <div class="row mr-2">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header"><h3 class="card-title font-weight-bold">Leads Created </h3></div>
            <div class="card-body">
            <table class="table table-hover">
                    
                    <thead class="thead-dark">
                        <th>Lead ID</th>
                        <th>Customer</th>
                        <th>Type</th>
                        <th>Subject</th>
                        <th>Service Date</th>
                        <th>Created On</th>
                        <th>Created By</th>
                    </thead>
                    <tbody>
                        @forelse ($created as $lead)
                            <tr>
                                <td> <a href="{{route('leads.show',$lead->LeadID)}}">{{$lead->LeadID}}</a></td>
                                <td>{{$lead->Customer->CustomerName}}</td>
                                <td>
                                    {{$lead->LeadType->name}}
                                </td>
                                <td>{{$lead->LeadSubject}}</td>
                                <td>{{date(('d-M-y'),strtotime($lead->ServiceDate))}}</td>
                                <td>{{date(('d-M-y'),strtotime($lead->CreatedOn))}}</td>
                                <td>@if(isset($lead->User->user_name)){{$lead->User->user_name}}@endif</td>
                                
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
    
    <div class="row mr-2">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header"><h3 class="card-title font-weight-bold">Completed Leads</h3></div>
            <div class="card-body">
            <table class="table table-hover">
                    
                    <thead class="thead-dark">
                        <th>Lead ID</th>
                        <th>Customer</th>
                        <th>Type</th>
                        <th>Subject</th>
                        <th>Service Date</th>
                        <th>Closed On</th>
                        <th>SPO</th>
                    </thead>
                    <tbody>
                        @forelse ($completed as $lead)
                            <tr>
                                <td> <a href="{{route('leads.show',$lead->LeadID)}}">{{$lead->LeadID}}</a></td>
                                <td>{{$lead->Customer->CustomerName}}</td>
                                <td>
                                    {{$lead->LeadType->name}}
                                </td>
                                <td>{{$lead->LeadSubject}}</td>
                                <td>{{date(('d-M-y'),strtotime($lead->ServiceDate))}}</td>
                                <td>{{date(('d-M-y'),strtotime($lead->ClosedOn))}}</td>
                                <td>@if(isset($lead->ClosedBy->user_name)){{$lead->ClosedBy->user_name}}@endif</td>
                                
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




    <div class="row mr-2">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header"><h3 class="card-title font-weight-bold">Closed Leads</h3></div>
            <div class="card-body">
            <table class="table table-hover">
                    
                    <thead class="thead-dark">
                        <th>Lead ID</th>
                        <th>Customer</th>
                        <th>Type</th>
                        <th>Subject</th>
                        <th>Service Date</th>
                        <th>Closed On</th>
                        <th>SPO</th>
                    </thead>
                    <tbody>
                        @forelse ($closed as $lead)
                            <tr>
                                <td> <a href="{{route('leads.show',$lead->LeadID)}}">{{$lead->LeadID}}</a></td>
                                <td>{{$lead->Customer->CustomerName}}</td>
                                <td>
                                    {{$lead->LeadType->name}}
                                </td>
                                <td>{{$lead->LeadSubject}}</td>
                                <td>{{date(('d-M-y'),strtotime($lead->ServiceDate))}}</td>
                                <td>{{date(('d-M-y'),strtotime($lead->ClosedOn))}}</td>
                                <td>@if(isset($lead->ClosedBy->user_name)){{$lead->ClosedBy->user_name}}@endif</td>
                                
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