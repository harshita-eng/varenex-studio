@extends('Front.layout.front_layout')
@section('content')

<!-- Hero Section -->
<section id="hero" class="hero section">
   <div class="container">
      @include('Front.partials.flash_message')
      <div class="row gy-4">
         <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">Build powerful onboarding flows and custom apps — all without writing code</h1>
            <p data-aos="fade-up" data-aos-delay="100">Empowering startups and innovators to build robust applications—no coding required</p>
            <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
               <a href="{{ route('option') }}" class="btn-get-started">Get Started<i class="bi bi-arrow-right"></i></a>
            </div>
         </div>
         <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="{{ asset('assets/front/img/hero-img.png') }}" class="img-fluid animated" alt="">
         </div>
      </div>
   </div>
</section>
<!-- /Hero Section -->

<!-- About Section -->
<!-- <section id="about" class="about section">
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
</section> -->
<!-- /About Section -->

<!-- Features Section -->
<section id="features" class="features section" style="margin-top: -116px;">
   <div class="container section-title" data-aos="fade-up">
      <p>Our Advacedd Features<br></p>
   </div>
   <div class="container">
      <div class="row gy-5">
         <div class="col-xl-6" data-aos="zoom-out" data-aos-delay="100">
            <img src="{{ asset('assets/front/img/details-2.png') }}" class="img-fluid" alt="">
         </div>
         <div class="col-xl-6 d-flex">
            <div class="row align-self-center gy-4">
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
               <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Drag-and-drop onboarding flow designer</h3>
               </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
               <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Multi-step forms with conditional logic</h3>
               </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
               <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Role-based onboarding templates (HR, IT, Finance, etc.)</h3>
               </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
               <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Automated user provisioning (departments, roles, permissions)</h3>
               </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
               <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Logic blocks for automation (if/else, triggers, actions)</h3>
               </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="700">
               <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Database schema design with ER diagram editor</h3>
               </div>
            </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- /Features Section -->

<!-- Alt Features Section -->
<section id="alt-features" class="alt-features section">
   <div class="container">
      <div class="row gy-5">
         <div class="col-xl-7 d-flex order-2 order-xl-1" data-aos="fade-up" data-aos-delay="200">
            <div class="row align-self-center gy-5">
            <div class="col-md-6 icon-box">
               <i class="bi bi-award"></i>
               <div>
                  <h4>Onboarding Builder</h4>
                  <p>Design onboarding flows, build apps, manage users, and automate—all without code.</p>
               </div>
            </div>

            <div class="col-md-6 icon-box">
               <i class="bi bi-card-checklist"></i>
               <div>
                  <h4>App Builder</h4>
                  <p>Visually build custom apps with forms, workflows, and data—no coding needed</p>
               </div>
            </div>

            <div class="col-md-6 icon-box">
               <i class="bi bi-dribbble"></i>
               <div>
                  <h4>User Management & Access Control</h4>
                  <p>Control user roles, permissions, and access with ease.</p>
               </div>
            </div>

            <div class="col-md-6 icon-box">
               <i class="bi bi-filter-circle"></i>
               <div>
                  <h4>Analytics & Reports</h4>
                  <p>Track insights and generate reports instantly.</p>
               </div>
            </div>

            <div class="col-md-6 icon-box">
               <i class="bi bi-lightning-charge"></i>
               <div>
                  <h4>Integrations</h4>
                  <p>Connect seamlessly with your favorite tools.</p>
               </div>
            </div>

            <div class="col-md-6 icon-box">
               <i class="bi bi-patch-check"></i>
               <div>
                  <h4>Developer Tools (Optional for Power Users)
                  </h4>
                  <p>Extend with custom code and advanced developer tools.</p>
               </div>
            </div>
            </div>
         </div>
         <div class="col-xl-5 d-flex align-items-center order-1 order-xl-2" data-aos="fade-up" data-aos-delay="100">
            <img src="{{ asset('assets/front/img/details-1.png') }}" class="img-fluid" alt="">
         </div>
      </div>
   </div>
