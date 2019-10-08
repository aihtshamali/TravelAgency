@extends('layouts.master') 
@section('content')
    <div class="content-wrapper" style="margin-top:2%;">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Transaction Details</h1>
                    </div> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 >Customer</h3>
                    </div> 
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <tbody>
                                <tr>
                                    <td>Receipt No.</td> 
                                    <td>{{$payment->PaymentID}}</td>
                                </tr> 
                                <tr>
                                    <td>Customer</td> 
                                    <td>{{$payment->CustomerName}}</td>
                                </tr> 
                                <tr>
                                    <td>Lead No</td>
                                    @if($payment->LeadIDRef == NULL) 
                                    <td>N/A</td>
                                    @else
                                    <td>{{$payment->LeadIDRef}}</td>
                                    @endif
                                </tr> 
                                <tr>
                                    <td>SPO</td> 
                                    <td>{{$payment->Uname}} @ {{$payment->Branch}}</td>
                                </tr>
                                <tr>
                                    <td>Posted By</td> 
                                    <td>{{$payment->Uname}} on {{date('d-M-y',strtotime($payment->PostedOn))}} ({{date('H:i',strtotime($payment->PostedOn))}})</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Accounting</h3>
                    </div> 
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <tbody>
                                <tr>
                                    <td>Amount</td> 
                                    <td>{{$payment->Amount}}</td>
                                </tr> 
                                <tr>
                                    <td>Form of Payment</td> 
                                    <td>{{$payment->FOP}}</td>
                                </tr> 
                                <tr>
                                    <td>Payment Details</td> 
                                    <td>{{$payment->FOPText}}</td>
                                </tr> 
                                <tr>
                                    <td>Approval Status</td> 
                                    <td>Pending</td>
                                </tr>
                                <tr>
                                    <td>Action By</td> 
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Details</h3>
                    </div> 
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <tbody>
                                <tr>
                                    <td>Received From</td> 
                                    <td>{{$payment->RecFrom}}</td>
                                </tr> 
                                <tr>
                                    <td>Print Remarks</td> 
                                    <td>{{$payment->PrintRemark}}</td>
                                </tr> 
                                <tr>
                                    <td>Internal Remarks</td> 
                                    <td>{{$payment->AccountingText}}</td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="2"><a href="{{ route('changeSaleStatus',['sale' => $payment->PaymentID,'status'=>1]) }}">Approve</a>|<a href="{{ route('changeSaleStatus',['sale' => $payment->PaymentID,'status'=>0]) }}">Reject</a></td> 
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        
        
    </div>
             
@endsection