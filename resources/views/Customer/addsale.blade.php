@extends('layouts.master') 
@section('content')
@php
 $show ='display:none';   //USING FOR UPDATION
@endphp


<div class="container">
    <div class="content-wrapper" style="margin-top:2%;">
        @include('inc/flashMessages')
        <form role="form" action="{{route('saveSale')}}" method="POST">
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
                        <label for="CreatedBy">Sale By</label>
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
                        <h3>Basic Details</h3>
                        <div class="form-group">
                            <label for="Amount">Charge To Customer</label>
                            <input type="number" onblur="ValidateAmount()" required id="amount" name="amount" class="form-control" autocomplete="off" >
                        </div>
                        <div class="form-group">
                            <label for="NetCost">Net Cost</label>
                            <input type="number" onblur="ValidateAmount()" required name="cost" id="cost" class="form-control" autocomplete="off" >
                        </div>
                        <div class="form-group">
                            <label for="NetCost">Profit Amount</label>
                            <input type="number" readonly="readonly" value="0" id="profit" name="profit" required name="ProfitAmount" class="form-control" autocomplete="off" >
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
                           <label for="IssueDate">Issue Date</label>
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