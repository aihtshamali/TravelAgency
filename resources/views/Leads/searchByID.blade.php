@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        @include('inc/flashMessages')

        {{-- Header Start --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Search by Lead ID</h1>
                    </div> 
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li> 
                            <li class="breadcrumb-item active">Search-by-ID
                            </li>
                        </ol>
                    </div>
                </div>
               
            </div>
        </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        {{-- Header End --}}
        <form action="{{route('lead_searchByID')}}" method="GET">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Lead By ID</h3></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="search-id">Lead ID</label>
                                <input type="number" min="1" required name="LeadId" placeholder="Enter Lead ID ..." id="search-id" class="form-control">
                            </div>
                                <input type="submit" value="Search" class="btn btn-primary pull-right">
                        </div> 
                    </div>
                </div>
            </div>

        </form>
        @if(isset($lead))
            <section>
                <div class="row mr-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><h3 class="card-title font-weight-bold">Search Results</h3></div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <th>Lead ID</th>
                                        <th>Customer Name</th>
                                        <th>Type</th>
                                        <th>Subject</th>
                                        <th>Created On</th>
                                        <th>Taken Over By</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="{{route('leads.show',$lead->LeadID)}}">
                                                    {{$lead->LeadID}}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{route('Customer.show',$lead->Customer->CustomerID)}}">
                                                    {{$lead->Customer->CustomerName}}
                                                </a>
                                            </td>
                                            <td>
                                                {{$lead->LeadType}}
                                            </td>
                                            <td>
                                                {{$lead->LeadSubject}}
                                            </td>
                                            <td>
                                                {{$lead->CreatedOn}}
                                            </td>
                                            <td>
                                                {{$lead->TakenOverByUser}}
                                            </td>
                                            <td>
                                                {{$lead->LeadStatus}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection