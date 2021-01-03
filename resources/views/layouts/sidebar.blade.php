<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">PASOTRACE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->f_name }} {{ Auth::user()->l_name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li> --}}
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ (Route::current()->getName() == 'home' ? 'active' : '') }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard 
              </p>
            </a>
          </li>
          @if(Auth::user()->user_level == '0' || Auth::user()->user_level == '1') 
          <li class="nav-item">
            <a href="#" class="nav-link {{ (Route::current()->getName() == 'clients.index' ? 'active' : '') }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                My Sections
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Scan Logs
              </p>
            </a>
          </li>

          <li class="nav-item">
           <a href="{{ route('scan.index') }}" class="nav-link {{ (Route::current()->getName() == 'scan.index' ? 'active' : '') }}">
              <i class="nav-icon fas fa-list"></i>
              <p>
               Scan for attendance
              </p>
            </a>
          </li>

          <li class="nav-header">Reports</li>

          <li class="nav-item">
             <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Scan Report
              </p>
            </a>
          </li>

          @endif
          @if(Auth::user()->user_level == '0')
          <li class="nav-header">Application Manager</li>

          <li class="nav-item">
             <a href="{{ route('users.index') }}" class="nav-link {{ (Route::current()->getName() == 'users.index' ? 'active' : '') }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>


          <li class="nav-header">Masterfile Setup</li>

          <li class="nav-item">
            <a href="{{ route('grade.index') }}" class="nav-link {{ (Route::current()->getName() == 'grade.index' ? 'active' : '') }}">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Grade Level
              </p>
            </a>
          </li>

          <li class="nav-item">
             <a href="{{ route('section.index') }}" class="nav-link {{ (Route::current()->getName() == 'section.index' ? 'active' : '') }}">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Section
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Students
              </p>
            </a>
          </li>


          @endif
          <li class="nav-header">Account Manager</li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                My Profile
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Log Out
              </p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>

        </ul>   

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>