@extends('layouts.master') 
@section('content')
@php
 $show ='display:none';   //USING FOR UPDATION
@endphp


    
    <div class="content-wrapper" style="margin-top:2%;">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Transaction Details</h1>
                    </div> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 >Info</h3>
                    </div> 
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <tbody>
                                <tr>
                                    <td>Posting ID</td> 
                                    <td>{{$sale->SaleID}}</td>
                                </tr> 
                                <tr>
                                    <td>Customer</td> 
                                    <td>{{$sale->CustomerName}}</td>
                                </tr> 
                                <tr>
                                    <td>Lead No</td> 
                                    <td>PKR</td>
                                </tr> 
                                <tr>
                                    <td>SPO</td> 
                                    <td>qaiser @HDQ</td>
                                </tr>
                                <tr>
                                    <td>Posted By</td> 
                                    <td>PKR</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Product</h3>
                    </div> 
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <tbody>
                                <tr>
                                    <td>Transaction Type</td> 
                                    <td>{{$sale}}</td>
                                </tr> 
                                <tr>
                                    <td>Transaction Date</td> 
                                    <td>PKR</td>
                                </tr> 
                                <tr>
                                    <td>Document No</td> 
                                    <td>PKR</td>
                                </tr> 
                                <tr>
                                    <td>Passenger</td> 
                                    <td>PKR</td>
                                </tr>
                                <tr>
                                    <td>Details</td> 
                                    <td>LHE-DXB</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Accounting</h3>
                    </div> 
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <tbody>
                                <tr>
                                    <td>Amount</td> 
                                    <td>{{$sale}}</td>
                                </tr> 
                                <tr>
                                    <td>Net Amount</td> 
                                    <td>PKR</td>
                                </tr> 
                                <tr>
                                    <td>Profit</td> 
                                    <td>PKR</td>
                                </tr> 
                                <tr>
                                    <td>Details</td> 
                                    <td>Test</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Status</h3>
                    </div> 
                    <div class="card-body">
                        <table class="table  table-hover  bordered ">
                            <tbody>
                                <tr>
                                    <td>Approval Status</td> 
                                    <td>Pending</td>
                                </tr> 
                                <tr>
                                    <td>Action By</td> 
                                    <td>None</td>
                                </tr> 
                                <tr>
                                    <td>Action On</td> 
                                    <td>None</td>
                                </tr> 
                                <tr>
                                    <td colspan="2"><a href="#">Approve</a>|<a href="#">Reject</a></td> 
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
    <script>
        $(document).ready(function(){
            $('select[name="customer_type"]').on('change',function(){
                var type=$(this).children('option:selected').text()
                console.log(type);
                if(type == "Individual"){
                    $(".gender").show();
                }else{
                    $(".gender").hide();
                }
            });
            
        });
        function ValidateAmount()
        {
            var profit=$( "#amount" ).val()-$( "#cost" ).val();
            console.log(profit);
            $("#profit").val(profit);
            // alert("Hey");
        }
    </script>
@endsection