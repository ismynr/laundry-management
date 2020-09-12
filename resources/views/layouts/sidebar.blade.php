<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile">
            <span class="login-status online"></span>
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">{{ ucfirst(Auth::user()->role) }}</span>
            <span class="text-secondary text-small">{{ __("Online") }}</span>
          </div>
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>

      @if(Auth::user()->isAdmin())

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-user" aria-expanded="false" aria-controls="ui-user">
          <span class="menu-title">User</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-crosshairs-gps menu-icon"></i>
        </a>
        <div class="collapse" id="ui-user">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.users.index') }}">Admin</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.users.indexKaryawan') }}">Karyawan</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-pack" aria-expanded="false" aria-controls="ui-pack">
          <span class="menu-title">Package</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-crosshairs-gps menu-icon"></i>
        </a>
        <div class="collapse" id="ui-pack">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.packages.index') }} ">Packages</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.services.index')}} ">Services</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-expanses" aria-expanded="false" aria-controls="ui-expanses">
          <span class="menu-title">Expanses</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-contacts menu-icon"></i>
        </a>
        <div class="collapse" id="ui-expanses">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.expanses.indexOwner') }} ">Your Expanses</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.expanses.index')}} ">All Expanses</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.customers.index') }}">
          <span class="menu-title">Customers</span>
          <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.transactions.index') }}">
          <span class="menu-title">Transaction</span>
          <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        </a>
      </li>
      <li class="nav-item sidebar-actions">
        <a href="{{ route('admin.transactions.create') }}" class="btn btn-block btn-md btn-gradient-primary mt-1">
          <i class="mdi mdi-plus-circle menu-icon"></i> Transaction
        </a>
      </li>

      @elseif(Auth::user()->isKaryawan())

      <li class="nav-item">
        <a class="nav-link" href="pages/icons/mdi.html">
          <span class="menu-title">Expanses</span>
          <i class="mdi mdi-contacts menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/forms/basic_elements.html">
          <span class="menu-title">Transaction</span>
          <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        </a>
      </li>
      <li class="nav-item sidebar-actions">
        <button class="btn btn-block btn-md btn-gradient-primary mt-1"><i class="mdi mdi-plus-circle menu-icon"></i> Transaction</button>
      </li>

      @endif
      
    </ul>
  </nav>