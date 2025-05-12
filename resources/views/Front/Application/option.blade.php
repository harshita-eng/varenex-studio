@extends('Front.layout.front_layout')
@section('content')

<div class="page-title" style="border-top: 1px solid color-mix(in srgb, var(--accent-color), transparent 85%);"></div>
    
<section id="values" class="values section">
  <div class="container section-title" data-aos="fade-up">
    <!-- <h2>Our Values</h2> -->
    <p>Create New Application<br></p>
  </div>
  <div class="container">
    <div class="row gy-4">

    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
      <div class="card text-center shadow-sm p-4 border rounded-4"></br>
        <!-- <img src="{{ asset('assets/front/img/import.jpg') }}" alt="Import Icon"> -->
        <h5 class="fw-semibold">Create from scratch</h5>
        <p class="text-muted small">Create application for your new business needs</p>
        <div class="d-flex justify-content-center gap-2 mt-3">
          <!-- <button class="btn btn-outline-secondary btn-sm px-3">Learn</button> -->
          <a href="{{ route('showform', 'scratch') }}" class="btn btn-primary btn-sm px-3">Create</a>
        </div>  
      </div>
    </div>

    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
      <div class="card text-center shadow-sm p-4 border rounded-4"></br>
        <!-- <img src="{{ asset('assets/front/img/gallery.jpg') }}" alt="Import Icon"> -->
        <h5 class="fw-semibold">Create from gallery</h5>
        <p class="text-muted small">Pick a pre-built application for your busniess</p>
        <div class="d-flex justify-content-center gap-2 mt-3">
          <!-- <button class="btn btn-outline-secondary btn-sm px-3">Learn</button> -->
          <a href="{{ route('showform', 'existing') }}" class="btn btn-primary btn-sm px-3">Pick</a>
        </div>  
      </div>
    </div>

    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
      <div class="card text-center shadow-sm p-4 border rounded-4"></br>
        <!-- <img src="{{ asset('assets/front/img/import.jpg') }}" alt="Import Icon"> -->
        <h5 class="fw-semibold">Import from file</h5>
        <p class="text-muted small">Import your existing data to create an application</p>
        <div class="d-flex justify-content-center gap-2 mt-3">
          <!-- <button class="btn btn-outline-secondary btn-sm px-3">Learn</button> -->
          <a href="{{ route('showform', 'existing') }}" class="btn btn-primary btn-sm px-3">Import</a>
        </div>  
      </div>
    </div>
    </div>
  </div>
</section>
@endsection




