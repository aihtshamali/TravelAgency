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
                        <h1 class="m-0 text-dark"><b>Assign Permissions to Roles</b></h1>
                    </div> 
                </div>
            </div>
        </div>
        {{-- Header End --}} 
   
            <div class="card">
             <div class="card-header">
                    <h4><b>Assign Permissions</b></h4>
                </div>
             <form action="{{route('assignPermission')}}" method="Post">
                 @csrf
                <div class="card-body ">
                    <div class="row form-group">
                     <div class="col-md-4 offset-md-2">
                        <label for="">Choose Permission</label>
                        <select name="perm" class="form-control"id="">
                            <option selected disabled>Choose One</option>
                                @foreach($permissions as $p)
                            <option value="{{$p->id}}">{{$p->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="">Choose Role</label>
                        <select name="role" class="form-control"id="">
                            <option selected disabled>Choose One</option>
                                @foreach($roles as $r)
                            <option value="{{$r->id}}">{{$r->name}}</option>
                                @endforeach
                        </select>
                    </div>
                   
                    </div>
                    <div class="row form-group">
                      <div class="col-md-4 offset-md-5">
                            <button class="btn btn-md btn-primary " type="submit">Assign Permission </button>
                     </div>
                    </div>
               </div>
          </form>
            </div>
            @if(count($groupsWithPerms))
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
                     <th>Role Title</th>
                     <th>Action</th>
                     </tr>
                    </thead>
                    <tbody>
                      @foreach($groupsWithPerms as $perm)
                      <tr>
                      <td>{{getPermNames($perm->permission_id)}}</td>
                      <td>{{getRoleNames($perm->role_id)}}</td>
                      <td>
                       <form action="{{route('removePermRole')}}" method="post">
                              @csrf
                              <input type="hidden" name="permID" value="{{$perm->permission_id}}">
                              <input type="hidden" name="roleID" value="{{$perm->role_id}}">
                              
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