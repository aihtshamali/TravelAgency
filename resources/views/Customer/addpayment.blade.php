@extends('layouts.master') 
@section('content')
@php
 $show ='display:none';   //USING FOR UPDATION
@endphp


<div class="container">
    <div class="content-wrapper" style="margin-top:2%;">
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
                                <option value="NULL">-</option>
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
                            <input type="number" readonly="readonly" id="Foptext" name="profit" class="form-control" >
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
                           <label for="lead_type">Transaction Type</label>
                           {{-- {{dd(Auth::user()->id)}} --}}
                           <div class="input-group">
                               <select name="lead_type_id" id="lead_type" class="select2 form-control">
                                   <option value="">-</option>

                                   @foreach ($lead_types as $lead_type)
                                       <option value="{{$lead_type->id}}">{{$lead_type->name}}</option>
                                   @endforeach
                               </select>
                           </div>
                       </div>
                       <div class="form-group">
                           <label for="IssueDate">Transaction Date</label>
                           <input required type="date" name="IssueDate" class="form-control" autocomplete="off" >
                       </div>
                       <div class="form-group">
                           <label for="ProductNum">Ticket or Product No.</label>
                           <input required type="text" name="ProductNum" class="form-control" autocomplete="off" >
                       </div>
                       <div class="form-group">
                           <label for="ProductPax">Passenger Name</label>
                           <input type="text" name="ProductPax" class="form-control" autocomplete="off" >
                       </div>
                       <div class="form-group">
                        <label for="sector_id">Route or Details</label>
                        <div class="input-group">
                            <select name="sector_id" class="select2 form-control">
                                <option value="">-</option>
                                @foreach ($sectors as $sector)
                                    <option value="{{$sector->id}}">{{$sector->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="AccountigText">Accounting Remarks</label>
                        <input type="text" placeholder="Issued from (Self or Vendor Name)" name="AccountigText" class="form-control" autocomplete="off" >
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
                    alert('hey');
                    // $("#paymentLabel").empty();
                    document.getElementById('paymentLabel').innerHTML = 'your tip has been submitted!';
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