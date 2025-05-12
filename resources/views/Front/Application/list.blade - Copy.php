@extends('Front.layout.application-layout')
@section('content')
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="" href="">
                        <span class="">Owned By {{ ucwords(Auth::user()->name) }} </span>
                    </a>
                </li>

                <!-- <li class="nav-item dropdown no-arrow mx-1">
                    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="">
                        <span class=""> Set Preferences </span>
                    </a>
                </li> -->
            </ul>
        </nav>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{ ucfirst($table) }}</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-plus fa-sm text-white-50"></i> Add {{ $table }} </a>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                @if(count($columns) > 0)
                                <tr>
                                    @foreach($columns as $col)
                                        <th>{{ ucfirst($col->COLUMN_NAME) }}</th>
                                    @endforeach
                                </tr>
                                @endif
                            </thead>
                            <tfoot>
                                @if(count($columns) > 0)
                                <tr>
                                    @foreach($columns as $col)
                                        <th>{{ $col->COLUMN_NAME }}</th>
                                    @endforeach
                                </tr>
                                @endif
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>            
    </div>
@endsection