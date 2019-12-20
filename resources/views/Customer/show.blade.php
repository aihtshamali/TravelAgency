@extends('layouts.master')
@section('styleTags')
    <style>
        .header-btn{
            font-size: 25px;
            color:white !important;
        }
        table{
            width:100%;
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
            <div class="container-fluid pl-0">
                <div class="row mb-2">
                    <div class="col-sm-6 pl-0">
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
                <span><a href="{{route('leads.create',['account'=>$customer->CustomerID])}}" class="btn btn-primary header-btn"> Create New Lead</a></span>
                <span><a href="{{route('addSale',$customer->CustomerID)}}" class="btn btn-primary header-btn">Add Sale</a></span>
                <span><a href="{{route('addRefund',$customer->CustomerID)}}" class="btn btn-primary header-btn">Add Refund</a></span>
                <span><a href="{{route('addPayment',$customer->CustomerID)}}" class="btn btn-success header-btn"> New Payment</a></span>  
                <span><a href="#" class="btn btn-info header-btn"> Print Statement</a></span>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Customer Details<span class="pull-right"><a href="{{route('Customer.edit',$customer->CustomerID)}}">Edit Customer</a> </h3></span></div>
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <tbody>
                                <tr>
                                    <td><i class="fas fa-user mr-2"></i>Customer No</td>
                                    <td>{{$customer->CustomerID}}</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-info mr-2"></i>Name</td>
                                    <td>{{$customer->CustomerName}}</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-mobile mr-2"></i>Phone No.</td>
                                    <td>{{$customer->PhoneNumber}}</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-envelope mr-2"></i>Email Address.</td>
                                    <td>{{$customer->EmailAddress ?? "NA" }}</td>
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
                                    @foreach($leads as $lead)
                                    <tr>
                                        <td> <a href="{{route('leads.show',$lead->LeadID)}}">{{$lead->LeadID}}</a></td>
                                        <td>{{$lead->LeadType->name}}</td>
                                        <td>{{$lead->LeadSubject}}</td>
                                        <td>{{date('d M y  h:i:s a',strtotime($lead->CreatedOn))}}</td>
                                        <td>{{isset($lead->TakenOverByUser->name) ? $lead->TakenOverByUser->name : 'NA'}}</td>
                                        <td><span class="badge badge-{{$lead->LeadStatus == "Open" ? 'success' : ($lead->LeadStatus == 'Working' ? 'danger' : '')}}">{{$lead->LeadStatus}}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
                <div class="card">
                    <div class="card-header"><h3 class="card-title font-weight-bold">Sales</h3></div>
                        <div class="card-body">
                            <table class="table table-responsive-md table-responsive-lg table-responsive-xs table-hover">
                                <caption>List of Sales</caption>
                                <thead class="thead-dark">
                                    <th>ID</th>
                                    <th>Issue Date</th>
                                    <th>Type</th>
                                    <th>Passenger</th>
                                    <th>Document</th>
                                    <th>Details</th>
                                    <th>Branch</th>
                                    <th>SPO</th>
                                    <th>Amount</th>
                                    <th>Attachment</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach($sales as $sale)
                                    <tr>
                                        <td><a href="{{route('approveSale',$sale->SaleID)}}">{{$sale->SaleID}}</a></td>
                                        <td>{{date('d-M-Y',strtotime($sale->IssueDate))}}</td>
                                        <td>{{$sale->Leadtype->name}}</td>
                                        <td>{{$sale->ProductPax}}</td>
                                        <td>{{$sale->ProductNum}}</td>
                                        <td>{{$sale->ProductDetail}}</td>
                                        <td>{{isset($sale->UserBranch->Branch->name) ? $sale->UserBranch->Branch->name : '-'}}</td>
                                        <td><a href="{{route('User.show',$sale->posted_by_user)}}">{{$sale->PostedByUser->name}}</a></td>
                                        <td>{{$sale->Amount}}</td>
                                        <td><a href="{{$sale->ticket_attachment ? asset('storage/attachments/'.$sale->Customer->User->id.'/'.$sale->ticket_attachment) : '#'}}" {{ isset($sale->ticket_attachment) ? 'download' : 'disabled'}}>{{isset($sale->ticket_attachment) ? 'Download' : 'No Attachment'}}</a></td>
                                        <td><a href="#" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-pencil"></span> Pencil </a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
                <div class="card">
                    <div class="card-header"><h3 class="card-title font-weight-bold">Refunds</h3></div>
                        <div class="card-body">
                            <table class="table table-responsive-md table-responsive-lg table-responsive-xs table-hover">
                                <caption>List of Refunds</caption>
                                <thead class="thead-dark">
                                    <th>ID</th>
                                    <th>Issue Date</th>
                                    <th>Type</th>
                                    <th>Passenger</th>
                                    <th>Document</th>
                                    <th>Details</th>
                                    <th>Branch</th>
                                    <th>SPO</th>
                                    <th>Amount</th>
                                    <th>Attachment</th>
                                </thead>
                                <tbody>
                                    @foreach($refunds as $refund)
                                    <tr>
                                        <td><a href="{{route('approveRefund',$refund->SaleID)}}">{{$refund->SaleID}}</a></td>
                                        <td>{{date('d-M-Y',strtotime($refund->IssueDate))}}</td>
                                        <td>{{$refund->Leadtype->name}}</td>
                                        <td>{{$refund->ProductPax}}</td>
                                        <td>{{$refund->ProductNum}}</td>
                                        <td>{{$refund->ProductDetail}}</td>
                                        <td>{{isset($refund->UserBranch->Branch->name) ? $refund->UserBranch->Branch->name : '-'}}</td>
                                        <td><a href="{{route('User.show',$refund->posted_by_user)}}">{{$refund->PostedByUser->name}}</a></td>
                                        <td>{{$refund->Amount}}</td>
                                        <td><a href="{{$refund->ticket_attachment ? asset('storage/attachments/'.$refund->Customer->User->id.'/'.$refund->ticket_attachment) : '#'}}" {{ isset($refund->ticket_attachment) ? 'download' : 'disabled'}}>{{isset($refund->ticket_attachment) ? 'Download' : 'No Attachment'}}</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
                <div class="card">
                    <div class="card-header"><h3 class="card-title font-weight-bold">Payments</h3></div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <caption>List of Payments</caption>
                                <thead class="thead-dark">
                                    <th>Receipt No.</th>
                                    <th>FOP</th>
                                    <th>Date</th>
                                    <th>Remarks</th>
                                    <th>Branch</th>
                                    <th>SPO</th>
                                    <th>Amount</th>
                                </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                    <tr>
                                        <td><a href="{{route('approvePayment',$payment->PaymentID)}}"> {{$payment->PaymentID}} </a></td>
                                        <td>{{$payment->PaymentForm->name}}</td>
                                        <td>{{date('d-M-Y',strtotime($payment->PostedOn))}}</td>
                                        <td>{{$payment->PrintRemark}}</td>
                                        <td>{{isset($payment->UserBranch->Branch) ? $payment->UserBranch->Branch->name : ''}}</td>
                                        <td><a href="{{route('User.show',$payment->user_id)}}">{{isset($payment->SaleByUser->name) ? $payment->SaleByUser->name : '-'}}</a></td>
                                        <td>{{$payment->Amount}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection