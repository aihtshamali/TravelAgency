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
                    <h1>Basic Details</h1>
                    <div class="form-group">
                        <label for="customer">Customer</label>
                        <input type="text" value="<?php if(isset($customer)) { echo $customer->CustomerName;} ?>" required id="phone" name="PhoneNumber" class="form-control" autocomplete="off" placeholder="03xxxxxxxxx">
                    </div>
                    <div class="form-group">
                        <label for="LeadId">Lead Reference</label>
                        <div class="input-group">
                            <select name="LeadId" class="form-control">
                                <option value="">-</option>
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
            <div class="col-md-6">
                <div class="card card-primary">
                    <h1>Amounts</h1>
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
    </script>
@endsection