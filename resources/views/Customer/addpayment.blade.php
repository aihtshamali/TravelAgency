@extends('layouts.master') 
@section('content')
@php
 $show ='display:none';   //USING FOR UPDATION
@endphp


<div class="container">
    <div class="content-wrapper" style="margin-top:2%;">
        @include('inc/flashMessages')
        <form role="form" action="{{route('savePayment')}}" method="POST">
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
                                    <option value="{{$lead->LeadID}}">[Lead{{$lead->LeadID}}] </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="CreatedBy">Transaction User</label>
                        <div class="input-group">
                            
                            <select name="CreatedBy" class="form-control">
                                
                                @foreach ($users as $user)
                                    <option <?php if($user->id == Auth::user()->id) echo "selected='selected'"; ?> value="{{$user->id}}">{{$user->user_name}} [{{$user->name}}] </option>
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
                            <input type="number" required id="amount" name="amount" class="form-control" autocomplete="off" >
                        </div>
                        <div class="form-group">
                        <label id="paymentLabel" for="paymentForm">Form of Payment</label>
                            <div class="input-group">
                                
                                <select name="payment_form" id="paymentForm" class="form-control">
                                    <option value="">-</option>
                                    @foreach ($paymentForms as $paymentForm)
                                        <option value="{{$paymentForm->id}}">{{$paymentForm->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="FopText" id="FopLabel">Payment Details</label>
                            <input type="text" readonly="readonly" id="Foptext" name="payment_detail" class="form-control" >
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
                       
                       <div class="form-group">
                           <label for="IssueDate">Received From</label>
                           <input required type="text" name="receivedFrom" class="form-control" value="{{$customer->CustomerName}}" >
                       </div>
                       <div class="form-group">
                           <label for="ProductNum">Print Remarks</label>
                           <input required type="text" name="printRemarks" class="form-control" autocomplete="off" >
                       </div>
                       <div class="form-group">
                           <label for="ProductPax">Confidential Remarks</label>
                           <input type="text" name="confidentialRemarks" class="form-control" autocomplete="off" placeholder="This will NOT print">
                       </div>
                       
                   
                    </div>   
                </div>
            </div>
            
        </div>
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
                    $('#FopLabel').text('Details Not Required');
                    $('#Foptext').attr("readonly",true);
                }
                if(type == 'CHEQUE ')
                {
                    $('#FopLabel').text('Cheque Number & Bank Name');
                    $('#Foptext').attr("readonly",false);
                }
                if(type == 'CREDIT CARD ')
                {
                    $('#FopLabel').text('Last 4 Digits of CC');
                    $('#Foptext').attr("readonly",false);
                }
                if(type == 'BANK TRANSFER ')
                {
                    $('#FopLabel').text('Bank Name & Transaction Info');
                    $('#Foptext').attr("readonly",false);
                }
                if(type == 'OTHER ')
                {
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