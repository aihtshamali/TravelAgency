@extends('layouts.master')
@section('styleTags')
@endsection 
@section('content')
    <div class="content-wrapper" style="margin-top:2%;">
        @include('inc/flashMessages')
       
        <div class="row">
            <div class="card col-md-6 offset-md-3">
                <div class="card-header">
                    <h3><b>Report Range</b></h3>
                </div>
            <form action="{{route('userPerformanceReportIndividual')}}" method="POST">
                @csrf
                <div class="card-body row">
                     <div class="form-group col-md-6">
                        <label for="Datefrom">Date From</label>
                        <div class="input-group">
                           <input type="date" name="dateFrom" class="form-control">
                        </div>
                    </div>
                     <div class="form-group col-md-6">
                        <label for="Dateto">Date To</label>
                        <div class="input-group">
                           <input type="date" name="dateTo" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-md btn-info col-md-4 offset-md-4"> Generate Report</button>
                </div>
            </form>
            </div>
        </div>
    </div>   
@endsection
@section('javascript')
@endsection