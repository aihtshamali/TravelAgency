@extends('layouts.master')
@section('styleTags')   
    <link rel="stylesheet" href="{{asset('css/crmCustom.css')}}">
    <style>
  
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
                        <h1 class="m-0 text-dark"><b>Month Summary</b></h1>
                    </div> 
                    
                </div>
            </div>
        </div>
        {{-- Header End --}}  
    <div class="row mr-2">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header"><h3 class="card-title font-weight-bold">Pending Balances</h3></div>
            <div class="card-body">
                <table class="table table-bordered"  data-page-length='500' id="pendingbalance">
                    <caption>List of Pending Balances</caption>
                    <thead class="thead-dark">
                        
                        <th>Customer</th>
                        <th>Account No</th>
                        <th>Last Transaction</th>
                        <th>Balance</th>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr>
                                <td> <a href="{{route('Customer.show',$payment->CustomerID)}}">{{$payment->CustomerName}}</a></td>
                                <td>{{$payment->CustomerID}}</td>
                                <td>{{date('d-M-y',strtotime($payment->ActionDate))}} ({{date('H:i: A',strtotime($payment->ActionDate))}})</td>
                                <td>
                                 {{number_format($payment->SaleAmount-$payment->PaymentsAmount+$payment->RefundAmount, 0)}} /-<span class="greenpkr">PKR</span> 
                                    {{-- {{$payment->SaleAmount-$payment->PaymentsAmount+$payment->RefundAmount}} --}}
                                </td>
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