<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item navbar-brand-mini-wrapper">
      <a class="nav-link navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
    </li></br>
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="profile-image">
          <img class="img-xs rounded-circle" src="{{ asset($logo) }}" alt="profile image">
          <div class="dot-indicator bg-success"></div>
        </div>
        <div class="text-wrapper">
          <p class="profile-name">{{ str_replace("_", " ", strtoupper($appname)) }}</p>
          <p class="designation">{{ Auth::user()->name}}</p>
        </div>
        <!-- <div class="icon-container">
          <i class="icon-bubbles"></i>
          <div class="dot-indicator bg-danger"></div>
        </div> -->
      </a>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Menus</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('appdashboard', $appname) }}">
        <span class="menu-title">Dashboard</span>
        <i class="icon-home menu-icon"></i>
      </a>
    </li>
    @if(count($tableList) > 0) 
      @foreach($tableList as $tab)
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#{{ $tab->table_name }}" aria-expanded="false" aria-controls="tables">
            <span class="menu-title">{{ str_replace("_", " ", ucfirst($tab->table_name)) }}</span>
            <i class="icon-grid menu-icon"></i>
          </a>
          <div class="collapse" id="{{ $tab->table_name }}">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('tablelisting', [$tab->table_name,$appname]) }}">{{ str_replace("_", " ", ucfirst($tab->table_name)) }} List</a></li>
            </ul>
          </div>
        </li>
      @endforeach 
    @endif
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#account" aria-expanded="false" aria-controls="tables">
        <span class="menu-title">Account Settings</span>
        <i class="icon-grid menu-icon"></i>
      </a>
      <div class="collapse" id="account">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic Table</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#template" aria-expanded="false" aria-controls="tables">
        <span class="menu-title">Template Settings</span>
        <i class="icon-grid menu-icon"></i>
      </a>
      <div class="collapse" id="template">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Template Theme</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Layout</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Color Theme</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Dashboard Settings</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>