@extends('layouts.master') 
@section('content')
@php
 $show ='display:none';   //USING FOR UPDATION
@endphp


<div class="container">
    <div class="content-wrapper" style="margin-top:2%;">
        @include('inc/flashMessages')
        <form role="form" action="{{route('saveEditedPayment')}}" method="POST">
            @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="container">
                    <h3>Basic Details</h3>
                    <div class="form-group">
                        <label for="customer">Customer</label>
                        <input type="hidden" value="{{$customer->CustomerID}}" name="customer_id">
                        <input type="text" readonly="readonly" value="<?php if(isset($customer)) { echo $customer->CustomerName." (".$customer->CustomerID.")";} ?>" required  name="customer" class="form-control" autocomplete="off" >
                    </div>
                    <div class="form-group">
                        <label for="LeadId">Lead Reference</label>
                        <div class="input-group">
                            <select name="LeadId" class="form-control">
                                <option value="">-</option>
                                @foreach ($leads as $lead)
                                    <option  <?php if($payment->LeadIDRef == $lead->LeadID) echo "selected='selected'"; ?> value="{{$lead->LeadID}}">[Lead{{$lead->LeadID}}] </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="CreatedBy">Transaction User</label>
                        <div class="input-group">
                            
                            <select name="CreatedBy" class="form-control">
                                @foreach ($users as $user)
                                    <option <?php if($user->user_name == $payment->SaleBy) echo "selected='selected'"; ?> value="{{$user->id}}">{{$user->user_name}} [{{$user->name}}] </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    </div>   
                </div>
            </div>
            <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="container">
                        <h3>Amounts</h3>
                        <div class="form-group">
                            <label for="Amount">Amount</label>
                            <input type="number" required id="amount" name="amount" value="{{$payment->Amount}}" class="form-control" autocomplete="off" >
                        </div>
                        <div class="form-group">
                        <label id="paymentLabel" for="paymentForm">Form of Payment</label>
                            <div class="input-group">
                                <select name="payment_form" id="paymentForm" class="form-control">
                                    <option value="">-</option>
                                    @foreach ($paymentForms as $paymentForm)
                                        <option <?php if($paymentForm->name == $payment->FOP) echo "selected='selected'"; ?> value="{{$paymentForm->id}}">{{$paymentForm->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                            <div class="form-group bank_select" style="display:none;">
                                    <label for="" class="label"> Bank</label>
                                    <select name="bank" class="form-control" id="">
                                    <option value="" selected disabled>Choose One</option>
                                        @foreach($banks as $bank)
                                    <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                        <div class="form-group">
                            <label for="FopText" id="FopLabel">Payment Details</label>
                            <input type="text" readonly="readonly" id="Foptext" value="{{$payment->FOPText}}}" name="payment_detail" class="form-control" >
                        </div>
                        
                        </div>   
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="container">
                    <h3>Details</h3>
                       {{-- {{dd($payment)}} --}}
                       <div class="form-group">
                           <label for="IssueDate">Received From</label>
                           <input required type="text" name="receivedFrom" class="form-control" value="{{$payment->RecFrom}}" >
                       </div>
                       <div class="form-group">
                           <label for="ProductNum">Print Remarks</label>
                       <input required type="text" name="printRemarks" class="form-control" value="{{$payment->PrintRemark}}" autocomplete="off" >
                       </div>
                       <div class="form-group">
                           <label for="ProductPax">Confidential Remarks</label>
                           <input type="text" name="confidentialRemarks" class="form-control" value="{{$payment->AccountingText}}" autocomplete="off" placeholder="This will NOT print">
                       </div>
                       <div class="form-group">
                           <label for="ProductPax">Payment Status</label>
                           @if($payment->StatusCode=="Approved")
                           <input type="text"  readonly="readonly" name="paymentStatus" class="bg-success form-control" value="{{$payment->StatusCode}}" autocomplete="off" placeholder="This will NOT print">
                            @elseif($payment->StatusCode=="Pending")
                           <input type="text"  readonly="readonly" name="paymentStatus" class="bg-warning form-control" value="{{$payment->StatusCode}}" autocomplete="off" placeholder="This will NOT print">
                            @elseif($payment->StatusCode=="Rejected")
                           <input type="text"  readonly="readonly" name="paymentStatus" class="bg-danger form-control" value="{{$payment->StatusCode}}" autocomplete="off" placeholder="This will NOT print">
                             @else
                           <input type="text"  readonly="readonly" name="paymentStatus" class=" form-control" value="{{$payment->StatusCode}}" autocomplete="off" placeholder="This will NOT print">
                             @endif
                       </div>
                   
                    </div>   
                </div>
            </div>
            
        </div>
    <input type="hidden" name="paymemtid" value="{{$payment->PaymentID}}">
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
           
         
</div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function(){
            $('select[name="payment_form"]').on('change',function(){
                var type=$(this).children('option:selected').text()
                console.log(type);
                if(type == 'CASH ')
                {
                    $(".bank_select").hide("fast");
                
                    $('#FopLabel').text('Details Not Required');
                    $('#Foptext').attr("readonly",true);
                }
                if(type == 'CHEQUE ')
                {
                    $(".bank_select").hide("fast");
                
                    $('#FopLabel').text('Cheque Number & Bank Name');
                    $('#Foptext').attr("readonly",false);
                }
                if(type == 'CREDIT CARD ')
                {
                    $(".bank_select").hide("fast");
                
                    $('#FopLabel').text('Last 4 Digits of CC');
                    $('#Foptext').attr("readonly",false);
                }
                if(type == 'BANK TRANSFER ')
                {
                    $(".bank_select").show("fast");
                    $('#FopLabel').text('Transaction Info');
                    $('#Foptext').attr("readonly",false);
                }
                if(type == 'OTHER ')
                {
                    $(".bank_select").hide("fast");
                    $('#FopLabel').text('Payment Details');
                    $('#Foptext').attr("readonly",false);
                }
                // if(type == "Individual"){
                //     $(".gender").show();
                // }else{
                //     $(".gender").hide();
                // }
            });
            
        });
        
    </script>
@endsection