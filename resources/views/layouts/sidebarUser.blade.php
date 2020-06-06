 <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('welcome')}}" class="brand-link">
    {{-- <img src="/img/logo.png" alt="{{env('APP_NAME')}}" class="brand-image img-circle elevation-3"
   style="opacity: .8">
<span class="brand-text font-weight-light">{{env('APP_NAME')}}</span> --}}
 <i class="nav-icon fas fa-users"></i>
    <b>User Management</b>
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
                  <a href="{{route('User.index')}}" class="nav-link "><i class="nav-icon fas fa-home"></i>
                        <p>Home</p>
                  </a>
                </li>
                
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-users"></i>
                      <p>
                        User List
                        <i class="right fa fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{route("activeUser")}}" class="nav-link">
                          <p>Active Users</p>
                        </a>
                      </li>
                        <li class="nav-item">
                            <a href="{{route("blockUser")}}" class="nav-link">
                               <p>Blocked Users</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{route("searchUserView")}}" class="nav-link">
                     <i class="nav-icon fas fa-search"></i>
                     <p>Search User </p>
                    </a>
                </li>
                 <li class="nav-item has-treeview">
                     <a href="{{route('User.create')}}" class="nav-link">
                     <i class="nav-icon fas fa-user-plus"></i>
                     <p>Create New User </p>
                    </a>
                </li>
                
                 <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                       Roles & Permissions
                        <i class="right fa fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item has-treeview">
                         <a href="{{route("rolesAuthorityView")}}" class="nav-link">
                         <p>Roles & Authority </p>
                     </a>
                     </li>
                        <li class="nav-item has-treeview">
                            <a href="{{route("rolesPermissionView")}}" class="nav-link">
                            <p>Roles & Permission </p>
                            </a>
                        </li>
                        
                        <li class="nav-item has-treeview">
                            <a href="{{route("PermissionAssignView")}}" class="nav-link">
                            <p>Assign Permission to Role </p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                  <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon  fa fa-globe" aria-hidden="true"></i>
                      <p>
                      Packages
                        <i class="right fa fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item has-treeview">
                         <a href="{{route("createpackageview")}}" class="nav-link">
                         <p>Create Package</p>
                     </a>
                     </li>
                        <li class="nav-item has-treeview">
                            <a href="{{route("viewPackage")}}" class="nav-link">
                            <p>View Package </p>
                            </a>
                        </li>
                    </ul>
                </li>


                
                 
                 <li class="nav-item has-treeview">
                    <a href="{{route("userActivitylogView")}}" class="nav-link">
                     <i class="nav-icon fas fa-history"></i>
                     <p>Activity Log </p>
                    </a>
                </li>
               
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>