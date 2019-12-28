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
    <div class="content-wrapper" style="margin-top:2%;">
        @include('inc/flashMessages')
       
        <div class="row">
            <div class="card col-md-12">
                <div class="card-header">
                    <h3><b>Lead Status Report</b></h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" data-page-length="100" id="statusReport">
                        <thead class="table-dark">
                            <tr>
                                <th>Lead ID</th>
                                <th>Customer</th>
                                <th>Lead Subject</th>
                                <th>Status</th>
                                <th>User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leadStatus as $leadS )
                            <tr>
                             <td> <a href="{{route('leads.show',$leadS->LeadID)}}">{{$leadS->LeadID}}</a></td>
                            <td>{{$leadS->Customer->CustomerName}}</td>
                            <td>{{$leadS->LeadSubject}}</td>
                           
                            <td>
                                @if($leadS->LeadStatus=='Completed')
                                <span class="badge badge-success">{{$leadS->LeadStatus}}</span>
                                @elseif($leadS->LeadStatus=='Closed')
                                <span class="badge badge-danger">{{$leadS->LeadStatus}}</span>
                                  @elseif($leadS->LeadStatus=='Open')
                                <span class="badge badge-warning">{{$leadS->LeadStatus}}</span>
                                 @elseif($leadS->LeadStatus=='Working')
                                <span class="badge badge-info">{{$leadS->LeadStatus}}</span>
                                @endif
                            </td>
                                <td>{{$leadS->User->name}}</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>   
@endsection
@section('javascript')
<script>
 $('#statusReport').DataTable( {
     dom: 'Bfrtip',
     buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
} );
</script>
@endsection