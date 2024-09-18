<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css">


<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href={{ route('dashboard')}}>
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <!--Users & Roles-->
          @can('access-users')
          <li class="nav-item nav-category">Users & Roles</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
              <i class="menu-icon mdi mdi-security"></i>
              <span class="menu-title">Manage Users</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="users">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{('/users')}}">Users</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{('/departments')}}">Departments</a></li>
                @can('access-roles')
                  <li class="nav-item"> <a class="nav-link" href="{{('/roles')}}">Roles</a></li>
                @endcan
                @can('access-permissions')
                  <li class="nav-item"> <a class="nav-link" href="{{('/permissions')}}">Permissions</a></li>
                @endcan
                <li class="nav-item"> <a class="nav-link" href="{{-- {{('/password-reset')}} --}}">Password Reset</a></li>
              </ul>
            </div>
          </li>
          @endcan
          <!--Master-->
          @can('access-master')
          <li class="nav-item nav-category">Master</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#master" aria-expanded="false" aria-controls="master">
              <i class="menu-icon mdi mdi-apps"></i>
              <span class="menu-title">Master Operations</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="master">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{('/suppliers')}}">Suppliers</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{('/credit')}}">Credit</a></li>
              </ul>
            </div>
          </li>
          @endcan
          <!--Customers-->
          @can('access-customers')
          <li class="nav-item nav-category">Customers</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#customers" aria-expanded="false" aria-controls="customers">
              <i class="menu-icon mdi mdi-briefcase-account"></i>
              <span class="menu-title">Customers</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="customers">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{('/customers')}}">Customers</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{-- {{('/suppliers')}} --}}">Sales Person</a></li>
              </ul>
            </div>
          </li>
          @endcan
          <!--Cycles-->
          @can('access-cycles')
          <li class="nav-item nav-category">Cycles</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#cycles" aria-expanded="false" aria-controls="cycles">
                <i class="menu-icon mdi mdi-calendar-clock"></i>
                <span class="menu-title">Planting Cycles</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="cycles">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('cycles') }}">All Cycles</a></li>
                @can('create-cycles')
                <li class="nav-item"> <a class="nav-link" href="{{ route('cycle.create') }}">New Cycles</a></li>
                @endcan    
              </ul>
            </div>
          </li>
          @endcan
          <!--Checker-->
          @can('access-approval')
          <li class="nav-item nav-category">Checker Validation</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#checker" aria-expanded="false" aria-controls="checker">
              <i class="menu-icon mdi {{-- mdi-folder-plus --}} mdi-playlist-plus"></i>
              <span class="menu-title">Approvals</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="checker">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{('/checker')}}">Pending Approvals</a></li>
              </ul>
            </div>
          </li>
          @endcan
          <!--Maker-->
          @can('access-maker')
          <li class="nav-item nav-category">Maker Requests</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#maker" aria-expanded="false" aria-controls="maker">
              <i class="menu-icon mdi {{-- mdi-folder-remove --}} mdi-playlist-remove"></i>
              <span class="menu-title">Requests</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="maker">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{('/maker')}}">Awaiting Approval</a></li>
              </ul>
            </div>
          </li>
          @endcan
          <!--Finance-->
          @can('access-finance')
          <li class="nav-item nav-category">Expenses</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#finance" aria-expanded="false" aria-controls="finance">
              <i class="menu-icon mdi mdi-cash-multiple"></i>
              <span class="menu-title">Monthly Expenses</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="finance">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ ('/financials/expenditures')}}">Daily Expenditures</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ ('/financials/salaries')}}">Salaries</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ ('/financials/advance')}}">Advances</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ ('/financials/transport')}}">Transport</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ ('/capital-expenses')}}">Capital Expenses</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ ('/capital-withdrawal')}}">Capital Withdrawal</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ ('/electricity')}}">Electricity</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ ('/financials/maintenance')}}">Maintenance</a></li>
              </ul>
            </div>
          </li>
          @endcan
          <!--Products & Services-->
          <li class="nav-item nav-category">Products & Services</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#products-services" aria-expanded="false" aria-controls="products-services">
              <i class="menu-icon mdi mdi-flower"></i>
              <span class="menu-title">Products</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="products-services">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ ('/products')}}">Products</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ ('/products-categories')}}">Products Categories</a></li>
              </ul>
            </div>
          </li>
          <!--Purchases-->
          @can('access-purchases')
          <li class="nav-item nav-category">Purchase</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#purchases" aria-expanded="false" aria-controls="purchases">
              <i class="menu-icon mdi mdi-cart-plus"></i>
              <span class="menu-title">Purchases</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="purchases">
              <ul class="nav flex-column sub-menu">
                {{-- <li class="nav-item"> <a class="nav-link" href="#">Purchase Orders</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Purchase Invoice</a></li> --}}
                <li class="nav-item"> <a class="nav-link" href="#">Chemicals</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Seeds</a></li>
              </ul>
            </div>
          </li>
          @endcan
          <!--Sales-->
          @can('access-sales')
          <li class="nav-item nav-category">Sales</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#sales" aria-expanded="false" aria-controls="sales">
              <i class="menu-icon mdi mdi-store"></i>
              <span class="menu-title">Sales</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="sales">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ ('/sales')}}">Sales</a></li>
                {{-- <li class="nav-item"> <a class="nav-link" href="#">Sales Invoice</a></li> --}}
              </ul>
            </div>
          </li>
          @endcan
          <!--Financial Statements-->
          @can('access-financials')
          <li class="nav-item nav-category">Financial Statements</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#financial-statements" aria-expanded="false" aria-controls="financial-statements">
              <i class="menu-icon mdi mdi-factory"></i>
              <span class="menu-title">Financials</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="financial-statements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ ('/cashbook')}}">Cash Book</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ ('/profit-loss')}}">Profit & Loss</a></li>
              </ul>
            </div>
          </li>
          @endcan
          <!--Reports-->
          @can('access-reports')
          <li class="nav-item nav-category">Generate Reports</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="reports">
              <i class="menu-icon mdi mdi-file-chart"></i>
              <span class="menu-title">Reports</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="reports">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="#">Account Ledger</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Expenditure Reports</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Purchase Reports</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Sales Reports</a></li>
              </ul>
            </div>
          </li>
          @endcan
          <!--Profile-->
          <li class="nav-item nav-category">PROFILE</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-network-outline"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="#"> User Profile </a></li>
                <li class="nav-item"> 
                  <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </li>              
              </ul>
            </div>
          </li>
          <!-- Maintenance-->
          @can('access-maintenance')
          <li class="nav-item nav-category">System Maintenance</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#maintenance" aria-expanded="false" aria-controls="maintenance">
              <i class="menu-icon mdi mdi-cog-sync-outline"></i>
              <span class="menu-title">Maintenance</span>
              <i class="menu-arrow"></i>
            </a>
            @can('create-maintenance')
            <div class="collapse" id="maintenance">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/system-maintenance">Maintenance Mode</a></li>
              </ul>
            </div>
            @endcan
          </li>
          @endcan

          <!--Contact Support-->
          <li class="nav-item nav-category">Contact Support</li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="menu-icon mdi mdi-help"></i>
              <span class="menu-title">Support</span>
            </a>
          </li>
        </ul>
      </nav>