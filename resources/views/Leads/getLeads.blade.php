@extends('layouts.master')
@section('styleTags')
<style>
.badge{
    padding:3px !important;
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
             <div class="card-header">
             <h6>Showing Results from <b>[{{date('d-M-y',strtotime($dateFrom))}}]</b> to <b>[{{date('d-M-y',strtotime($dateTo))}}] </b> and Lead Status <b>[{{$status}}]</b> for {{$type}}</h6>
            </div>
              <div class="card-body">
                        <table class="table table-bordered compact" id="leads">
                    <thead>
                        <th>Lead ID</th>
                        <th>Customer ID</th>
                        <th>Lead Subject</th>
                        <th>Lead Status</th>
                        <th>User</th>
                       
                    </thead>
                    <tbody>
                    @foreach ($getleads as $item)
                        <tr>
                        <td>{{$item->LeadID}}</td>
                        <td>{{$item->CustomerIDRef}}</td>  
                        <td>{{$item->LeadSubject}}</td> 
                        
                        <td>
                            @if($item->LeadStatus=='Completed')
                                {{$item->LeadStatus}} <br>
                                @if($item->ClosedOn>=$dateFrom && $item->ClosedOn<=$dateTo)
                                <span class="badge badge-sm badge-success">{{date('d-M-y',strtotime($item->ClosedOn))}}</span>
                                @else 
                                {{date('d-M-y',strtotime($item->ClosedOn))}}
                                @endif
                            @elseif($item->LeadStatus=='Closed')  
                                 {{$item->LeadStatus}} <br>
                                @if($item->ClosedOn>=$dateFrom && $item->ClosedOn<=$dateTo)
                                <span class="badge badge-sm badge-danger">{{date('d-M-y',strtotime($item->ClosedOn))}}</span>
                                @else 
                                {{date('d-M-y',strtotime($item->ClosedOn))}}
                                @endif
                            @elseif($item->LeadStatus=='Open')  
                                {{$item->LeadStatus}} <br>
                                @if($item->LastUpdatedOn>=$dateFrom && $item->LastUpdatedOn<=$dateTo)
                                <span class="badge badge-sm badge-warning">{{date('d-M-y',strtotime($item->ClosedOn))}}</span>
                                @else 
                                {{date('d-M-y',strtotime($item->ClosedOn))}}
                                @endif
                            @elseif($item->LeadStatus=='Working')  
                                {{$item->LeadStatus}} <br>
                                @if($item->CreatedOn>=$dateFrom && $item->CreatedOn<=$dateTo)
                                <span class="badge badge-sm badge-info">{{date('d-M-y',strtotime($item->ClosedOn))}}</span>
                                @else 
                                {{date('d-M-y',strtotime($item->ClosedOn))}}
                                @endif
                            @endif
                                
                        </td> 
                        <td>
                        Created By:
                          @php
                            $name=getUserNameById($item->user_id);
                        @endphp
                        <a href="{{route('showDetailByUserNameCRM',$name)}}"> {{$name}}</a> <br> 
                        Taken Over By:
                        @php
                            $name=getUserNameById($item->taken_over_by);
                        @endphp
                        <a href="{{route('showDetailByUserNameCRM',$name)}}"> {{$name}}</a> 
                        </td>
                        
                        </tr>
                    @endforeach
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>   
@endsection
@section('javascript')

@endsection