@extends('layouts.userLayout')
@section('styleTags')   
    <link rel="stylesheet" href="{{asset('css/userCustom.css')}}">
@endsection 
@section('content')
    <div class="content-wrapper">
        @include('inc/flashMessages')
        {{-- Header Start --}}
         <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><b>View all Package</b></h1>
                    </div> 
                </div>
            </div>
        </div>
        {{-- Header End --}}  
        
          
            <div class="card">
             <div class="row">
                <div class="col-md-12">
                 <table class="table table-bordered packagetable">
                    <thead>
                         <tr>
                          <th>Package Title</th>
                          <th>Description</th>
                          <th>Dates</th>
                          <th>Location</th>
                          <th>Attachment</th>
                          <th>Action</th>
                         </tr>                           
                    </thead>
                    <tbody>
                    @foreach ( $allpackages as $package)
                    <tr>
                    <td>{{$package->title}}</td>
                    <td>{{$package->description}}</td>
                    
                    <td>
                    {{date('d/M/y',strtotime($package->start_date))}} <strong>-</strong>
                    {{date('d/M/y',strtotime($package->end_date))}}
                    </td>
                    
                    <td>
                     @foreach ($sectors as $item)
                         @if($package->source_id==$item->id)
                         
                           {{$package->Source->name}}
                         
                         @endif
                     @endforeach
                     <strong>-</strong>
                       @foreach ($sectors as $item)
                         @if($package->destination_id==$item->id)
                         
                           {{$package->Destination->name}}
                         
                         @endif
                     @endforeach
                    </td>
                    
                    <td>
                    
                      <img src="{{asset('/storage/package_attachments/'.$package->attachment)}}" style="width: 100px !important;
    height: 100px !important;"/>
                      
                    
                    </td>
                    
                    <td>
                        <form action="{{route('deletePackage',$package->id)}}" method="Post" enctype="multipart/form-data">
                         @csrf
                        <button class="btn btn-md btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                    
                    </tr>
                    @endforeach
                   
                    </tbody>
                 </table>
                </div>
              
              </div>
            </div>
            <div class="clearfix"></div>
    </div>
@endsection

