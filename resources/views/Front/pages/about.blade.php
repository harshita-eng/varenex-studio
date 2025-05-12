@extends('Front.layout.front_layout')
@section('content')
    
<section id="starter-section" class="starter-section section">
  <div class="container section-title" data-aos="fade-up">
    <p>Extended Section Title</p>
  </div>
  <div class="container" data-aos="fade-up">
    <p>Use this page as a starter for your own custom pages.</p>
  </div>
</section>

<section id="about" class="about section">
   <div class="container" data-aos="fade-up">
      <div class="row gx-0">
         <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
            <h3>Who We Are</h3>
            <h2>Expedita voluptas omnis cupiditate totam eveniet nobis sint iste. Dolores est repellat corrupti reprehenderit.</h2>
            <p>
               Quisquam vel ut sint cum eos hic dolores aperiam. Sed deserunt et. Inventore et et dolor consequatur itaque ut voluptate sed et. Magnam nam ipsum tenetur suscipit voluptatum nam et est corrupti.
            </p>
            <div class="text-center text-lg-start">
               <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Read More</span>
                  <i class="bi bi-arrow-right"></i>
               </a>
            </div>
            </div>
         </div>
         <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="{{ asset('assets/front/img/about.jpg') }}" class="img-fluid" alt="">
         </div>
      </div>
   </div>
</section>

@endsection