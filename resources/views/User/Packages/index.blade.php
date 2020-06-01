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
                        <h1 class="m-0 text-dark"><b>Create New Package</b></h1>
                    </div> 
                </div>
            </div>
        </div>
        {{-- Header End --}}  
        
          
            <div class="card">
             <form action="{{route('createPackage')}}" method="Post" enctype="multipart/form-data">
                 @csrf
                <div class="card-body">
                   <div class="row">
                       <div class="col-md-6">
                             <label>
                              Package Title
                            </label>
                            <input type="text" class="form-control" name="p_title" required>                
                      </div>
                      <div class="col-md-6">
                        <label>
                        Description/Details
                        </label>
                        <textarea type="text" class="form-control" rows='1' name="p_descp"></textarea>                
                    </div>
                   </div>
                   
                   <div class="margindiv row">
                       <div class="col-md-6">
                             <label>
                             Start Date
                            </label>
                            <input type="date" class="form-control" name="s_date">                
                      </div>
                      <div class="col-md-6">
                        <label>
                         End Date
                        </label>
                      <input type="date" class="form-control" name="e_date">                
                    </div>
                   </div>
                   
                     <div class=" margindiv row">
                       <div class="col-md-6">
                             <label>
                           Source
                            </label>
                           <select name="source_id" id="" class="form-control">
                            <option selected disabled> Choose One</option>
                            @foreach ($sectors as $item)
                           <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                           </select>                
                      </div>
                      <div class="col-md-6">
                        <label>
                        Destination
                        </label>
                        <select name="destination_id" id="" class="form-control">
                                <option selected disabled> Choose One</option>
                        
                                @foreach ($sectors as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>                    
            
                        </div>
                   
                   </div>
                   
                      <div class=" margindiv row">
                       <div class="col-md-6">
                              <label>
                             Upload Image
                            </label> <br>
                           <input type="file" name="p_img">  
                       
                       </div>
                       
                       </div>
                      <div class=" margindiv row">
                    <button class="btn btn-md btn-success text-center col-md-2  offset-md-5" type="submit"> Create Package</button>
                      </div>
               </div>
          </form>
            </div>
            <div class="clearfix"></div>
    </div>
@endsection

