@extends('Front.layout.front_layout')
@section('content')
    
<section id="contact" class="contact section">
  <div class="container section-title" data-aos="fade-up">
    <p>Build From Scratch</p>
  </div>
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4">
      <div class="col-lg-12">
        <h5>Drag & Drop Form Fields</h5>
        <div id="fb-editor"></div>
      </div>
    </div>
  </div>
</section>
@endsection

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- jQuery UI (needed for drag/drop in formBuilder) -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<!-- jQuery FormBuilder Plugin -->
<link rel="stylesheet" href="https://formbuilder.online/assets/css/form-builder.min.css">
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>

<script>
  jQuery(function($) {
    $('#fb-editor').formBuilder();
  });
</script>

<style>
  body {
    margin: 30px;
    font-family: Arial, sans-serif;
  }
  #fb-editor {
    border: 1px solid #ccc;
    padding: 20px;
    min-height: 300px;
  }
</style>


