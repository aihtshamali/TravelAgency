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
                        <h1 class="m-0 text-dark">My Transactions</h1>
                    </div> 
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li> 
                            <li class="breadcrumb-item active">My Transactions
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
                    <div class="card-header"><h3 class="card-title">Pending Approval</h3></div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <th>ID</th>
                                <th>Type</th>
                                <th>Detail</th>
                                <th>Customer No</th>
                                <th>Posted On</th>
                            </thead>
                            <tbody>
                                @forelse ($pendingSales as $sale)
                                    <tr>
                                        <td><a href="{{route('approveSale',$sale->SaleID)}}">{{$sale->SaleID}}</a> </td>
                                        <td>{{$sale->LeadType->name}}</td>
                                        <td>{{$sale->ProductDetail}}</td>
                                        <td><a href="{{route('Customer.show',$sale->CustomerIDRef)}}">{{$sale->CustomerIDRef}}</a> </td>
                                        <td>{{date('d-M-y (H:i)',strtotime($sale->PostedOn))}}</td>
                                    </tr>                                
                                @empty
                                    <tr><td colspan="5" class="text-centered">There is no Sale pending for Approval</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>

        {{-- Last 10 Transactions0 --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Last 10 Transactions - Sale & Refunds</h3></div>
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
                                @forelse ($saleAndRefunds as $sale)
                                    <tr>
                                        <td><a href="{{route('approveSale',$sale->SaleID)}}">{{$sale->SaleID}}</a> </td>
                                        <td>{{isset($sale->Leadtype->name) ? $sale->Leadtype->name : '-'}}</td>
                                        <td>{{$sale->ProductDetail}}</td>
                                        <td><a href="{{route('Customer.show',$sale->CustomerIDRef)}}">{{$sale->CustomerIDRef}}</a> </td>
                                        <td>{{date('d-M-y (H:i)',strtotime($sale->PostedOn))}}</td>
                                        <td>
                                         <span class="text-uppercase badge badge-{{$sale->SaleStatus == 'Approved' ? 'success' : 'danger' }}">{{$sale->SaleStatus}}</span>
                                        </td>
                                    </tr>                                
                                @empty
                                    <tr><td colspan="6" class="text-centered">There is no Sale</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>

        {{-- Last 10 Payments --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Last 10 Transactions - Payments</h3></div>
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
                                @forelse ($payments as $payment)
                                    <tr>
                                        <td><a href="{{route('approveSale',$payment->PaymentID)}}">{{$payment->PaymentID}}</a> </td>
                                        <td>Don't know</td>
                                        <td>{{$sale->FOP}}</td>
                                        <td><a href="{{route('Customer.show',$payment->CustomerIDRef)}}">{{$payment->CustomerIDRef}}</a> </td>
                                        <td>{{date('d-M-y (H:i)',strtotime($payment->PostedOn))}}</td>
                                        <td>
                                         <span class="text-uppercase badge badge-{{$payment->StatusCode == 'Approved' ? 'success' : 'danger' }}">{{$payment->StatusCode}}</span>
                                        </td>
                                    </tr>                                
                                @empty
                                    <tr><td colspan="6" class="text-centered">There is no Payment</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection