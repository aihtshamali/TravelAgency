@extends('layouts.report')
@section('styleTags')
<style>
h1 {
    font-size: 1.3em;
    margin-block-start: 0.67em;
    margin-block-end: 0.67em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
}
* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: sans-serif, Tahoma, Arial, Verdana;
}
body{
    font-size:0.8em;
    background-color:white
}
.usr-logo{
    float: right; 
    
}
table th.Big{font-size: 19px !important;}
td,th{
    padding:5px !important;
    border-right:0.1px solid #000 !important;
    border-left:0.1px solid #000 !important;
    border-top:0.2px solid #000 !important;
    border-bottom:0.2px solid #000 !important;
    font-size: 0.9em !important
}
.table-bordered{border:2px solid #000 !important;}
.border-top{
    border-top-color: black !important;
}
.border-bottom{
    border-bottom-color: black !important;
}
 
.border-lr{
    border-left-color: black !important;
    border-right-color: black !important;
}
.usr-logo > img{
     width: 200px;
}
table th.Big{
    font-size: 1.1em;
    background-color: rgb(240, 240, 240);
}
.mauto{
    margin:auto
}
th,td{
    text-align: center
}
</style>
    <link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"/>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="usr-logo">
                <img src="{{asset('img/logo.jpg')}}" alt="Logo-png">
            </div>
            <h1 class="mb-0 mt-0">Sale Report ▶ Single User</h1>
            <p><strong>From:</strong> {{$UserData['fromDate']}}
            <br>            
            <strong>To:</strong> {{$UserData['toDate']}}            
            <br>            
            <strong>Showing:</strong> {{$UserData['transaction_type']}} ({{$UserData['status']=='Rejected' ? 'Not Approved Transaction' : 'Approved Transaction'}})         
            </p>
        </div>
    </div>
    <div class="row mauto mt-3">
        {{-- <table id='CustomerTable' class="table table-bordered table-responsive-sm table-responsive-md table-responsive-lg border-top border-bottom border-lr"> --}}
        <table class="table-bordered table-responsive-sm table-responsive-md table-responsive-lg border-top" style="width:100%;">
            <thead>
                <tr >
                    <th colspan="16" class="border-top Big text-center">Sales</th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>DOI</th>
                    <th>Customer</th>
                    <th>Customer ID</th>
                    <th>Type</th>
                    <th>Number</th>
                    <th>Passenger</th>
                    <th>Details</th>
                    <th>Accounting</th>
                    <th>Amount</th>
                    <th>Net</th>
                    <th>Profit</th>
                    <th>SPO</th>
                    <th>Posted By</th>
                    <th>Posted On</th>
                    <th>Approved By</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $Totalamount = 0;$Totalnet=0;$Totalprofit=0;
                @endphp
                @forelse ($reportData as $item)
                    <tr>
                        @php
                            $Totalprofit+=$item->ProfitAmount;
                            $Totalnet+=$item->NetCost;
                            $Totalamount+=$item->Amount;
                        @endphp
                        <td>{{$item->SaleID}}</td>
                        <td>{{date('d-M-y',strtotime($item->IssueDate))}}</td>
                        <td>{{$item->Customer->CustomerName}}</td>
                        <td><a href="{{route('Customer.show',$item->Customer->CustomerID)}}">{{$item->Customer->CustomerID}}</td>
                        <td>{{isset($item->Leadtype->name) ? $item->Leadtype->name : '-'}}</td>
                        <td>{{$item->ProductNum}}</td>
                        <td>{{$item->ProductPax}}</td>
                        <td>{{$item->ProductDetail ?? "-"}}</td>
                        <td>{{$item->AccountingText}}</td>
                        <td>{{number_format($item->Amount)}}</td>
                        <td>{{number_format($item->NetCost)}}</td>
                        <td>{{number_format($item->ProfitAmount)}}</td>
                        <td>{{isset($item->PostedByUser->name) ? $item->PostedByUser->name : '-'}}</td>
                        <td>{{isset($item->UserBranch->User->name) ? $item->UserBranch->User->name : '-'}}</td>
                        <td>{{date('d M y',strtotime($item->PostedOn))}}</td>
                        <td>{{isset($item->ActionByUser->name) ? $item->ActionByUser->name : '-'}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="16">There is no Data</td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="9"></td>
                    <td><strong>{{number_format($Totalamount)}}</strong></td>
                    <td><strong>{{number_format($Totalnet)}}</strong></td>
                    <td><strong>{{number_format($Totalprofit)}}</strong></td>
                    <td colspan="4"></td>
                </tr>
            </tbody>
        </table>
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