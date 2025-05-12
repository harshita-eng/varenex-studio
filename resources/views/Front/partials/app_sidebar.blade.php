<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}" target="_blank">
    <h6>VarenyaEx Studio</h6></br>
  </a>
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="" style="white-space: nowrap;">
    <div class="sidebar-brand-text mx-3" style="font-size: 11px;margin-top: -95px;"> {{ str_replace("_", " ", $appname) }} </div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  @if(count($tables) > 0) 
    @foreach($tables as $tab)
    <li class="nav-item active">
      <a class="nav-link" href="{{ route('tablelisting', [$tab->table_name,$appname]) }}">
        <i class="fas fa-fw fa-bars"></i>
        <span>{{ ucfirst($tab->table_name) }}</span>
      </a>
    </li>
    @endforeach 
  @endif

  <li class="nav-item active">
    <a class="nav-link" href="{{ route('appsettings', $appname) }}">
      <i class="fas fa-fw fa-cogs"></i>
      <span>Settings</span>
    </a>
  </li>

  <li class="nav-item active">
    <a class="nav-link" href="">
      <i class="fas fa-lock"></i>
      <span>Logout</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">
</ul>
<!-- End of Sidebar -->