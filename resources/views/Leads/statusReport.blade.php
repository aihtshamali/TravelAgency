@extends('layouts.master')
@section('styleTags')
<style>
.badge{
    padding:7% !important;
    font-size:15px !important;
}
</style>
@endsection 
@section('content')
    <div class="content-wrapper" >
        @include('inc/flashMessages')
        
       <div class="row">
            <div class="card col-md-6 offset-md-3 ">
           <h5><b>Lead Status Report</b></h5>
            <form action="{{route('leadStatusReportsearch')}}" method="POST">
                @csrf
                <div class="card-body row">
                     <div class="form-group col-md-6">
                        <label for="Datefrom">Date From</label>
                        <div class="input-group">
                           <input type="date" name="dateFrom" required class="form-control">
                        </div>
                    </div>
                     <div class="form-group col-md-6">
                        <label for="Dateto">Date To</label>
                        <div class="input-group">
                           <input type="date" name="dateTo" required class="form-control">
                        </div>
                    </div>
                </div>
                <div class="card-body row">
                <div class="form-group col-md-6">
                        <label for="Dateto">User</label>
                         <div class="input-group">
                           <select name="CreatedBy" required class="form-control">
                           <option value="" selected    >Choose Option</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->user_name}} [{{$user->name}}] </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                      <div class="form-group col-md-6">
                        <label for="Dateto">Status</label>
                          <select name="leadStatus" class="form-control">
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
                    <button type="submit" class="btn btn-md btn-info col-md-4 offset-md-4"> Generate Report</button>
                </div>
            </form>
            </div>
        </div>
    </div>   
@endsection
@section('javascript')

@endsection