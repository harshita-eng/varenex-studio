@extends('Front.layout.dashboard-layout')
@section('content')
  <div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('assets/user-dashboard/images/faces/face1.jpg') }}" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2" style="font-size: 15px;">{{ ucwords(Auth::user()->name) }}</span>
                    <!-- <span class="text-secondary text-small">User</span> -->
                </div>
                <!-- <i class="mdi mdi-bookmark-check text-info nav-profile-badge"></i> -->
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('userdashboard') }}">
              <span class="menu-title"> Dashboard </span>
              <i class="mdi mdi-home menu-icon"></i>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="">
              <span class="menu-title"> Settings </span>
              <i class="mdi mdi-cogs menu-icon"></i>
              </a>
          </li>
        </ul>
    </nav> 

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          @if(Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
          @endif
          <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white me-2">
                <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard /</li>
                </ol>
              </nav>
          </div>
          <div class="row">
              @if(count($applications) > 0)
              @foreach($applications as $app)
              @php $appName = str_replace(" ","_",$app->name); @endphp
              <!-- <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                      <a href="{{ route('appdashboard', $appName) }}" target="_blank" style="text-decoration:none; color:white;">
                          <img src="{{ asset('assets/user-dashboard/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image">
                          <h4 class="font-weight-normal mb-3">
                          </h4>
                          <h4 class="mb-2"><i class="mdi mdi-tablet-android"></i> {{ ucfirst($app->name) }} </h4>
                          <h5 class="mb-2">Created on {{ date("M d, Y")  }}</h5>
                          <h6 class="card-text"> <i class="mdi mdi-menu"></i> Application  /  
                      </a>
                      <a style="text-decoration:none; color:white;" href="#"> Edit </a></h6>
                    </div>
                </div>
              </div> -->

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                  <!-- Card -->
                  <div class="bg-gray-50 border border-gray-200 shadow-sm rounded-xl p-4 relative">
                    
                    <!-- Header -->
                    <div class="flex justify-between items-start">
                      <div class="flex items-center space-x-3">
                        <!-- Initials -->
                        <div class="bg-blue-100 text-blue-600 font-semibold rounded-full border border-blue-300 px-3 py-1 text-sm">
                          APP
                        </div>
                        <!-- Title -->
                        <h2 class="text-lg text-gray-800">{{ ucfirst($app->name) }}</h2>
                      </div>

                      <!-- Dropdown -->
                      <div class="relative group">
                        <button class="text-gray-500 hover:text-gray-700">⋮</button>
                        <div class="absolute right-0 mt-2 w-28 bg-white border rounded shadow-md hidden group-hover:block z-10">
                          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="mdi mdi-disable menu-icon"></i>Disable</a>
                          <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100"><i class="mdi mdi-trash-can menu-icon"></i> Delete</a>
                        </div>
                      </div>
                    </div>

                    <!-- Created date -->
                    <p class="text-sm text-gray-500 mt-2">Created on: {{ date("M d, Y", strtotime($app->created_at))  }}</p>

                    <!-- Footer -->
                    <div class="flex justify-between items-center mt-6">
                      <span class="text-sm text-gray-500 flex items-center space-x-1">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path d="M8 16h8M8 12h8m-4-4h4M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span><a href="{{ route('appdashboard', $appName) }}" target="_blank">Application</a></span>
                      </span>
                      <a href="#" class="text-sm text-blue-600 font-medium hover:underline flex items-center space-x-1">
                        <!-- <span>More</span>  -->
                        <span><i class="mdi mdi-pencil menu-icon"></i> Edit</span>
                        <!-- <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M5.23 7.21a.75.75 0 011.06-.02L10 10.677l3.71-3.49a.75.75 0 111.04 1.08l-4.25 4a.75.75 0 01-1.04 0l-4.25-4a.75.75 0 01-.02-1.06z"/>
                        </svg> -->
                      </a>
                    </div>
                  </div>
                </div>
              @endforeach 
              @endif
          </div>
        </div>
    </div>
  </div>
@endsection
<script src="https://cdn.tailwindcss.com"></script>