@extends('layouts.master') 
@section('content')
    <div class="content-wrapper" style="margin-top:2%;">
        @include('inc/flashMessages')
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">View Sale by ID</h1>
                    </div> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                     
                    <div class="card-body">
                        <form method="get" action="{{route('viewSaleByID')}}" id="viewSale">
                        @csrf
                        <div class="form-group">
                            <label for="search-id">Sale or Refund ID</label>
                            <input type="number" min="1" required id="saleId" name="id" placeholder="Enter Sale ID ..." id="search-id" class="form-control">
                        </div>
                        <input type="submit" id="submitBtn" value="Search" class="btn btn-primary pull-right">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
             
@endsection
@section('javascript')
<script type="text/javascript">
        $("form#viewSale").submit(function (e) {
            var id = $("#saleId").val();
            var url = '{{route("viewSaleByID",":id")}}';
                url = url.replace(':id', id);
            $(this).attr('action',url) 
            console.log($(this).attr('action'))
            // return false;        
        });
    </script>
@endsection