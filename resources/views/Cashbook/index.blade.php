@extends('layouts.cashbookLayout')
@section('styleTags')   
<link rel="stylesheet" href="{{asset('css/cashbookCustom.css')}}">
@endsection 
@section('content')
    <div class="content-wrapper">
        @include('inc/flashMessages')
        {{-- Header Start --}}
         <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><b>Summary</b></h1>
                    </div> 
                </div>
            </div>
        </div>
        {{-- Header End --}} 
   
            <div class="card">
            <div class="card-body">
             <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Branch</th>
                        <th>Currently Open</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                   @foreach ($index as $i )
                    <tr>
                    <td>{{$i->BranchRef}}</td>
                    <td>{{Date('l, F jS, Y',strtotime($i->Day))}}</td>
                        <td>
                        <form action="{{route('summarydetails')}}" method="get">
                        @CSRF
                        <input type="hidden" name="branch" value="{{$i->BranchRef}}">
                        <input type="hidden" name="date" value="{{$i->Day}}">
                        <input type="hidden" name="pageRef" value="{{$i->PageNumber}}">
                        
                        <button class="btn btn-md btn-info" type="submit">View</button>
                        </form>
                        </td>
                    </tr>
                   @endforeach
                </tbody>
             </table>
            </div>
            <div class="card-footer"></div>
            
            </div>
    </div>
@endsection
    