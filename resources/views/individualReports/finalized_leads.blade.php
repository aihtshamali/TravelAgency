@extends('layouts.master')
@section('styleTags')
    <style>
       .badge{
            color:white;
            font-weight: bold;
        }
         td > span.badge{
            padding:0.5rem 0.4rem;
            min-width:80px;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('inc/flashMessages')
        {{-- Header Start --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Finalized Leads</h1>
                    </div> 
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li> 
                            <li class="breadcrumb-item active">Finalized Leads
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- Header End --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Last 20 Leads History</h3></div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <th>ID</th>
                                <th>Type</th>
                                <th>Detail</th>
                                <th>Customer No</th>
                                <th>Posted On</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @forelse ($leads as $lead)
                                    <tr>
                                        <td><a href="{{route('leads.show',$lead->LeadID)}}">{{$lead->LeadID}}</a> </td>
                                        <td><a href="{{route('Customer.show',$lead->CustomerIDRef)}}">{{$lead->CustomerIDRef}}</a> </td>
                                        <td>{{$lead->LeadType->name}}</td>
                                        <td>{{$lead->LeadSubject}}</td>
                                        <td>{{date('d-M-y (H:i)',strtotime($lead->CreatedOn))}}</td>
                                        <td>{{$lead->LeadStatus}}</td>
                                    </tr>                                
                                @empty
                                    <tr><td colspan="6" class="text-centered">There is no Lead Found</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection