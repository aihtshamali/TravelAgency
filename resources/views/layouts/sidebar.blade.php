<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('welcome')}}" class="brand-link">
    <img src="/img/logo.png" alt="{{env('APP_NAME')}}" class="brand-image img-circle elevation-3"
   style="opacity: .8">
<span class="brand-text font-weight-light">{{env('APP_NAME')}}</span>
</a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{isset(Auth::user()->UserDetail->profile_pic) ? asset('storage/attachments/'.Auth::id().'/'.Auth::user()->UserDetail->profile_pic) :'/img/profile.png'}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('User.show',Auth::id())}}" class="d-block"> {{auth()->user()->name!=null ? auth()->user()->name : "Guest"}} </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview {!! classActivePath(1,'dashboard') !!}">
                    <a  class="nav-link {!! classActiveSegment(1, 'dashboard') !!}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Customer
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('Customer.index') }}" class="nav-link {!! classActiveSegment(2, 'home') !!}">
                  
                    <p>Search Customer</p>
                  </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('Customer.create') }}" class="nav-link {!! classActiveSegment(2, 'v2') !!}">
                   
                    <p>Add New Customer</p>
                  </a>
                        </li>
                        
                    </ul>
                </li>
                
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                <i class="nav-icon fas fa-coins"></i>
                <p>
                  Leads
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('myLeads')}}" class="nav-link">
                    
                    <p>My Leads</p>
                  </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('AvailableLeads')}}" class="nav-link">
                    
                    <p>Available Leads</p>
                  </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('lead_searchByID')}}" class="nav-link">
                    
                    <p>View Lead by ID</p>
                  </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('leads.searchPhone')}}" class="nav-link">
                    
                    <p>Create New Lead</p>
                  </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                <i class="nav-icon fas fa-search"></i>
                <p>
                  Transaction Seach
                  <i class="fa fa-angle-left right"></i>
                </p>
              </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('viewSaleByID') }}" class="nav-link">
                    
                    <p>Posting ID</p>
                  </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('viewPaymentByID') }}" class="nav-link">
                    
                    <p>Payment ID</p>
                  </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('viewDocumentByID') }}" class="nav-link">
                    
                    <p>Document Number</p>
                  </a>
                        </li>
                    </ul>
                  </li>
                     
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    My Reports
                    <i class="fa fa-angle-left right"></i>
                  </p>
                </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{route('mytransactions')}}" class="nav-link">
                      
                      <p>My Transactions</p>
                    </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{route('FinalizedLeads')}}" class="nav-link">
                      
                      <p>My Finalized Leads</p>
                    </a>
                          </li>
                      
                  <li class="nav-item">
                      <a href="{{route('saleReport')}}" class="nav-link">
              
              <p>My Sale Report</p>
            </a>
                  </li>
                  
                  
              </ul>
              </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Manager Reports
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/tables/simple.html" class="nav-link">
                
                <p>All Working Leads</p>
              </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('viewPendingPayments') }}" class="nav-link">
                
                <p>Pending Payments</p>
              </a>
                    </li>
                
            <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
        
        <p>User Performance</p>
      </a>
            </li>
            <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
        
        <p>Lead Report</p>
      </a>
            </li>
            <li class="nav-item">
                <a href="{{route('saleReport',1)}}" class="nav-link">
        
        <p>Sale Report</p>
      </a>
            </li>
        </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-coins"></i>
        <p>
          Authorize Transactions
          
        </p>
      </a>
        </li>
        <li class="nav-item has-treeview {!! classActivePath(1,'dashboard') !!}">
            <a  class="nav-link {!! classActiveSegment(1, 'dashboard') !!}">
        <i class="nav-icon fas fa-cog"></i>
        <p>
          Settings
          <i class="right fa fa-angle-left"></i>
        </p>
      </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('Customer.index') }}" class="nav-link {!! classActiveSegment(2, 'home') !!}">
            
            <p>Users & Branches</p>
          </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('Customer.create') }}" class="nav-link {!! classActiveSegment(2, 'v2') !!}">
            
            <p>Notifications</p>
          </a>
                </li>
                
            </ul>
        </li>    
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>