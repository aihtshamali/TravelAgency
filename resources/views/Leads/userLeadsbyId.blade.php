@extends('layouts.master')
@section('styleTags')
   <style>
        .badge{
            color:white;
            font-weight: bold;
        }
         td > span.badge{
            padding:0.5rem 0.4rem;
            min-width:80px;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('inc/flashMessages')
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header"><h3 class="card-title font-weight-bold">USER LEADS - {{$user_leads[0]->User->name}}</h3></div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                         <th>Lead ID</th>
                                         <th>Customer</th>
                                         <th>Type</th>
                                         <th>Subject</th>
                                         <th>Service Date</th>
                                         <th>Working Since</th>
                                         <th>Last Updated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($user_leads as $lead)
                                       <tr>
                                       <td>
                                            @if(isset( $lead->LeadID ))
                                       <a href="{{route('leads.show',$lead->LeadID)}}">  {{$lead->LeadID}}</a>
                                            @else
                                                Not Found
                                            @endif
                                       </td>
                                        <td>
                                             @if(isset( $lead->Customer->CustomerName ))
                                              <a href="{{route('Customer.show',$lead->CustomerIDRef)}}"> {{$lead->Customer->CustomerName}}</a>
                                            @else
                                                Not Found
                                            @endif
                                       </td>
                                         <td>
                                             @if(isset( $lead->LeadType->name ))
                                            {{$lead->LeadType->name}}
                                            @else
                                                Not Found
                                            @endif
                                         </td>
                                         <td>
                                             @if(isset( $lead->LeadSubject ))
                                            {{$lead->LeadSubject}}
                                            @else
                                                Not Found
                                            @endif
                                         </td>
                                         <td>
                                         
                                          @if(isset( $lead->ServiceDate ))
                                                  {{date('d-M-y',strtotime($lead->ServiceDate))}}
                                            @else
                                                Not Found
                                            @endif
                                         </td>
                                         <td>
                                           @php
                                                $date1=date_create($lead->CreatedOn);
                                                $date2=date_create();
                                                $diff=date_diff($date1,$date2);
                                                echo $diff->format("%m Month %d Day %h Hours ");
                                                @endphp
                                         </td>
                                         <td>
                                             @if(isset( $lead->LastUpdatedOn ))
                                            {{date('d-M-y (h:i :A)',strtotime($lead->LastUpdatedOn))}}
                                            @else
                                                Not Found
                                            @endif
                                         </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
@endsection