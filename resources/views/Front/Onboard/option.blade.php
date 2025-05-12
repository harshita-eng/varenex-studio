@extends('Front.layout.front_layout')
@section('content')

<div class="page-title" style="border-top: 1px solid color-mix(in srgb, var(--accent-color), transparent 85%);"></div>
    
<section id="values" class="values section">
  <div class="container section-title" data-aos="fade-up">
    <!-- <h2>Our Values</h2> -->
    <p>What we value most<br></p>
  </div>
  <div class="container">
    <div class="row gy-4">
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <a href="{{ route('showform', 'scratch') }}">
          <div class="card">
            <h3>Build from scratch</h3>
            <p>Build applications from scratch—faster and easier with low-code and no-code solutions.</p>
          </div>
        </a>
      </div>

      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <a href="{{ route('showform', 'existing') }}">
          <div class="card">
            <h3>Build from existing data</h3>
            <p>Transform existing data into powerful applications with low-code and no-code tools.</p>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>
@endsection

