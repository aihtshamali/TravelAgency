@extends('layouts.master')
@section('styleTags')
    <link rel="stylesheet" href="{{asset('dist/plugins/datepicker/datepicker3.css')}}">
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
        {{-- Header Start --}}
        <div class="content-header">
            <div class="container-fluid pl-0">
                <div class="row mb-2">
                    <div class="col-sm-6 pl-0">
                        <h1 class="m-0 text-dark">Lead ID: {{$lead->LeadID}}</h1>
                    </div> 
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li> 
                            <li class="breadcrumb-item">
                                <a href="{{route('lead_searchByID')}}">Search Lead</a>
                            </li> 
                            </li> 
                            <li class="breadcrumb-item active">{{$lead->LeadID}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- Header End --}}
        {{-- Button Section --}}
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Details <span class="pull-right"><a href="{{route('leads.edit',$lead->LeadID)}}">Edit</a></span></h3></div>
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <thead class="thead-dark">
                                <th>Type</th>
                                <th>Details</th>
                                <th>Service Date</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$lead->LeadType->name}}</td>
                                    <td>{{$lead->LeadSubject}}</td>
                                    <td> 
                                        <form action="{{route('leads.changeServiceDate')}}" method="post" id="ServiceDateForm">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <input type="hidden" name="lead_id" value="{{$lead->LeadID}}">
                                                <div class='input-group date' id='datetimepicker1'>
                                                    <input type='text' class="form-control" name="date" value="{{date('d-m-Y',strtotime($lead->ServiceDate))}}" />
                                                    <span class="input-group-addon">
                                                    </span>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
         </div>
        @if($lead->LeadStatus != 'Closed' && $lead->LeadStatus != 'Completed')
        <div class="row mr-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body transferDiv"><a href="#" class="transferLead">Transfer Lead</a></div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Customers <span class="pull-right"><a href="{{route('Customer.edit',$lead->Customer->CustomerID)}}">Edit Details</a></span></h3> </div>
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <tbody>
                                <tr>
                                    <td><i class="fas fa-user mr-2"></i>Customer No</td>
                                    <td>{{$lead->Customer->CustomerID}}</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-info mr-2"></i>Name</td>
                                    <td>{{$lead->Customer->CustomerName}}</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-mobile mr-2"></i>Phone No.</td>
                                    <td>{{$lead->Customer->PhoneNumber}}</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-envelope mr-2"></i>Email Address.</td>
                                    <td>{{$lead->Customer->EmailAddress ?? "NA" }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Created By</h3></div>
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <tbody>
                                <tr>
                                    <td><i class="fas fa-user mr-2"></i>Created By</td>
                                    <td>{{$lead->User->name}} on {{date('d-M-y (H:i)',strtotime($lead->CreatedOn))}}</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-user-circle mr-2"></i>Taken Over By</td>
                                    <td>{{isset($lead->TakenOverByUser->name) ? $lead->TakenOverByUser->name .' on '.date('d-M-y (H:i)',strtotime($lead->TakenOverOn)) : "NA"}}</td>
                                    
                                </tr>
                                <tr>
                                    <td><i class="fas fa-user mr-2"></i>Closed By</td>
                                    <td>{{isset($lead->ClosedBy->name) ? $lead->ClosedBy->name.' on '. date('d-M-y (H:i)',strtotime($lead->ClosedOn)) : "NA"}}</td>
                                </tr>
                                <tr>
                                    <td> <i class="fas fa-book mr-2"></i>Status</td>
                                    <td>
                                        @if($lead->LeadStatus == "Open")
                                        <span style="margin-right:6px" class="text-uppercase badge badge-success">{{$lead->LeadStatus}}</span>
                                        <a href="{{route('leads.takeOver',['LeadID'=>$lead->LeadID,'action'=>'takeover'])}}">Take Over</a>
                                        @elseif($lead->LeadStatus == "Working")
                                        <span style="margin-right:6px" class="text-uppercase badge badge-danger">{{$lead->LeadStatus}}</span>
                                            <a href="{{route('leads.takeOver',['LeadID'=>$lead->LeadID,'action'=>'complete'])}}">Complete</a> |
                                            <a href="{{route('leads.takeOver',['LeadID'=>$lead->LeadID,'action'=>'close'])}}">Close</a>
                                        @else
                                            <span style="margin-right:6px" class="text-uppercase badge badge-primary">{{$lead->LeadStatus}}</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- End --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3 class="card-title font-weight-bold">Note Pad</h3></div>
                        <div class="card-body">
                            <form action="{{route('leads.saveNotePad')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="lead_id" value="{{$lead->LeadID}}">
                                <div class="form-group">
                                                     <label for="">Maximum 1000 Characters</label>
                                <textarea name="notepad" id="" cols="30" rows="7" class="form-control">{{isset($lead->LeadText->NotePad) ? $lead->LeadText->NotePad : ''}}</textarea>
                                </div>
                                <br>
                                <div class="pull-right">
                                    <input type="submit" class="btn btn-primary" value="Update">
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
        {{-- End --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3 class="card-title font-weight-bold">Comments</h3></div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <th>Time</th>
                                    <th>Posted By</th>
                                    <th>Comments</th>
                                </thead>
                                <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach ($comments as $comment)
                                        <tr>
                                            @foreach ($comment as $fields)
                                                @if($i==0 && $fields!="")
                                                    <td>{{date('d-M-y (H:i)',strtotime($fields))}}</td>
                                                @else
                                                    <td>{{$fields}}</td>
                                                @endif
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3">
                                            <form action="{{route('leads.saveComment')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="lead_id" value="{{$lead->LeadID}}">
                                                <div class="form-group">
                                                    <label for="">Enter New Comment</label>
                                                    <input type="text" name="comment" class="form-control">
                                                </div>
                                                <div class="pull-right">
                                                    <input type="submit" class="btn btn-primary" value="Post">
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <script src="{{asset('dist/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <script>
        $(document).ready(function(){

            $('.transferLead').click(function(){
                let st = `<form method="Post" action="{{route('transferLead')}}">
                {{csrf_field()}}
                <input name="lead_id" type="hidden" value="{{$lead->LeadID}}">
        <div class="form-group">
        <select name="user_id" required id="" class="form-control">
            <option value="">-</option>
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>                
            @endforeach
        </select>
        <input type="submit" class="btn btn-primary mt-3" value="Transfer">
    </div> </form>`;                
                $('.transferDiv').html(st);
            })
            //Date picker
            $.fn.datepicker.defaults.format = "dd-mm-yyyy";

            $('#datetimepicker1').datepicker({
                startDate: '0d',
                autoclose: true,
                onSelect: function(dateText, inst) {
                   alert(dateText);
                }
            })
            .on("change", function() {
                $('#ServiceDateForm').submit();
                console.log("Got change event from field",$(this));
            });

           
        });
    </script>
@endsection