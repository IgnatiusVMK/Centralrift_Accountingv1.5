<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href={{ route('dashboard')}}>
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <!--Users & Roles-->
          <li class="nav-item nav-category">Users & Roles</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
              <i class="menu-icon mdi mdi mdi-security"></i>
              <span class="menu-title">Manage Users</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="users">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ ('/role')}}">Users</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ ('/departments')}}">Departments</a></li>
              </ul>
            </div>
          </li>
          <!--Master-->
          <li class="nav-item nav-category">Master</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#master" aria-expanded="false" aria-controls="master">
              <i class="menu-icon mdi mdi-apps"></i>
              <span class="menu-title">Master Operations</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="master">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{('/customers')}}">Customers</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{('/suppliers')}}">Suppliers</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{('/credit')}}">Creditors</a></li>
              </ul>
            </div>
          </li>
          <!--Cycles-->
          <li class="nav-item nav-category">Cycles</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#cycles" aria-expanded="false" aria-controls="cycles">
              <i class="menu-icon mdi mdi-calendar-clock"></i>
              <span class="menu-title">Planting Cycles</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="cycles">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ ('/planting-cycles')}}">All Cycles</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{-- {{ ('/financials/expenditures')}} --}}">New Cycle</a></li>
              </ul>
            </div>
          </li>
          <!--Finance-->
          <li class="nav-item nav-category">Expenses</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#finance" aria-expanded="false" aria-controls="finance">
              <i class="menu-icon mdi mdi-cash-multiple"></i>
              <span class="menu-title">Monthly Expenses</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="finance">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ ('/finances')}}">Finances</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ ('/financials/expenditures')}}">Daily Expenditures</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ ('/financials/salaries')}}">Salaries</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ ('/financials/advance')}}">Advances</a></li>
              </ul>
            </div>
          </li>
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
          <li class="nav-item nav-category">Purchase</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#purchases" aria-expanded="false" aria-controls="purchases">
              <i class="menu-icon mdi mdi-cart-plus"></i>
              <span class="menu-title">Purchases</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="purchases">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="#">Purchase Orders</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Purchase Invoice</a></li>
              </ul>
            </div>
          </li>
          <!--Sales-->
          <li class="nav-item nav-category">Sales</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#sales" aria-expanded="false" aria-controls="sales">
              <i class="menu-icon mdi mdi-square-inc-cash"></i>
              <span class="menu-title">Sales</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="sales">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="#">Sales Orders</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Sales Invoice</a></li>
              </ul>
            </div>
          </li>
          <!--Financial Statements-->
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
          <!--Reports-->
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
          <!--Profile-->
          <li class="nav-item nav-category">PROFILE</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-settings"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="#"> Login </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item nav-category">Contact Support</li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="menu-icon mdi mdi-help"></i>
              <span class="menu-title">Support</span>
            </a>
          </li>
        </ul>
      </nav>