<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto" style="text-decoration:none; color:black;">
      <img src="{{ asset('assets/front/img/VARENYA EX.png') }}" alt="" width="133px" style="    margin-bottom:-2px;margin-left: 25px;">&nbsp;&nbsp;
      <h5 class="sitename" style="font-size: 19px;"> Studio </h5>
    </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item">
              <a class="nav-link" href="{{ route('option') }}" style="color:black;">
                <div class="nav-profile-img">
                    <h4> <i class="mdi mdi-tablet-android"></i> CREATE APPLICATION </h4>
                    <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                    <p class="mb-1 text-black"></p>
                </div>
              </a>
          </li>
          <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                    {{ ucwords(Auth::user()->name) }}
                </div>
                <div class="nav-profile-text">
                    <p class="mb-1 text-black"></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{ route('userdashboard') }}">
                <i class="mdi mdi-cached me-2 text-success"></i> Settings </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}">
                <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
              </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
        </button>
    </div>
  </nav>

  