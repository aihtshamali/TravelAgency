@extends('layouts.master')
@section('styleTags')
<style>
.cardgap{
margin-left:5%;
}
</style>
@endsection 
@section('content')
    <div class="content-wrapper" style="margin-top:2%;">
        @include('inc/flashMessages')
       
        <div class="row">
            <div class="card col-md-12 ">
                <div class="card-header">
                    <h3><b>Report Range</b></h3>
                </div>
            <form action="{{route('userPerformanceReportDouble')}}" method="POST">
                @csrf
                <div class="card-body row">
                     <div class="form-group col-md-5">
                        <label for="Datefrom">Date From</label>
                        <div class="input-group">
                           <input type="date" name="dateFrom" class="form-control">
                        </div>
                    </div>
                     <div class="form-group col-md-5">
                        <label for="Dateto">Date To</label>
                        <div class="input-group">
                           <input type="date" name="dateTo" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                    <label for="" style="visibility:hidden;">action</label>
                    <div class="input-group">
                         <input type="hidden" name="previous_dateFrom" value="{{$dateFrom}}">
                         <input type="hidden" name="previous_dateTo" value="{{$dateTo}}">
                         
                         <button type="submit" class="btn btn-md btn-info "> Generate Report</button>
                     </div>
                  </div>
                </div>
            </form>
            </div>
        </div>
        
        <div class="row">
            <div class="card olddate col-md-12">
                <div class=" card-header">
                    <h6>Showing Results from <b>[{{date('d-M-y',strtotime($dateFrom))}}]</b> to <b>[{{date('d-M-y',strtotime($dateTo))}}]  </b></h6>
                </div>
                <div class="card-body">
                <table class="table table-bordered ">
                    <thead class="table-dark">
                        <tr>
                            <th>Branch</th>
                            <th>User</th>
                            <th>Net Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                      @php
                  $count=array();   
                 @endphp
                      @foreach ($Userdata as $Userd )
                        <tr>
                             <td>
                                @if($Userd->branch_id=='1')
                                 HDQ
                                 @else
                                 NAN
                                @endif
                             </td>
                            <td>
                           @php
                                $name=App\Http\Controllers\CustomerController::username($Userd->model_id);
                            @endphp
                             <a href="{{route('showDetailByUserNameCRM',$name)}}"> {{$name}}</a>  
                            
                            </td>
                            <td>PKR/- {{number_format($Userd->NetProfit,0)}}
                                 @php
                        array_push($count,$Userd->NetProfit);   
                        @endphp
                            </td>
                        </tr>
                      
                    @endforeach
                         <tr>
                            <td colspan="2">Total</td>
                            <td>PKR/- <b> @php $cash=array_sum($count); 
                    echo number_format($cash,0) @endphp </b></td>
                        </tr> 
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="newdate card cardgap col-md-5" style="display: none;">
                <div class="card-header">
                    <h6>Showing Results from <b>[<span id="newdatetext">{{date('d-M-y',strtotime($new_dateFrom))}}</span>]</b> to <b>[{{date('d-M-y',strtotime($new_dateTo))}}]  </b></h6>
                </div>
                @if(isset($new_dateFrom) && $new_dateFrom!=null)
                <div class="card-body">
                    <table class="table table-bordered ">  
                   <thead class="table-dark">
                    <tr>
                        <th>Branch</th>
                        <th>User</th>
                        <th>Net Profit</th>
                    </tr>
                     </thead>
                    <tbody>
                      @php
                  $count=array();   
                 @endphp
                    @foreach ($Userdatanew as $Userd )
                        <tr>
                             <td>
                                @if($Userd->branch_id=='1')
                                 HDQ
                                 @else
                                 NAN
                                @endif
                             </td>
                            <td>
                                @php
                                $name=App\Http\Controllers\CustomerController::username($Userd->model_id);
                            @endphp
                             <a href="{{route('showDetailByUserNameCRM',$name)}}"> {{$name}}</a>  
                            
                            </td>
                            <td>PKR/- {{number_format($Userd->NetProfit,0)}}
                                 @php
                        array_push($count,$Userd->NetProfit);   
                        @endphp
                            </td>
                        </tr>
                      
                    @endforeach
                         <tr>
                            <td colspan="2">Total</td>
                            <td>PKR/- <b> @php $cash=array_sum($count); 
                    echo number_format($cash,0) @endphp </b></td>
                        </tr> 
                    </tbody>
                        </table>
                </div>
             </div>
             @endif
        </div>
            
    </div>   
@endsection
@section('javascript')
 <script>
  if(document.getElementById("newdatetext").innerHTML !=null)
  {
   $('.olddate').removeClass('col-md-12');
    $('.olddate').addClass('col-md-5');
    $('.olddate').addClass('cardgap');
    $('.newdate').show('fast');
  }
  else{
   $('.olddate').addClass('col-md-12');
   $('.olddate').removeClass('col-md-5');
    $('.olddate').removeClass('cardgap');
    $('.newdate').hide('fast');
  }
 </script>
@endsection
    