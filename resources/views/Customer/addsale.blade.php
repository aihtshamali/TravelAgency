@extends('layouts.master') 
@section('content')
@php
 $show ='display:none';   //USING FOR UPDATION
@endphp


<div class="container">
    <div class="content-wrapper" style="margin-top:2%;">
       <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="container">
                    <h3>Basic Details</h3>
                    <div class="form-group">
                        <label for="customer">Customer</label>
                        <input type="text" readonly="readonly" value="<?php if(isset($customer)) { echo $customer->CustomerName." (".$customer->CustomerID.")";} ?>" required  name="customer" class="form-control" autocomplete="off" >
                    </div>
                    <div class="form-group">
                        <label for="LeadId">Lead Reference</label>
                        {{dd($leads[0]->Leadtype())}}
                        <div class="input-group">
                            <select name="LeadId" class="form-control">
                                <option value="">-</option>
                                @foreach ($leads as $lead)
                            <option value="{{$lead->LeadID}}">[Lead{{$lead->LeadID}}] {{$lead->Leadtype->name}}</option>
                                   @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="CreatedBy">Sale By</label>
                        <div class="input-group">
                            <select name="CreatedBy" class="form-control">
                                <option value="">-</option>
                            </select>
                        </div>
                    </div>
                    </div>   
                </div>
            </div>
            <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="container">
                        <h3>Basic Details</h3>
                        <div class="form-group">
                            <label for="Amount">Charge To Customer</label>
                            <input type="number" onblur="ValidateAmount()" required id="amount" name="Amount" class="form-control" autocomplete="off" >
                        </div>
                        <div class="form-group">
                            <label for="NetCost">Net Cost</label>
                            <input type="number" onblur="ValidateAmount()" required name="NetCost" id="cost" class="form-control" autocomplete="off" >
                        </div>
                        <div class="form-group">
                            <label for="NetCost">Profit Amount</label>
                            <input type="number" readonly="readonly" value="0" id="profit" required name="ProfitAmount" class="form-control" autocomplete="off" >
                        </div>
                        
                        </div>   
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="container">
                    <h3>Product Sold</h3>
                       <div class="form-group">
                           <label for="lead_type">Product Type</label>
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
                           <label for="IssueDate">Issue Date</label>
                           <input type="text" value="0" required name="IssueDate" class="form-control" autocomplete="off" >
                       </div>
                       <div class="form-group">
                           <label for="ProductNum">Ticket or Product No.</label>
                           <input type="text" value="0" required name="ProductNum" class="form-control" autocomplete="off" >
                       </div>
                       <div class="form-group">
                           <label for="ProductPax">Passenger Name</label>
                           <input type="text" value="0" required name="ProductPax" class="form-control" autocomplete="off" >
                       </div>
                       <div class="form-group">
                        <label for="lead_type">Route or Details</label>
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
                        <label for="AccountigText">Accounting Remarks</label>
                        <input type="text" value="0" placeholder="Issued from (Self or Vendor Name)" required name="AccountigText" class="form-control" autocomplete="off" >
                    </div>
                    </div>   
                </div>
            </div>
            
        </div>
    </div>
    
           
         
</div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function(){
            $('select[name="customer_type"]').on('change',function(){
                var type=$(this).children('option:selected').text()
                console.log(type);
                if(type == "Individual"){
                    $(".gender").show();
                }else{
                    $(".gender").hide();
                }
            });
            
        });
        function ValidateAmount()
        {
            var profit=$( "#amount" ).val()-$( "#cost" ).val();
            console.log(profit);
            $("#profit").val(profit);
            // alert("Hey");
        }
    </script>
@endsection