@extends('layouts.master')
@section('styleTags')
    <link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"/>
@endsection 
@section('content')
    <div class="content-wrapper" style="margin-top:2%;">
        @include('inc/flashMessages')
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Search Document No</h1>
                    </div> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                     
                    <div class="card-body">
                        <form method="get" action="{{route('viewDocumentByID')}}" id="viewDocument">
                        @csrf
                        <div class="form-group">
                            <label for="search-id">Document No</label>
                            <input type="number" min="1" required id="saleId" name="id" placeholder="Enter Document Number/ Product Number ..." id="search-id" class="form-control">
                        </div>
                        <input type="submit" id="submitBtn" value="Search" class="btn btn-primary pull-right">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if(isset($sales))
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Search Results</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table-hover table" id="CustomerTable">
                    <thead>
                        <th>Helper</th>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Document Number</th>
                        <th>Customer ID</th>
                        <th>Issue Date</th>
                        <th>Posted On</th>
                        <th>Posted By</th>
                        <th>SPO</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        
                        @forelse ($sales as $sale)
                            <tr>
                                <td>Payment: {{getPayment($sale->CustomerID)}} <br> Sale: {{getSale($sale->CustomerID)}}<br> Refund: {{getRefund($sale->CustomerID)}}</td>
                                <td> <a href="{{route('Customer.show',$sale->CustomerID)}}" target="_blank">{{$sale->SaleID}}</a></td>
                                <td>{{$sale->LeadType}}</td>
                                <td>{{$sale->ProductNum}}</td>
                                <td><a href="{{route('Customer.show',$sale->CustomerID)}}">{{$sale->CustomerName}}</a></td>
                                <td>{{date('d-M-y',strtotime($sale->IssueDate))}}</td>
                                <td>{{date('d-M-y',strtotime($sale->PostedOn))}} ({{date('H:i:s',strtotime($sale->PostedOn))}})</td>
                                <td>{{$sale->Uname}}</td>
                                
                                <td>
                                    @if(isset($sale->PostedByUser->name))
                                        {{$sale->PostedByUser->name}}
                                    @endif
                                </td>
                                <td>{{$sale->SaleStatus}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-centered">No Data Found</td>
                            </tr>
                        @endforelse
                        
                        
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
          @endif
    </div>
             
@endsection
@section('javascript')
<script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>

<script type="text/javascript">
        $("form#viewDocument").submit(function (e) {
            var id = $("#saleId").val();
            var url = '{{route("viewDocumentByID",":id")}}';
                url = url.replace(':id', id);
            $(this).attr('action',url) 
            console.log($(this).attr('action'))
            // return false;        
        });
        $(document).ready(function() {
            $('#CustomerTable').DataTable();
        } );
    </script>
    
@endsection