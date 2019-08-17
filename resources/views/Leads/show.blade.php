@extends('layouts.master')
@section('styleTags')
    <link rel="stylesheet" href="{{asset('dist/plugins/datepicker/datepicker3.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">

        {{-- Header Start --}}
        <div class="content-header">
            <div class="container-fluid pl-0">
                <div class="row mb-2">
                    <div class="col-sm-6 pl-0">
                        <h1 class="m-0 text-dark">Lead ID: {{$lead->LeadID}}</h1>
                    </div> 
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li> 
                            <li class="breadcrumb-item">
                                <a href="{{route('lead_searchByID')}}">Search Lead</a>
                            </li> 
                            </li> 
                            <li class="breadcrumb-item active">{{$lead->LeadID}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- Header End --}}
        {{-- Button Section --}}
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Details</h3></div>
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <thead class="thead-dark">
                                <th>Type</th>
                                <th>Details</th>
                                <th>Service Date</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$lead->LeadType->name}}</td>
                                    <td>{{$lead->LeadSubject}}</td>
                                    <td> 
                                        <div class="form-group">
                                            <div class='input-group date' id='datetimepicker1'>
                                                <input type='text' class="form-control" name="date" value="{{$lead->ServiceDate}}" />
                                                <span class="input-group-addon">
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
         </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Customers</h3></div>
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <tbody>
                                <tr>
                                    <td><i class="fas fa-user mr-2"></i>Customer No</td>
                                    <td>{{$lead->Customer->CustomerID}}</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-notepad mr-2"></i>Name</td>
                                    <td>{{$lead->Customer->CustomerName}}</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-mobile mr-2"></i>Phone No.</td>
                                    <td>{{$lead->Customer->PhoneNumber}}</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-mail mr-2"></i>Email Address.</td>
                                    <td>{{$lead->Customer->EmailAddress ?? "NA" }}</td>
                                </tr>
                                <tr>
                                    <td> <i class="fa fa-book mr-2"></i>Balance</td>
                                    <td>PKR</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Customers</h3></div>
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <tbody>
                                <tr>
                                    <td><i class="fas fa-coins mr-2"></i>Sales</td>
                                    <td>PKR</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-minus-circle mr-2"></i>Refunds</td>
                                    <td>PKR</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-money mr-2"></i>Payments</td>
                                    <td>PKR</td>
                                </tr>
                                <tr>
                                    <td> <i class="fa fa-book mr-2"></i>Balance</td>
                                    <td>PKR</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- End --}}
        <div class="row mr-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3 class="card-title font-weight-bold">Leads</h3></div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <caption>List of Lead</caption>
                                <thead class="thead-dark">
                                    <th>Lead ID</th>
                                    <th>Type</th>
                                    <th>Subject</th>
                                    <th>Created On</th>
                                    <th>Taken Over By</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{asset('dist/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <script>
        $(document).ready(function(){
            //Date picker
            $.fn.datepicker.defaults.format = "dd/mm/yyyy";

            $('#datetimepicker1').datepicker({
                startDate: '0d',
                autoclose: true
            })

           
        });
    </script>
@endsection