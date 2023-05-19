<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="#">Double Six</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">DS</a>
      </div>
      <ul class="sidebar-menu">        
        @if (auth()->user()->is_admin == 1)
          {{-- <li class="menu-header">Dashboard</li>
          
          <li><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li> --}}

          <li class="menu-header">Master</li>
          <li class="nav-item dropdown {{ ($active === "Master Data") ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-fire"></i> <span>Master Data</span></a>
            <ul class="dropdown-menu">
              <li class="{{ ($section === "User") ? 'active' : '' }}"><a class="nav-link" href="{{ route('master.user') }}">User</a></li>
              <li class="{{ ($section === "Department") ? 'active' : '' }}"><a class="nav-link" href="{{ route('master.department') }}">Department</a></li>
              <li class="{{ ($section === "Position") ? 'active' : '' }}"><a class="nav-link" href="{{ route('master.position') }}">Position</a></li>
              <li class="{{ ($section === "Location") ? 'active' : '' }}"><a class="nav-link" href="{{ route('master.location') }}">Location</a></li>
            </ul>
          </li>
          
          <li class="menu-header">Work Order</li>
          <li class="nav-item dropdown {{ ($active === "Work Order") ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Work Order</span></a>
            <ul class="dropdown-menu">
              <li class="{{ ($section === "Category") ? 'active' : '' }}"><a class="nav-link" href="{{ route('work.category') }}">Category</a></li>
              <li class="{{ ($section === "Request") ? 'active' : '' }}"><a class="nav-link" href="{{ route('wo.request') }}">Request</a></li>
              <li class="{{ ($section === "Received") ? 'active' : '' }}"><a class="nav-link" href="{{ route('wo.received') }}">Received</a></li>
            </ul>
          </li>
          <li class="{{ ($section === "Report") ? 'active' : '' }}"><a class="nav-link" href="{{ route('wo.report') }}"><i class="fas fa-pencil-ruler"></i> <span>Report</span></a></li>
         
          @else
         
          <li class="menu-header">Work Order</li>
          <li class="{{ ($section === "Received") ? 'active' : '' }}"><a class="nav-link" href="{{ route('wo.received') }}"><i class="fas fa-pencil-ruler"></i> <span>Received</span></a></li>
          <li class="{{ ($section === "Request") ? 'active' : '' }}"><a class="nav-link" href="{{ route('wo.request') }}"><i class="fas fa-pencil-ruler"></i> <span>Request</span></a></li>
              
          @endif
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
          <a href="{{ route('logout') }}" class="btn btn-danger btn-lg btn-block btn-icon-split" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
    </aside>
  </div>