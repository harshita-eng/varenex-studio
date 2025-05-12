
<header id="header" class="header d-flex align-items-center fixed-top" style="border-top: 1px solid color-mix(in srgb, var(--accent-color), transparent 85%);">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">
    <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
      <img src="{{ asset('assets/front/img/VARENYA EX.png') }}" alt="">
      <h1 class="sitename"><strong>Studio</strong></h1>
    </a>
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="{{ route('home') }}" class="active">Home<br></a></li>
        <li><a href="{{ route('about') }}">About</a></li>
        <li><a href="{{ route('service') }}">Features</a></li>
        <li><a href="{{ route('pricing') }}">Pricing</a></li>
        <li><a href="{{ route('contactus') }}">Contact</a></li>
        <li class="dropdown">
          <a href="#"><span>Pages</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a href="{{ route('faqs') }}">FAQS</a></li>
            <li><a href="{{ route('testimonials') }}">Testimonials</a></li>
          </ul>
        </li>
        @if(Auth::check())
        <li class="dropdown">
          <a href="#"><span class="user-info">{{ ucwords(Auth::user()->name) }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a href="{{ route('userdashboard') }}">Account Settings</a></li>
            <li><a href="{{ route('logout') }}">Logout</a></li>
          </ul>
        </li>
        @endif
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
    @if(!Auth::check())
      <a class="btn-getstarted flex-md-shrink-0" href="{{ route('login') }}">Get Started</a>
    @endif
  </div>
</header>
