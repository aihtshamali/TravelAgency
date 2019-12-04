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
        {{-- Header Start --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Lead Report</h1>
                    </div> 
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li> 
                            <li class="breadcrumb-item active">Lead Report
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- Header End --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                       
                    <div class="card-body">
                        <form action="{{route('leadReportSearch')}}" id="SalesearchForm" method="post">
                            {{ csrf_field() }}
                            @if(isset($users))
                            <div class="form-group">
                                <label for="">Branch or User</label>
                                <select name="user" id="user" class="form-control">
                                    <optgroup label="Branches">
                                    @foreach ($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}} </option>
                                    @endforeach
                                    <optgroup label="Users">
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->user_name}} ({{$user->name}})</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="">Date From</label>
                                <input type="text" name="fromDate" required autocomplete="off" placeholder="dd-mm-yyyy" class="datepicker form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Date To</label>
                                <input type="text" name="toDate" required autocomplete="off" placeholder="dd-mm-yyyy" class="datepicker form-control">
                            </div>
                            <div class="form-group">
                                
                                <input type="hidden" id="branch" name="branch" value="1">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-success" onClick="setStatus('Approved')">Show Approved Transactions</button>
                                <button type="button" class="btn btn-danger" onClick="setStatus('Rejected')">Rejected/Pending Transactions</button>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script>
        function setStatus(status) {
            $('#status').val(status);
            $('#SalesearchForm').submit();
            
        }
        
    </script>
    <script src="{{asset('dist/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <script>
        $(document).ready(function(){
            //Date picker
            $.fn.datepicker.defaults.format = "yyyy-mm-dd";

            $('.datepicker').datepicker({
                autoclose: true
            })

            $('#user').change(function() {
                var selected = $(':selected', this);
                var group=selected.closest('optgroup').attr('label');
                // alert(group);
                if(group == 'Branches')
                {
                    $('#branch').val(1);    
                }
                else
                {
                    // alert('Yes');
                    $('#branch').val(0);    
                }
            })
            
        });
    </script>
@endsection