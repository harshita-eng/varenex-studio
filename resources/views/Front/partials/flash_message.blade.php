@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
  </div>
@endif

@if(session('info'))
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    {{ session('info') }}
  </div>
@endif