@extends('layouts.master')
@section('styleTags')
    <link rel="stylesheet" href="{{asset('dist/plugins/datepicker/datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('dist/plugins/select2/select2.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        @include('inc/flashMessages')

        {{-- Header Start --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 pl-0" >
                        <h1 class="m-0 text-dark">Edit Lead</h1>
                    </div> 
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li> 
                            <li class="breadcrumb-item">
                                <a href="{{route('leads.searchPhone')}}">Search Lead</a>
                            </li> 
                            <li class="breadcrumb-item">
                                <a href="{{route('leads.show',$lead->LeadID)}}">{{$lead->LeadID}}</a>
                            </li> 
                            </li> 
                            <li class="breadcrumb-item active">Edit Lead
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- Header End --}}
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <i class="fa fa-user mr-3"></i><a href="{{route('Customer.show',$lead->CustomerIDRef)}}">{{$lead->Customer->CustomerName}}</a>
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-phone mr-3"></i> {{$lead->Customer->PhoneNumber}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Add Details</h3></div>
                    <div class="card-body">
                        <form action="{{route('leads.update',$lead->LeadID)}}" method="POST">
                        @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="customer_id" value="{{$lead->Customer->CustomerID}}">
                                <label for="lead_type">Lead Type</label>
                                <select name="lead_type" id="lead_type" class="select2 form-control">
                                    <option value="">Select Lead Type</option>
                                    @foreach ($lead_types as $lead_type)
                                        <option value="{{$lead_type->id}}" {{$lead_type->id == $lead->lead_type_id ? 'selected' : ''}}>{{$lead_type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="source_id">Source</label>
                                    <select name="source_id" id="source_id" class="select2 form-control">
                                        <option value="">Select Source</option>
                                        @foreach ($sectors as $sector)
                                            <option value="{{$sector->id}}" {{$sector->id == $lead->source_id ? 'selected' : ''}}>{{$sector->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="destination_id">Destination</label>
                                    <select name="destination_id" id="destination_id" class="select2 form-control">
                                        <option value="">Select Destination</option>
                                        @foreach ($sectors as $sector)
                                            <option value="{{$sector->id}}" {{$sector->id == $lead->destination_id ? 'selected' : ''}}>{{$sector->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" name="subject" value="{{$lead->LeadSubject}}"  id="subject" class="form-control" placeholder="From ---- TO ---">
                            </div>
                            <div class="form-group">
                                <label for="service_date">Service Date</label>
                                <input type="text" id="service_date" autocomplete="off" value="{{$lead->ServiceDate}}" name="service_date" placeholder="Service Date" class="form-control">
                            </div>
                            <div class="form-group">
                            <label for="details">Details (Max 1000 Characters)</label>
                            <textarea name="details" class="form-control" id="details" cols="30" rows="10">{{$lead->LeadText->NotePad}}</textarea>
                            </div>
                            <div class="form-group">
                                <select name="branch_id" id="" class="select2 form-control">
                                    {{-- <option value="">Select Branch (TODO)</option> --}}
                                    @foreach ($branches as $branch)
                                        <option value="{{$branch->id}}" {{$branch->id == $lead->branch_id ? 'selected' : ''}}>{{$branch->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="create_for_others" id="create_for_others" value="0">
                                <input type="submit" class="btn btn-success pull-right" value="Update">
                            {{-- <input type="submit" class="btn btn-primary pull-left" id="createForOthers" value="Create for Other"> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{asset('dist/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('dist/plugins/select2/select2.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.select2').select2();
            $('#destination_id,#source_id').change(function(){
                var dest = $('option:selected','#destination_id')
                var src = $('option:selected','#source_id')
                if(dest.val())
                    dest = dest.text();
                else
                    dest = '';
                if(src.val())
                    src = src.text()
                else
                    src = ''
                $('#subject').val(src +" - "+ dest)
            });
            $('#createForOthers').click(function(){
                $('#create_for_others').val('1')
            })
            //Date picker
            $.fn.datepicker.defaults.format = "dd-mm-yyyy";

            $('#service_date').datepicker({
                startDate: '0d',
                autoclose: true
            })

            $('select[name="lead_type"]').change(function(){
                var text = $(this).children("option:selected").text();
                 if(text == "Hotel Booking"){
                     $("#subject").attr('placeholder','Destination City...')
                     $("#details").text('ADT: \nCHD: \nINF: \nCHECKOUT \nDATE: \nHOTEL \nCATEGORY: ')
                }
                else if(text == "Visa Processing"){
                     $("#subject").attr('placeholder','For Country...')
                     $("#details").text('ADT: \nCHD: \nINF: ')
                }
                else if(text == "Travel Insurance"){
                     $("#subject").attr('placeholder','Destinations...')
                     $("#details").text('ADT: \nCHD: \nINF: \nDuration:')
                }
                else if(text == "Tour Package"){
                     $("#subject").attr('placeholder','Country...')
                     $("#details").text('ADT: \nCHD: \nINF: \nDuration: \nMore Requirements:')
                }
                else if(text == "Umrah Package" || text == "Hajj Package" ){
                     $("#subject").attr('placeholder','Package Type...')
                     $("#details").text('ADT: \nCHD: \nINF: \nDuration: \nHotel Category:')
                }
                else{
                     $("#subject").attr('placeholder','From... To...')
                     $("#details").text('ADT: \nCHD: \nINF: \nReturn Date: \nAirline: \nClass:')
                }
            });
        })
    </script>
@endsection