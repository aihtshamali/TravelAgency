@extends('layouts.master')
@section('styleTags')
<style>
.badge{
    padding:7% !important;
    font-size:15px !important;
}
.cardgap{
margin-left:4%;
}
</style>
@endsection 
@section('content')
    <div class="content-wrapper" style="margin-top:2%;">
        @include('inc/flashMessages')
       <div class="row">
            <div class="card col-md-12 ">
               
            <form action="{{route('statusReportDouble')}}" method="POST">
                @csrf
                {{-- {{dd(date('Y-m-d',strtotime($new_dateFrom)))}} --}}
                <div class="card-body row">
                     <div class="form-group col-md-3">
                        <label for="Datefrom">Date From</label>
                        <div class="input-group">
                        <input type="date" name="new_dateFrom" value="@if($new_dateFrom){{date('Y-m-d',strtotime($new_dateFrom))}} @endif" required class="form-control">
                        </div>
                    </div>
                     <div class="form-group col-md-3">
                        <label for="Dateto">Date To</label>
                        <div class="input-group">
                           <input type="date" name="new_dateTo" value="@if($new_dateTo!=null){{date('Y-m-d',strtotime($new_dateTo))}} @endif" required class="form-control">
                        </div>
                    </div>
                       <div class="form-group col-md-3">
                        <label for="Dateto">User</label>
                        <div class="input-group">
                           <select name="newCreatedBy" required class="form-control">
                           <option value="" selected    >Choose Option</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->user_name}} [{{$user->name}}] </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                      <div class="form-group col-md-3">
                        <label for="Dateto">Status</label>
                          <select name="newleadStatus" class="form-control">
                           <option value="" selected    >Choose Option</option>
                           <option value="All">All</option>
                           <option value="Completed">Completed</option>
                           <option value="Closed">Closed</option>
                           <option value="Open">Open</option>
                           <option value="Working">Working</option>
                           
                            </select>
                    </div>
                </div>
                <div class="form-group row">
                        <input type="hidden" name="previous_dateFrom" value="{{$dateFrom}}">
                         <input type="hidden" name="previous_dateTo" value="{{$dateTo}}">
                          <input type="hidden" name="previous_status" value="{{$status}}">
                <input type="hidden" name="previous_user" value="{{$createdby}}">
                    <button type="submit" class="btn btn-md btn-info col-md-4 offset-md-4"> Generate Report</button>
                </div>
            </form>
            </div>
        </div>
         <div class="row">
            @if(count($Userdata))
                    <div class=" olddate card col-md-6 offset-md-3">
                        <div class="card-header">
                           <h6>Showing Results from <b>[{{date('d-M-y',strtotime($dateFrom))}}]</b> to <b>[{{date('d-M-y',strtotime($dateTo))}}] </b> and Lead Status <b>[{{$status}}]</b></h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered compact"  >
                                <tbody>
                                @foreach ($Userdata as $Userdata)
                                    <tr>
                                        <th>User Name</th>
                                        <td>   
                                            @php
                                                $name=App\Http\Controllers\CustomerController::username($Userdata->userId);
                                            @endphp
                                            <a href="{{route('showDetailByUserNameCRM',$name)}}"> {{$name}}</a>  
                                                </a>
                                        </td>
                                    </tr>
                                    <tr>
                                    <th>Branch Code</th>
                                        <td>
                                            @if($Userdata->branch_id=='1')
                                            HDQ
                                            @else
                                            NAN
                                            @endif
                                        </td>
                                     </tr>   
                                     @if(isset($Userdata->CreatedLeads))
                                        <tr>
                                            <th>Created Leads</th>
                                            <td>
                                                 {{$Userdata->CreatedLeads}}
                                            </td>
                                        </tr>
                                      @endif
                                        
                                     @if(isset($Userdata->CompletedLeads))
                                        <tr>
                                            <th>Completed Leads</th>
                                            <td>
                                             {{$Userdata->CompletedLeads}}
                                            </td>
                                            </tr>
                                    @endif
                                    
                                     @if(isset($Userdata->ClosedLeads))
                                        <tr>
                                            <th>Closed Leads</th>
                                             <td>
                                                {{$Userdata->ClosedLeads}}
                                                
                                              </td>
                                        </tr>
                                    @endif
                                    
                                    @if(isset($Userdata->OpenLeads))
                                        <tr>
                                          <th>Open Leads</th>
                                          <td>
                                            {{$Userdata->OpenLeads}}
                                         </td>
                                        </tr>
                                    @endif
                                        
                                    @if(isset($Userdata->WorkingLeads))
                                            <tr>
                                            <th>Working Leads</th>
                                            <td>
                                                {{$Userdata->WorkingLeads}}
                                            </td>
                                        </tr>
                                        @endif
                                @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
            @endif
            
            @if(count($Userdatanew))
                <div class="newdate card cardgap col-md-5" style="display:none;">
                    <div class="card-header">
                        <h6>Showing Results from <b>[<span id="newdatetext">{{date('d-M-y',strtotime($new_dateFrom))}}</span>]</b> to <b>[{{date('d-M-y',strtotime($new_dateTo))}}] </b> and Lead Status <b>[{{$new_status}}]</b> </h6>
                        
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered compact" id="statusReport2" >
                            
                            <tbody>
                            @foreach ($Userdatanew as $Userdata)
                              <tr>
                                        <th>User Name</th>
                                        <td>   
                                            @php
                                                $name=App\Http\Controllers\CustomerController::username($Userdata->userId);
                                            @endphp
                                            <a href="{{route('showDetailByUserNameCRM',$name)}}"> {{$name}}</a>  
                                                </a>
                                        </td>
                                    </tr>
                                    <tr>
                                    <th>Branch Code</th>
                                        <td>
                                            @if($Userdata->branch_id=='1')
                                            HDQ
                                            @else
                                            NAN
                                            @endif
                                        </td>
                                     </tr>   
                                     @if(isset($Userdata->CreatedLeads))
                                        <tr>
                                            <th>Created Leads</th>
                                            <td>
                                                 {{$Userdata->CreatedLeads}}
                                            </td>
                                        </tr>
                                      @endif
                                        
                                     @if(isset($Userdata->CompletedLeads))
                                        <tr>
                                            <th>Completed Leads</th>
                                            <td>
                                             {{$Userdata->CompletedLeads}}
                                            </td>
                                            </tr>
                                    @endif
                                    
                                     @if(isset($Userdata->ClosedLeads))
                                        <tr>
                                            <th>Closed Leads</th>
                                             <td>
                                                {{$Userdata->ClosedLeads}}
                                                
                                              </td>
                                        </tr>
                                    @endif
                                    
                                    @if(isset($Userdata->OpenLeads))
                                        <tr>
                                          <th>Open Leads</th>
                                          <td>
                                            {{$Userdata->OpenLeads}}
                                         </td>
                                        </tr>
                                    @endif
                                        
                                    @if(isset($Userdata->WorkingLeads))
                                            <tr>
                                            <th>Working Leads</th>
                                            <td>
                                                {{$Userdata->WorkingLeads}}
                                            </td>
                                        </tr>
                                        @endif
                            @endforeach
                            
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
 $('#statusReport').DataTable();
</script>
 <script>
  if(document.getElementById("newdatetext").innerHTML !=null)
  {
   $('.olddate').removeClass('col-md-6');
   $('.olddate').removeClass('offset-md-3');
    $('.olddate').addClass('col-md-5');
    $('.olddate').addClass('cardgap');
    $('.newdate').show('fast');
  }
  else{
   $('.olddate').addClass('col-md-6');
   $('.olddate').addClass('offset-md-3');
   $('.olddate').removeClass('col-md-5');
    $('.olddate').removeClass('cardgap');
    $('.newdate').hide('fast');
  }
 </script>
@endsection