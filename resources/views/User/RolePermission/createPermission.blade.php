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
                        <h1 class="m-0 text-dark"><b>Create & View Permission</b></h1>
                    </div> 
                </div>
            </div>
        </div>
        {{-- Header End --}} 
   
            <div class="card">
             <div class="card-header">
                    <h4><b>Create Permissions</b></h4>
                </div>
             <form action="{{route('addPermission')}}" method="Post">
                 @csrf
                <div class="card-body ">
                    <div class="form-group">
                    <div class="row">
                    <div class="col-md-2">
                        <label for="">New Permission</label>
                    </div>
                        <div class="col-md-6">
                        <button class="btn btn-sm btn-primary addmoreP pull-right" type="button"><i class="fa fa-plus"></i> Add More</button>
                        </div>                
                    </div>
                    </div>
                    <div class="form-group permBox">
                            <div class="perM margindiv" id="perM">
                            <div class="row">
                                <div class="col-md-8">
                                <input type="text" class="form-control  " id="PermName" placeholder="Type here...." name="newP[]">
                                </div>
                                <div class="col-md-2 del-jv" style="display:none;">
                                <button class="btn btn-sm btn-danger del_p" type="button"><i class="fa fa-minus"></i> </button>
                                </div>
                            </div>
                            </div>
                    </div>
                    <button class="btn btn-md btn-success " type="submit"> Add Permission</button>
               </div>
          </form>
            </div>
            @if(count($permissions))
             <div class="card">
              <div class="card-header">
                    <h4><b>View Permissions</b></h4>
                </div>
            
                <div class="card-body ">
                    <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered">
                    <thead>
                     <tr>
                     <th>Permission Title</th>
                     <th>Action</th>
                     </tr>
                    </thead>
                    <tbody>
                      @foreach($permissions as $perm)
                      <tr>
                      <td>{{$perm->name}}</td>
                      <td>
                       <form action="{{route('removePerm',$perm->id)}}" method="Post">
                              @csrf
                            <button class="btn btn-sm btn-danger"  type="submit">
                                 <i class="fa fa-minus"></i>
                            </button>
                        </form>
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                    </table>
                    </div>
                    </div>                 
               </div>
            </div>
            @endif
    </div>
@endsection

@section('javascript')
<script>
 $('.addmoreP').on('click', function() {
    
     $('#perM').clone().find("input").val("").end().appendTo(".permBox");
    $('div.del-jv').not(':first').show();
           
    });
      $(document).on('click', '.del_p', function(e) {
        e.preventDefault();
        $(this).closest('.perM').remove();
        clonecount++;
    });
</script>
@endsection