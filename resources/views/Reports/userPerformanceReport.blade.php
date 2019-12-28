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
                    <h6><b>Showing Results from [{{date('d-M-y',strtotime($dateFrom))}}] to[{{date('d-M-y',strtotime($dateTo))}}]  </b></h6>
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">Total</td>
                            <td>{{number_format('123456',2)}}</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="newdate card cardgap col-md-5" style="display: none;">
                <div class="card-header">
                    <h6><b>Showing Results from [<span id="newdatetext">{{date('d-M-y',strtotime($new_dateFrom))}}</span>] to[{{date('d-M-y',strtotime($new_dateFrom))}}]  </b></h6>
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
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Total</td>
                        <td>{{number_format('123456',2)}}</td>
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
    