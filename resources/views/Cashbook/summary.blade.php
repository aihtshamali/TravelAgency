@extends('layouts.cashbookLayout')
@section('styleTags')   
<link rel="stylesheet" href="{{asset('css/cashbookCustom.css')}}">
@endsection 
@section('content')
    <div class="content-wrapper">
        @include('inc/flashMessages')
        {{-- Header Start --}}
         <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><b>Cash Book Details</b></h1>
                    </div> 
                </div>
            </div>
        </div>
        {{-- Header End --}} 
   
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                            <a href="{{route('activeUser')}}" class="activeshadow"> 
                        <div class="card-body date">
                        <div><img alt="" src="{{asset('images/cal.png')}}"></div> 
                        <span>
                        <strong>{{Date('l, F jS, Y',strtotime($date))}}</strong><br> Date
                        </span>
                        </div>
                    </a>
                    </div>
                </div>
                 <div class="col-md-6">
                     <div class="card">
                            <a href="{{route('blockUser')}}" class="activeshadow"> 
                         <div class="card-body branch">
                        <div><img alt="" src="{{asset('images/org.png')}}"></div> 
                        <span>
                        <strong>{{$branch}}</strong><br> Branch
                        </span>
                        </div>
                    </a>
                    </div>
                </div>
            </div>
            
            {{-- Pending Payments --}}
            @if($pending_payments->count())
            <div class="card">
             <div class="card-header">
             <h3><strong>Pending Payments</strong></h3>
             </div>
             <div class="card-body">
                <table class="table table-bordered">
                 <thead>
                  <tr>
                    <th></th>
                    <th>Time</th>
                    <th>FOP Details</th>
                    <th>Amount</th>
                    <th>Status Code</th>
                    <th>Action Taken By</th>
                    <th></th>
                  </tr>
                 </thead>
                 <tbody>
                 @foreach ($pending_payments as $pending_payment)
                     <tr>
                     <td>
                     <form action="{{ route('changePaymentStatus',['sale' => $pending_payment->PaymentID,'status'=>1]) }}" method="GET">
                        @csrf
                            <input type="hidden" name="out_amount" value="0">
                            <input type="hidden" name="in_amount" value="{{$pending_payment->Amount}}">
                            <input type="hidden" name="in_detail" value="{{$pending_payment->FOPText}}">
                            
                            <input type="hidden" name="PageRef" value="{{$pageRef}}">
                            <input type="hidden" name="UserRef" value="{{Auth::User()->name}}">
                            <input type="hidden" name="UserRefId" value="{{Auth::id()}}">
                            <input type="hidden" name="autopost" value="1">
                            <button  class="btn btn-success btn-sm "><i class="fa fa-check"></i></button>
                     </form>
                     </td>
                     <td>{{Date('F jS, Y',strtotime($pending_payment->PostedOn))}} | {{Date('h:i:s',strtotime($pending_payment->PostedOn))}} </td>
                         <td>
                            @if($pending_payment->payment_form_id == $pending_payment->PaymentForm->id)
                               @if($pending_payment->PaymentForm->name=="BANK TRANSFER")
                                    <b>{{$pending_payment->PaymentForm->name}}: </b>{{$pending_payment->Bank->bank_name}}
                                @else
                                    <b>{{$pending_payment->PaymentForm->name}}</b> 
                                @endif
                            @endif
                            <br>
                            {{$pending_payment->FOPText}}
                        </td>
                        <td>                           
                            PKR-{{$pending_payment->Amount}}
                        </td>
                         <td>
                           @if($pending_payment->StatusCode=="Pending")
                           <span class="bg-warning "> {{$pending_payment->StatusCode}} </span>
                            @endif
                        </td>
                     <td>
                     <b>Sale By: </b>{{$pending_payment->SaleByUser->user_name}}
                     <br>
                     <b>Posted By: </b>{{$pending_payment->AuthByUser->user_name}}
                     </td>
                     <td>
                     
                        <a href="{{ route('changePaymentStatus',['sale' => $pending_payment->PaymentID,'status'=>0]) }}" class="btn btn-danger btn-sm muted"><i class="fa fa-times"></i>Reject</a>
                     
                     </td>
                 </tr>
                 @endforeach
                 </tbody>
                </table>
              
             </div>
            </div>
            @endif
            
            {{-- Cash In --}}
            <div class="card">
             <div class="card-header">
             <h3><strong>Cash In</strong></h3>
             </div>
             <div class="card-body">
                <table class="table table-bordered">
                 <thead>
                  <tr>
                    <th>Time</th>
                    <th>Details</th>
                    <th>FOP</th>
                    <th>Posted By</th>
                    <th>Amount</th>
                  </tr>
                 </thead>
                 <tbody>
                 @php
                  $countIn=array();   
                 @endphp
                 @foreach ($AmountIn as $In )
                     <tr>
                    <td>{{Date('F jS, Y',strtotime($In->RecordTime))}} | {{Date('h:i:s',strtotime($In->RecordTime))}}</td>
                     <td>{{$In->Detail}}</td>
                     <td>{{$In->payment_form_id}}</td>
                     <td>{{$In->PostedBy}}</td>
                     <td>
                     PKR-{{$In->AmountIn}}
                       @php
                        array_push($countIn,$In->AmountIn);   
                        @endphp
                     </td>
                    
                 </tr>
                 @endforeach
                 </tbody>
                </table>
              
             </div>
            </div>
            
            {{-- Cash Out --}}
              <div class="card">
             <div class="card-header">
             <h3><strong>Cash Out</strong></h3>
             </div>
             <div class="card-body">
             @php
                  $countOut=array();   
                 @endphp
              <table class="table table-bordered">
                 <thead>
                  <tr>
                    <th>Time</th>
                    <th>Details</th>
                    <th>Posted By</th>
                    <th>Amount</th>
                  </tr>
                 </thead>
                 <tbody>
                 @foreach ($AmountOut as $Out )
                     <tr>
                    <td>{{Date('F jS, Y',strtotime($Out->RecordTime))}} | {{Date('h:i:s',strtotime($Out->RecordTime))}}</td>
                     <td>{{$Out->Detail}}</td>
                     <td>{{$Out->PostedBy}}</td>
                     <td>
                     PKR-{{$Out->AmountOut}}
                     @php
                        array_push($countOut,$Out->AmountOut);   
                        @endphp
                     </td>
                 </tr>
                 @endforeach
                 </tbody>
                </table>
             </div>
            </div>
            {{-- Summary --}}
              <div class="card">
             <div class="card-header">
             <h3><strong>Summary</strong></h3>
             </div>
             <div class="card-body">
              <table class="table table-bordered">
                 <thead>
                  <tr>
                    <th>Opening Balance</th>
                    <th>Cash In</th>
                    <th>Cash Out</th>
                    <th>Closing Balance</th>
                  </tr>
                 </thead>
                 <tbody>
                      <tr>
                      <td><b>PKR - {{number_format($index->OB, 2)}}</b></td>
                    <td> PKR - @php $cashin=array_sum($countIn); 
                    echo number_format($cashin,2) @endphp</td>
                    <td>
                    PKR - @php $cashout=array_sum($countOut); 
                    echo number_format($cashout,2) @endphp
                    </td>
                    <td><b>PKR - {{number_format($index->CB, 2)}}</b></td>
                 </tr>
                 </tbody>
                </table>
             </div>
            </div>
            
            {{-- In and Out for current day --}}
            @if($index->DayStatus == '1')
            <div class="row cashIn_out">
                <div class="col-md-6">
                <form action="{{route('cashIn')}}" method="post">
                @csrf
                   <div class="card">
                         <div class="card-header">
                         <h4><strong>In</strong></h4>
                        </div>
                        <div class="card-body ">
                         <div class="form-group">
                                    <label for="" class="label"> Type of Payment </label>
                                    <select name="payment"  class="form-control payment_form" id="payment_form" >
                                        @foreach($payment_forms as $pay)
                                         @if($pay->name == "CASH")
                                             <option value="{{$pay->id}}"  selected>{{$pay->name}}</option>
                                             @endif 
                                        @endforeach
                                    </select>
                                </div>
                                 
                            <div class="form-group">
                              <label for="" class="label"> Amount</label>
                                 <input type="text" name="in_amount" class="form-control">
                            </div>
                              <div class="form-group">
                           <label for="" class="label"> Details</label>
                         <input type="text" name="in_detail" class="form-control">
                        </div>
                    
                            <input type="hidden" name="out_amount" value="0">
                            <input type="hidden" name="PageRef" value="{{$pageRef}}">
                            <input type="hidden" name="UserRef" value="{{Auth::User()->name}}">
                            <input type="hidden" name="UserRefId" value="{{Auth::id()}}">
                            <input type="hidden" name="autopost" value="1">
                           
                          <div class="form-group">
                          <button class="btn btn-md btn-primary pull-right" type="submit">Cash In</button>
                          </div>
                        </div>
                       
                    </div>
                </form>
                </div>
                 <div class="col-md-6">
                    <form action="{{route('cashOut')}}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                            <h4><strong>Out</strong></h4>
                            </div>
                            <div class="card-body ">
                                <div class="form-group">
                                    <label for="" class="label"> Amount</label>
                                    <input type="text" name="out_amount" class="form-control">
                                </div>
                               <div class="form-group" >
                                      <label class="label">Details</label>
                                      <input type="text"  name="out_detail" class="form-control" >
                                </div>
                                 <div class="form-group">
                                    <label for="" class="label"> Type of Payment </label>
                                    <select name="payment" class="form-control payment_form" id="payment_form" >
                                    <option value="" selected disabled>Choose One</option>
                                        @foreach($payment_forms as $pay)
                                    <option value="{{$pay->id}}">{{$pay->name}}</option>
                                        @endforeach
                                    </select>
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
                                 
                                   <div class="form-group creditCardnum" style="display:none;">
                                    <label for="" class="label">Credit Card Number</label>
                                    <input type="text" class="form-control" name="creditcard">
                                </div>
                                
                                 <div class="form-group checqueNum" style="display:none;">
                                    <label for="" class="label">Checque Number</label>
                                    <input type="text" class="form-control" name="cheque">
                                </div>
                                
                                  <div class="form-group">
                                    <input type="hidden" name="in_amount" value="0">
                            <input type="hidden" name="PageRef" value="{{$pageRef}}">
                            <input type="hidden" name="UserRef" value="{{Auth::User()->name}}">
                            <input type="hidden" name="UserRefId" value="{{Auth::id()}}">
                            <input type="hidden" name="autopost" value="0">
                             <button class="btn btn-md btn-primary pull-right " type="submit"> Cash Out</button>
                                 </div>
                             </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Close Day Book --}}
            <form action="{{route('close_cashbook')}}" method="post">
            @csrf
            <div class="row margindiv cashbookclose">
                        <input type="hidden" name="PageRef" value="{{$pageRef}}">
                        <input type="hidden" name="UserRef" value="{{Auth::User()->name}}">
                        <input type="hidden" name="UserRefId" value="{{Auth::id()}}">
                    <button class="btn btn-lg btn-success pull-right col-md-2" type="submit">Close Day Book</button>
                </div>
            </form>
            @endif
           
            
            {{-- Print --}}
               <div class="row margindiv printbtn">
                <button class="btn btn-lg btn-success pull-right col-md-2 offset-md-10" onclick="window.print()" style="  background-color: rgb(31, 38, 45) !important; border:rgb(31, 38, 45) !important;" type="submit">Print Summary</button>
            </div>
            
    </div>
@endsection
@section('javascript')
    <script>
  $(".payment_form").change(function(){
    var data=$(this).children('option:selected').text();
    console.log(data);
      if(data == 'CHEQUE')
        {
         $('.bank_select').hide("fast")
          $('.creditCardnum').hide("fast")
     $('.checqueNum').show("fast")
        
        }
       else if(data == 'CREDIT CARD')
        {
            $('.checqueNum').hide("fast")
            $('.bank_select').hide("fast")
          $('.creditCardnum').show("fast")
        }
        if(data == 'BANK TRANSFER')
        {
            $('.checqueNum').hide("fast")
           $('.creditCardnum').hide("fast")
        $('.bank_select').show("fast")
        }
        if(data == 'CASH')
        {
            $('.checqueNum').hide("fast")
           $('.creditCardnum').hide("fast")
        $('.bank_select').hide("fast")
        }
        
   });

    </script>
    @endsection