@extends('layouts.cashbookLayout')
@section('styleTags')   
<link rel="stylesheet" href="{{asset('css/cashbookCustom.css')}}">
@endsection 
@section('content')
    <div class="content-wrapper">
        @include('inc/flashMessages')
        {{-- Header Start --}}
         {{-- <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><b>Bank Based Report</b></h1>
                    </div> 
                </div>
            </div>
        </div>
         --}}
         <form action="{{route('bankBasedreport')}}" method="post">
            @csrf
            <div class="card">
            <div class="card-header">
             <h3 class="m-0 text-dark"><b>Bank Based Report</b></h3>
            </div>
            <div class="card-body">
              <div class="row">
               <div class="col-md-8">
                 <div class="form-group ">
                    <label for="" class="label"> Choose Bank</label>
                    <select name="bank" class="form-control" id="">
                    <option value="" selected disabled>Choose One</option>
                        @foreach($banks as $bank)
                    <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                        @endforeach
                    </select>
                </div>
               </div>
                <div class="col-md-2">
                <div class="form-group ">
                    <label for="" class="label" style="visibility: hidden"> Choose Action</label> 
                    <button class="btn btn-md btn-success form-control" type="submit">Genrate Report</button>
                </div>
                </div>
              </div>
            </div>
         </div>
        </form>
        @if(isset($reports))
        @if($reports->count() > 0)
        <div class="card">
            <div class="card-header">
            <h3 class="m-0 text-dark"><b>Report of "{{$chosenbanks->bank_name}}"</b></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div clas="col-md-12">
                        <table class="table table-bordered table-responsive" id="bankreporttable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Sr.</th>
                                    <th>Bank</th>
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
                                <td>{{$report->Bank->bank_name}}</td>
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
        </div>
        @else
         <div class="card">
             <div class="card-body">
                <div class="row">
                    <div clas="col-md-12">
                     <h5>No Result Found Related to Bank <b>"{{$chosenbanks->bank_name}}"</b></h5>
                    </div>
                </div>
            </div>
         </div>
        @endif
        @endif
        
    </div>
@endsection