@extends('layouts.master')
@section('styleTags')
    <style>
        .header-btn{
            font-size: 25px;
        }
        table{
            width:100%;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">

        {{-- Header Start --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{$customer->CustomerName}}</h1>
                    </div> 
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li> 
                            <li class="breadcrumb-item">
                                <a href="{{route('leads.searchPhone')}}">Search Lead</a>
                            </li> 
                            </li> 
                            <li class="breadcrumb-item active">{{$customer->CustomerName}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- Header End --}}
        {{-- Button Section --}}
        <div class="row">
            <div class="col-md-12">
                <span><button class="btn btn-primary header-btn"> Create New Lead</button></span>
                <span><button class="btn btn-primary header-btn">Add Sale</button></span>
                <span><button class="btn btn-primary header-btn">Add Refund</button></span>
                <span><button class="btn btn-success header-btn"> New Payment</button></span>  
                <span><button class="btn btn-info header-btn"> Print Statement</button></span>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Customer Details</h3></div>
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <tbody>
                                <tr>
                                    <td><i class="fa fa-user mr-2"></i>{{$customer->CustomerName}}</td>
                                    <td><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-phone mr-2"></i>{{$customer->PhoneNumber}}</td>
                                    <td><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-envelope mr-2"></i>{{$customer->EmailAddress}}</td>
                                    <td><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td class="text-capitalize"> <i class="fa fa-industry mr-2"></i>{{ $customer->Customertype ? $customer->Customertype->name == 'Individual' ? $customer->gender : $customer->Customertype->name : $customer->gender }}</td>
                                    <td><a href="#">Edit</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Transactions</h3></div>
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
            {{-- End --}}
        </div>
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