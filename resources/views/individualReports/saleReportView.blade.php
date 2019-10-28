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
</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="usr-logo">
                <img src="{{asset('img/logo.jpg')}}" alt="Logo-png">
            </div>
            <h1 class="mb-0">Sale Report ▶ Single User</h1>
            <strong>From:</strong> {{$UserData['fromDate']}}
            <br>            
            <strong>To:</strong> {{$UserData['toDate']}}            
            <br>            
            <strong>Showing:</strong> {{$UserData['transaction_type']}}            
        </div>
    </div>
    {{dump($reportData)}}
    <div class="row mauto mt-4">
        <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-lg">
            <thead>
                <tr>
                    <th colspan="16" class="Big text-center">Sales</th>
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
                @forelse ($reportData as $item)
                    <tr>
                        <td>{{$item->SaleID}}</td>
                        <td>{{date('d M yy',strtotime($item->IssueDate))}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="16">There is no Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection