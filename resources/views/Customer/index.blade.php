@extends('layouts.master')
@section('styleTags')
    <link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"/>
@endsection
@section('content')
    <div class="content-wrapper">
        {{-- Header Start --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Customers</h1>
                    </div> 
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li> 
                            <li class="breadcrumb-item active">Customers
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- Header End --}}
        <form action="{{route('Customer.index')}}" method="GET">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Search by Name</h3></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="search-name">Customer Name</label>
                                <input type="text" style="text-transform:uppercase" name="name" id="search-name" class="form-control">
                            </div>
                                <input type="submit" value="Search" class="btn btn-primary pull-right">
                        </div> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Search by Phone</h3></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="search-phone">Customer Phone</label>
                                <input type="text" name="phone" placeholder="03xxxxxxxxx" id="search-phone" class="form-control">
                            </div>
                                <input type="submit" value="Search" class="btn btn-primary pull-right">
                        </div> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Search by Account</h3></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="search-account">Customer Account No.</label>
                                <input type="text" name="account" placeholder="" id="search-account" class="form-control">
                            </div>
                                <input type="submit" value="Search" class="btn btn-primary pull-right">
                        </div> 
                    </div>
                </div>
            </div>
        </form>
        {{-- Form END --}}
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table-hover table" id="CustomerTable">
                    <thead>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Phone</th>
                        <th>Created On</th>
                        <th>Created By</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{$customer->CustomerID}}</td>
                                <td>{{$customer->CustomerName}}</td>
                                <td>{{$customer->PhoneNumber}}</td>
                                <td>{{date('Y-M-d',strtotime($customer->CreatedOn))}}</td>
                                <td>{{$customer->CreatedBy}}</td>
                                <td>EDIT / ARCHIVE</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
@endsection

@section('javascript')
 
    <script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#CustomerTable').DataTable();
        } );
    </script>
@endsection
