@extends('Front.layout.application-layout')
@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="" href="">
                        <span class=""> VarneXStudio Admin </span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Content Row -->
            <div class="row">
                <div class="col-lg-12">
                    <form class="user" method="POST" action="">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="vendoe_code" >Code</label>
                            <input type="text" class="form-control form-control-user" name="vendor_code" placeholder="Vendor Code" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="vendoe_code">Name</label>
                            <input type="text" class="form-control form-control-user"
                                name="vendor_name" placeholder="Vendor Name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="vendoe_address">Address </label>
                            <input type="text" class="form-control form-control-user" name="vendor_address"  placeholder="Vendor Address">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="vendoe_city"> City </label>
                            <input type="text" class="form-control form-control-user"
                                placeholder="Vendor City" name="vendor_city">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="vendoe_state"> State </label>
                            <input type="text" class="form-control form-control-user" placeholder="Vnedor State" name="vendor_state">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="vendor_contact"> Contact </label>
                            <input type="number" class="form-control form-control-user" placeholder="Vendor Contact" name="vendor_contact">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="vendor_contact" >GST Number </label>
                            <input type="number" class="form-control form-control-user" placeholder="GST Number" name="gst_number">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="vendor_contact" >GST Number </label>
                            <input type="number" class="form-control form-control-user" placeholder="GST Number" name="gst_number">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="vendor_contact" >GST Number </label>
                            <input type="number" class="form-control form-control-user" placeholder="GST Number" name="gst_number">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="vendor_contact" >GST Number </label>
                            <input type="number" class="form-control form-control-user" placeholder="GST Number" name="gst_number">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="vendor_contact" >GST Number </label>
                            <input type="number" class="form-control form-control-user" placeholder="GST Number" name="gst_number">
                        </div>
                    </div>
                    <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> Submit </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection