 <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('welcome')}}" class="brand-link">
    {{-- <img src="/img/logo.png" alt="{{env('APP_NAME')}}" class="brand-image img-circle elevation-3"
   style="opacity: .8">
<span class="brand-text font-weight-light">{{env('APP_NAME')}}</span> --}}
 <i class="nav-icon fas fa-coins"></i>
    <b>Cash Book</b>
</a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{isset(Auth::user()->UserDetail->profile_pic) ? asset('storage/attachments/'.Auth::id().'/'.Auth::user()->UserDetail->profile_pic) :'/img/profile.png'}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('User.show',Auth::id())}}" class="d-block"> {{auth()->user()->name!=null ? auth()->user()->name : "Guest"}} </a>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview {!! classActivePath(1,'dashboard') !!}">
                  <a href="{{route('cashbookIndex')}}" class="nav-link "><i class="nav-icon fas fa-file"></i>
                        <p>Summary</p>
                  </a>
                </li>
                
                <li class="nav-item has-treeview">
                    <a href="{{route("search")}}" class="nav-link">
                     <i class="nav-icon fas fa-search"></i>
                     <p>Search </p>
                    </a>
                </li>
                
                  <li class="nav-item has-treeview">
                    <a href="{{route("bank")}}" class="nav-link">
                     <i class="nav-icon fas fa-bank"></i>
                     <p>Add & View Bank </p>
                    </a>
                </li>
               
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>