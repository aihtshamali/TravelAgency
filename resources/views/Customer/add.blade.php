@extends('layouts.master') 
@section('content')
@php
 $show ='display:none';   //USING FOR UPDATION
@endphp


<div class="content-wrapper" style="margin-top:2%;">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card-header">
        @if(isset($customer))
            <h1 class="title">Edit Customer</h1>
        @else
            <h1 class="title">Add Customer</h1>
        @endif
    </div>
    <div class="card card-primary">
        @if(isset($customer))
            <form role="form" action="{{route('Customer.update',$customer->CustomerID)}}" method="POST">
                    @method('PUT')
        @else
            <form role="form" action="{{route('Customer.store')}}" method="POST">
        @endif
        
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" value="<?php if(isset($customer)) { echo $customer->PhoneNumber;}else if($phoneNumber) {echo $phoneNumber;} ?>" required id="phone" name="PhoneNumber" class="form-control" autocomplete="off" placeholder="03xxxxxxxxx">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" value="<?php if(isset($customer)) { echo $customer->CustomerName;} ?>" required class="form-control" name="name" id="name" placeholder="Full Name ...">
            </div>
            <div class="form-group">
                <label for="customer_type">Customer Type</label>
                <div class="input-group">
                    <select class="form-control" name="customer_type" required>
                        <option value="">Select Customer Type</option>
                        @forelse ($customer_types as $customer_type)
                        @if(isset($customer) && isset($customer->customer_type_id))    
                            <option <?php if($customer_type->id  == $customer->customer_type_id) { echo "selected='selected'";} ?> value="{{$customer_type->id}}">{{$customer_type->name}}</option>
                        @else
                        <option value="{{$customer_type->id}}">{{$customer_type->name}}</option>
                        @endif   
                        @empty
                            <option value="">None</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="form-group gender" style="{{isset($customer) && $customer->gender ? '' : $show}}">
                <label for="gender">Gender</label>
                <div class="input-group">
                    <select name="gender" class="form-control">
                        <option value="">Select Gender</option>
                        <option <?php if( isset($customer) && $customer->gender == 'male') { echo "selected='selected'";} ?> value="male">Male</option>
                        <option <?php if( isset($customer) && $customer->gender == 'female') { echo "selected='selected'";} ?> value="female">Female</option>
                    </select>
                </div>
            </div>
            <div class="form-group " >
                <label for="remarks">Email Optional</label>
                <div class="input-group">
                    <input value="<?php if(isset($customer)) { echo $customer->EmailAddress;} ?>" type="email" class="form-control" placeholder="Optional Email..." name="EmailAddress" >
                </div>
            </div>
            <div class="form-group " >
                <label for="remarks">Remarks Optional</label>
                <div class="input-group">
                    <input value="<?php if(isset($customer)) { echo $customer->Remarks;} ?>" type="text" class="form-control" placeholder="Optional Remarks..." name="remarks" >
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success pull-right">Submit</button>
        </div>
        </form>
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