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
                                    <td><a href="{{route('Customer.show',$payment->CustomerIDRef)}}">{{$payment->CustomerName}}</a></td>
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
                                    @if($payment->StatusCode=="Approved")
                                <td><span class="bg-success">{{$payment->StatusCode}}</span></td>
                                    @elseif($payment->StatusCode=="Pending")
                                <td><span class="bg-warning">{{$payment->StatusCode}}</span>
                                </td>
                                    @elseif($payment->StatusCode=="Rejected")
                                <td><span class="bg-danger">{{$payment->StatusCode}}</span></td>
                                      @elseif($payment->StatusCode=="Deleted")
                                <td><span class="bg-danger muted">{{$payment->StatusCode}}</span></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Action By</td> 
                                    @if(isset($payment->auth_by))
                                        <td>{{$payment->AuthByUser->name}} on {{date('j-M-y (H:i)',strtotime($payment->AuthOn))}}</td>
                                    @else
                                        <td></td>
                                    @endif
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
                                    @if($payment->StatusCode == 'Approved')
                                        <td align="center" colspan="2">
                                             <a href="{{ route('changePaymentStatus',['sale' => $payment->PaymentID,'status'=>2]) }}"><i class="fa fa-trash"></i>Delete Entry</a>
                                        </td>
                                    @elseif($payment->StatusCode == 'Pending')
                                        <td align="center" colspan="2">
                                             <a href="{{ route('changePaymentStatus',['sale' => $payment->PaymentID,'status'=>1]) }}"><i class="fa fa-check"></i>Approve</a>
                                        
                                            |<a href="{{ route('changePaymentStatus',['sale' => $payment->PaymentID,'status'=>0]) }}"><i class="fa fa-times"></i>Reject</a>
                                        </td> 
                                    @endif
                                    
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        
        
    </div>
             
@endsection