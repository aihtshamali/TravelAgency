@extends('layouts.cashbookLayout')
@section('styleTags')   
<link rel="stylesheet" href="{{asset('css/cashbookCustom.css')}}">
@endsection 
@section('content')
    <div class="content-wrapper">
        @include('inc/flashMessages')
     
         <form action="{{route('bankBasedreport')}}" method="post">
            @csrf
            <div class="card">
                <div class="card-header">
                 <h3 class="m-0 text-dark"><b>Bank Based Report</b></h3>
                 </div>
            <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                <label for="" class="label"><b>From Date</b></label>
                <input type="date" class="form-control" name="fromDate"/>
                </div>
                 <div class="col-md-6">
                <label for="" class="label"><b>To Date</b></label>
                <input type="date" class="form-control" name="ToDate" />
                </div>
            </div>
                <div class="row mt-auto">
                    <div class="col-md-6 ">
                    <label for="" class="label"><b>Select Payment Type</b></label>
                        <select name="paymentType" class="form-control fop">
                            <option selected Disabled>Choose One</option>
                            @foreach($payment_forms as $payment_form)
                            <option value="{{$payment_form->id}}">{{$payment_form->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 bank_select" style="display:none">
                    <div class="form-group ">
                        <label for="" class="label"> Choose Bank</label>
                        <select name="bank" class="form-control bank" id="" >
                        <option value="" selected disabled>Choose One</option>
                            @foreach($banks as $bank)
                        <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 checqueNum" style="display:none">
                    <div class="form-group ">
                        <label for="" class="label">Enter Checque Number</label>
                            <input type="text" class="form-control cheque"  name="cheque">
                    </div>
                </div>
                    <div class="col-md-6 creditCardnum" style="display:none">
                    <div class="form-group ">
                        <label for="" class="label">Enter Credit Card Number</label>
                        <input type="text" class="form-control creditcard"  name="creditcard">
                    </div>
                </div>
                </div>
            </div>
           
              <div class="row reportGenerate" >
                <div class="col-md-3 offset-md-4">
                <div class="form-group ">
                    <button class="btn btn-md btn-success form-control" type="submit">Genrate Report</button>
                </div>
                </div>
              </div>
            </div>
        </form>
        @if(isset($reports))
        @if($reports->count() > 0)
        <div class="card">
            <div class="card-header">
            <h3 class="m-0 text-dark"><b>Report of "{{$type}}"</b></h3>
            </div>
            <div class="card-body">
                <div class="row">
                        <table class="table table-bordered compact col-md-12">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Sr.</th>
                                    <th>Payment Form</th>
                                    <th>Record Time</th>
                                    <th>Detail</th>
                                    <th>Amount Out</th>
                                    <th>PostedBy</th>
                                    
                                </tr>
                            </thead>
                            @php
                             $count=1;   
                            @endphp
                            <tbody>
                                @foreach($reports as $report)
                                <tr>
                                <td>
                                 @php
                             echo $count++;   
                            @endphp
                                </td>
                                <td>
                                {{$type}}
                                @if($report->chequeOrcard != null)
                                <hr>
                                {{$report->chequeOrcard}}
                                @endif
                                </td>
                                <td>{{Date('F jS, Y',strtotime($report->RecordTime))}}</td>
                                <td>{{$report->Detail}}</td>
                                <td>{{$report->AmountOut}}</td>
                                <td>{{$report->PostedBy}}</td>
                               
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
        @else
         <div class="card">
             <div class="card-body">
                <div class="row">
                    <div clas="col-md-12">
                    <h5>No Result Found Related to <b>"{{$type}}"</b> @if(isset($dates)) & <b>{{$dates}}</b> @endif</h5>
                    </div>
                </div>
            </div>
         </div>
        @endif
        @endif
        
    </div>
@endsection
@section('javascript')
    <script>
  
  $(".fop").change(function(){
    var data=$(this).children('option:selected').text();
    console.log(data);
      if(data == 'CHEQUE')
        {
          $('.bank_select').hide("fast")
          $('.creditCardnum').hide("fast")
          $('.creditcard').prop('required',false);
          $('.bank').prop('required',false);
          
          $('.checqueNum').show("fast")
          $('.cheque').prop('required',true);
        
        }
       else if(data == 'CREDIT CARD')
        {
            $('.bank_select').hide("fast")
            $('.checqueNum').hide("fast")
             $('.cheque').prop('required',false);
          $('.bank').prop('required',false);
            
            $('.creditCardnum').show("fast")
            $('.creditcard').prop('required',true);
        }
        if(data == 'BANK TRANSFER')
        {
            $('.creditCardnum').hide("fast")
            $('.checqueNum').hide("fast")
              $('.cheque').prop('required',false);
          $('.creditcard').prop('required',false);
            
            $('.bank_select').show("fast")
            $('.bank').prop('required',true);
        }
      
   });

    </script>
    @endsection