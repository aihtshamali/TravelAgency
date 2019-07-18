@extends('layouts.master') 
@section('content')
<div class="container">
    <div class="content-wrapper" style="margin-top:2%;">
        <div class="">
            @if($customer)
                <h1 class="title">Edit Customer</h1>
            @else
                <h1 class="title">Add Customer</h1>
            @endif
        </div>
        <div class="card card-primary">
            <form role="form" action="{{route('Customer.store')}}" method="POST">
                @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="phone_no">Phone Number</label>
                    <input type="text" value="<?php if($customer) { echo $customer->PhoneNumber;} ?>" id="phone_no" name="phone_no" class="form-control" autocomplete="off" placeholder="03xxxxxxxxx">
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" value="<?php if($customer) { echo $customer->CustomerName;} ?>" class="form-control" name="name" id="name" placeholder="Full Name ...">
                </div>
                <div class="form-group">
                    <label for="customer_type">Customer Type</label>
                    <div class="input-group">
                        <select class="form-control" name="customer_type">
                            <option value="">Select Customer Type</option>
                            @forelse ($customer_types as $customer_type)
                                <option value="{{$customer_type->id}}">{{$customer_type->name}}</option>   
                            @empty
                                <option value="">None</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-group gender" style="display:none">
                    <label for="gender">Gender</label>
                    <div class="input-group">
                        <select name="gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group " >
                    <label for="remarks">Email Optional</label>
                    <div class="input-group">
                        <input value="<?php if($customer) { echo $customer->EmailAddress;} ?>" type="text" class="form-control" placeholder="Optional Email..." name="customer_email" >
                    </div>
                </div>
                <div class="form-group " >
                    <label for="remarks">Remarks Optional</label>
                    <div class="input-group">
                        <input value="<?php if($customer) { echo $customer->Remarks;} ?>" type="text" class="form-control" placeholder="Optional Remarks..." name="remarks" >
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
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