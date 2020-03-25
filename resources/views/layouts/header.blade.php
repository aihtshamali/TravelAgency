 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>

    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
    <i class="fa fa-search"></i>
  </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="fa fa-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                <i class="fa fa-dashboard mr-2"></i> Go To Dashboard
                {{-- <span class="float-right text-muted text-sm">3 mins</span> --}}
              </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-sign-out mr-2"></i> Settings
                    {{-- <span class="float-right text-muted text-sm">12 hours</span> --}}
                </a>
                               
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">Log Out</a>
            </div>
        </li>
       
    </ul>
</nav>
<!-- /.navbar -->