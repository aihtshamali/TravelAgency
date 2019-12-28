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
                        <h1 class="m-0 text-dark">All Working Leads</h1>
                    </div> 
                    
                </div>
            </div>
        </div>
        {{-- Header End --}}
        <div class="row mr-2">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header"><h3 class="card-title font-weight-bold">Working Leads - User</h3></div>
            <div class="card-body">
                <table class="table table-hover">
                    
                    <thead class="thead-dark">
                        <th>Branch</th>
                        <th>User</th>
                        <th>Working Leads</th>
                        
                    </thead>
                    <tbody>
                        <?php $leadCount=0; ?>
                        @forelse ($userLeads as $lead)
                            <?php $leadCount=$leadCount+$lead->lead_count; ?>
                            
                            <tr>
                                
                                <td>{{$lead->branch}}</td>
                                <td>{{$lead->name}}</td>
                                <td>
                                   <a href="{{route('userLeadsbyId',$lead->user_id)}}"> {{$lead->lead_count}}</a>
                                </td>
                                
                            </tr>
                        @empty

                            <tr>
                                <td colspan="6" class="text-centered">No Data Found</td>
                            </tr>
                        @endforelse
                            <tr>
                                <td style="text-align:center;" colspan="2">Total Working</td>
                                <td>{{$leadCount}}</td>
                            </tr>
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
        <div class="card-header"><h3 class="card-title font-weight-bold">Top 20 Old Leads</h3></div>
            <div class="card-body">
                <table class="table table-bordered">
                    
                    <thead class="thead-dark">
                        <th>Lead ID</th>
                        <th>Customer</th>
                        <th>Phone Number</th>
                        <th>Type</th>
                        <th>Subject</th>
                        <th>Taken Over By</th>
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
                              
                                <td>@if(isset($lead->TakenOverByUser->user_name)){{$lead->TakenOverByUser->user_name}}@endif</td>
                                <td> @php
                                    $datetime1 = new DateTime($lead->CreatedOn);
                                    $datetime2 = new DateTime();
                                    $interval = $datetime1->diff($datetime2);
                                     echo $interval->format("%m Month %d Day %h Hours ");
                                @endphp</td>
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