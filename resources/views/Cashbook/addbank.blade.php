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
                        <h1 class="m-0 text-dark"><b>Bank Details</b></h1>
                    </div> 
                </div>
            </div>
        </div>
           <form action="{{route('addbank')}}" method="POST">
                 @csrf
        <div class="card">
            <div class="card-header">
                <h5>Add New Bank</h5>
            </div>
            <div class="card-body ">
                    
                    <div class="row margindiv">
                        <div class="col-md-4">
                            <label> Bank Name</label>
                        </div>
                           <div class="col-md-2">
                           <label> Branch Name</label>
                        </div>
                            <div class="col-md-4">
                            <label>Details</label>
                        </div>
                          
                    </div>
                 <div class="banks">
                    <div class="row margindiv bankinfo">
                        <div class="col-md-4">
                             <input type="text" name="bank_name[]" required class="form-control">
                        </div>
                           <div class="col-md-2">
                             <input type="text" name="branch_name[]" class="form-control">
                        </div>
                            <div class="col-md-4">
                             <input type="text" name="details[]" class="form-control">
                        </div>
                          <div class="col-md-1">
                              <button class="btn btn-sm btn-primary add_more_bank" type="button" ><i class="fa fa-plus"></i></button>
                         </div>
                    </div>
                   
                 </div>
                 
                </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-md btn-success">Submit</button>
            </div>
           
        </div>
            </form> 
        
        @if($banks->count())
         <div class="card">
            <div class="card-header">
                <h5>View All Banks</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered compact">
                    <thead>
                        <th>Sr.</th>
                        <th>Name</th>
                        <th>Branch</th>
                        <th>Description (if any)</th>
                        <th></th>
                    </thead>
                    <tbody>
                    @php
                     $j=0;   
                    @endphp
                    @foreach($banks as $bank)
                        <tr>
                            <td>
                                   @php
                                   echo $j++;   
                                    @endphp
                            </td>
                             <td>{{$bank->bank_name}}</td>
                            <td>{{$bank->branch_name}}</td>
                            <td>{{$bank->description}}</td>
                            <td>
                            <form action="{{route('delete_bank',$bank->id)}}" method="POST">
                                    @csrf
                                {{-- <input type="hidden" name="bank_id" value="{{$bank->id}}"> --}}
                                   <button class="removebankPermanent btn btn-sm btn-danger" type="submit"><i class="fa fa-minus"></i></button>                         
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           
        </div>
        @endif
            
            
    </div>
@endsection
@section('javascript')
    <script>
      $('.add_more_bank').on('click', function() {
        var stringofbank='';
        stringofbank=` <div class="row margindiv">
                        <div class="col-md-4">
                             <input type="text" name="bank_name[]"  required class="form-control">
                        </div>
                           <div class="col-md-2">
                             <input type="text" name="branch_name[]" class="form-control">
                        </div>
                            <div class="col-md-4">
                             <input type="text" name="details[]" class="form-control">
                        </div>
                          
                          <div class="col-md-1">
                              <button class="btn btn-sm btn-danger remove_bank" type="button"><i class="fa fa-minus"></i></button>
                         </div>
                    </div>`;
                       $(".banks").append(stringofbank);
                       
    });
     $(document).on('click', '.remove_bank', function(e) {
        e.preventDefault();
        $(this).parent().parent().remove();
    });

   

    </script>
    @endsection