</section>
<!-- /Alt Features Section -->

<!-- Services Section -->
<!-- <section id="services" class="services section">
   <div class="container section-title" data-aos="fade-up">
   <p>Check Our Services<br></p>
   </div>
   <div class="container">
      <div class="row gy-4">
         <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item item-cyan position-relative">
            <i class="bi bi-activity icon"></i>
            <h3>Nesciunt Mete</h3>
            <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.</p>
            <a href="#" class="read-more stretched-link"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
         </div>

         <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item item-orange position-relative">
            <i class="bi bi-broadcast icon"></i>
            <h3>Eosle Commodi</h3>
            <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.</p>
            <a href="#" class="read-more stretched-link"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
         </div>

         <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item item-teal position-relative">
            <i class="bi bi-easel icon"></i>
            <h3>Ledo Markt</h3>
            <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>
            <a href="#" class="read-more stretched-link"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
         </div>

         <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item item-red position-relative">
            <i class="bi bi-bounding-box-circles icon"></i>
            <h3>Asperiores Commodi</h3>
            <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.</p>
            <a href="#" class="read-more stretched-link"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
         </div>

         <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item item-indigo position-relative">
            <i class="bi bi-calendar4-week icon"></i>
            <h3>Velit Doloremque.</h3>
            <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.</p>
            <a href="#" class="read-more stretched-link"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
         </div>

         <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item item-pink position-relative">
            <i class="bi bi-chat-square-text icon"></i>
            <h3>Dolori Architecto</h3>
            <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>
            <a href="#" class="read-more stretched-link"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
         </div>

      </div>
   </div>
</section> -->
<!-- /Services Section -->

<!-- Clients Section -->
<section id="clients" class="clients section" style="margin-top: -116px;">
   <div class="container section-title" data-aos="fade-up">
   <p>We work with best clients<br></p>
   </div>
   <div class="container" data-aos="fade-up" data-aos-delay="100">
   <div class="swiper init-swiper">
      <script type="application/json" class="swiper-config">
         {
         "loop": true,
         "speed": 600,
         "autoplay": {
            "delay": 5000
         },
         "slidesPerView": "auto",
         "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
         },
         "breakpoints": {
            "320": {
               "slidesPerView": 2,
               "spaceBetween": 40
            },
            "480": {
               "slidesPerView": 3,
               "spaceBetween": 60
            },
            "640": {
               "slidesPerView": 4,
               "spaceBetween": 80
            },
            "992": {
               "slidesPerView": 6,
               "spaceBetween": 120
            }
         }
         }
      </script>
      <div class="swiper-wrapper align-items-center">
         <div class="swiper-slide"><img src="{{ asset('assets/front/img/clients/client-1.png') }}" class="img-fluid" alt=""></div>
         <div class="swiper-slide"><img src="{{ asset('assets/front/img/clients/client-2.png') }}" class="img-fluid" alt=""></div>
         <div class="swiper-slide"><img src="{{ asset('assets/front/img/clients/client-3.png') }}" class="img-fluid" alt=""></div>
         <div class="swiper-slide"><img src="{{ asset('assets/front/img/clients/client-4.png') }}" class="img-fluid" alt=""></div>
         <div class="swiper-slide"><img src="{{ asset('assets/front/img/clients/client-5.png') }}" class="img-fluid" alt=""></div>
         <div class="swiper-slide"><img src="{{ asset('assets/front/img/clients/client-6.png') }}" class="img-fluid" alt=""></div>
         <div class="swiper-slide"><img src="{{ asset('assets/front/img/clients/client-7.png') }}" class="img-fluid" alt=""></div>
         <div class="swiper-slide"><img src="{{ asset('assets/front/img/clients/client-8.png') }}" class="img-fluid" alt=""></div>
      </div>
      <div class="swiper-pagination"></div>
   </div>

   </div>
</section>
<!-- /Clients Section -->
@endsection