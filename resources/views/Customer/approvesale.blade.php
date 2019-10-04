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
                        <h3 >Info</h3>
                    </div> 
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <tbody>
                                <tr>
                                    <td>Posting ID</td> 
                                    <td>{{$sale->SaleID}}</td>
                                </tr> 
                                <tr>
                                    <td>Customer</td> 
                                    <td>{{$sale->CustomerName}}</td>
                                </tr> 
                                <tr>
                                    <td>Lead No</td>
                                    @if($sale->LeadIDRef == NULL) 
                                    <td>N/A</td>
                                    @else
                                    <td>{{$sale->LeadIDRef}}</td>
                                    @endif
                                </tr> 
                                <tr>
                                    <td>SPO</td> 
                                    <td>{{$sale->Uname}} @ {{$sale->Branch}}</td>
                                </tr>
                                <tr>
                                    <td>Posted By</td> 
                                    <td>{{$sale->Uname}} on {{date('d-M-y',strtotime($sale->created_at))}} ({{date('H:i',strtotime($sale->created_at))}})</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Product</h3>
                    </div> 
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <tbody>
                                <tr>
                                    <td>Transaction Type</td> 
                                    <td>{{$sale->Type}}</td>
                                </tr> 
                                <tr>
                                    <td>Transaction Date</td> 
                                    <td>{{date('d-M-y',strtotime($sale->IssueDate))}}</td>
                                </tr> 
                                <tr>
                                    <td>Document No</td> 
                                    <td>{{$sale->ProductNum}}</td>
                                </tr> 
                                <tr>
                                    <td>Passenger</td> 
                                    <td>{{$sale->ProductPax}}</td>
                                </tr>
                                <tr>
                                    <td>Details</td> 
                                    <td>{{$sale->Sector}}</td>
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
                    <div class="card-header">
                        <h3>Accounting</h3>
                    </div> 
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <tbody>
                                <tr>
                                    <td>Amount</td> 
                                    <td>{{$sale->Amount}}</td>
                                </tr> 
                                <tr>
                                    <td>Net Amount</td> 
                                    <td>{{$sale->NetCost}}</td>
                                </tr> 
                                <tr>
                                    <td>Profit</td> 
                                    <td>{{$sale->ProfitAmount}}</td>
                                </tr> 
                                <tr>
                                    <td>Details</td> 
                                    <td>{{$sale->AccountingText}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Status</h3>
                    </div> 
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <tbody>
                                <tr>
                                    <td>Approval Status</td> 
                                    <td>Pending</td>
                                </tr> 
                                <tr>
                                    <td>Action By</td> 
                                    <td>None</td>
                                </tr> 
                                <tr>
                                    <td>Action On</td> 
                                    <td>None</td>
                                </tr> 
                                <tr>
                                    <td align="center" colspan="2"><a href="#">Approve</a>|<a href="#">Reject</a></td> 
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
             
@endsection