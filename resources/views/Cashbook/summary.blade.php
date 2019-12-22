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
            <div class="row">
                <div class="col-md-6">
                <form action="" method="post">
                @csrf
                   <div class="card">
                         <div class="card-header">
                         <h4><strong>In</strong></h4>
                        </div>
                        <div class="card-body ">
                            <div class="form-group">
                              <label for="" class="label"> Amount</label>
                                 <input type="text" name="in_amount" class="form-control">
                            </div>
                              <div class="form-group">
                           <label for="" class="label"> Details</label>
                         <input type="text" name="in_detail" class="form-control">
                        </div>
                          <div class="form-group">
                          <button class="btn btn-md btn-primary " type="submit">Cash In</button>
                          </div>
                        </div>
                       
                    </div>
                </form>
                </div>
                 <div class="col-md-6">
                    <form action="" method="post">
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
                                <div class="form-group">
                                    <label for="" class="label"> Details</label>
                                    <input type="text" name="out_detail" class="form-control">
                                </div>
                                  <div class="form-group">
                             <button class="btn btn-md btn-primary " type="submit"> Cash Out</button>
                                 </div>
                             </div>
                        </div>
                    </form>
                </div>
            </div>
            
            {{-- Close Day Book --}}
            <div class="row margindiv">
                <button class="btn btn-lg btn-success pull-right col-md-2" type="submit">Close Day Book</button>
            </div>
            
            {{-- Print --}}
               <div class="row margindiv">
                <button class="btn btn-lg btn-success pull-right col-md-2 offset-md-10" style="  background-color: rgb(31, 38, 45) !important; border:rgb(31, 38, 45) !important;" type="submit">Print Summary</button>
            </div>
            
    </div>
@endsection
    