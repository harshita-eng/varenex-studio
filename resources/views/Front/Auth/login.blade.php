<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Login & Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/front/css/custom.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/front/js/custom.js') }}"></script>
    <style>
      body {
        background: #f8f9fa;
        font-family: 'Segoe UI', sans-serif;
      }
      .auth-container {
        max-width: 900px;
        margin: 3rem auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
      }
      .auth-left {
        background: linear-gradient(135deg,rgb(161, 190, 244),rgb(58, 117, 205));
        color: #fff;
        padding: 3rem;
      } 
      .auth-left h2 {
        font-weight: 700;
        margin-bottom: 1rem;
      }
      .auth-form {
        padding: 3rem;
      }
      .form-control {
        border-radius: 10px;
      }
      .btn-primary {
        border-radius: 10px;
      }
      .toggle-link {
        font-size: 0.9rem;
        display: block;
        margin-top: 1rem;
        color: #6c63ff;
        cursor: pointer;
      }
      .logo{
        color:white;
        text-decoration:none;
      }
    </style>
  </head>
  <body>
    <div class="auth-container d-flex">
      <!-- Left Panel -->
      <div class="auth-left d-none d-md-flex flex-column justify-content-center col-md-6">
        <h2><a class="logo" href="{{ route('home') }}"><img src="{{ asset('assets/front/img/VARENYA EX.png') }}" width="230px"> Studio</a></h2>
        <p>Start building amazing apps with our low-code platform. Log in or sign up to get started.</p>
      </div>

      <!-- Right Panel (Forms) -->
      <div class="col-md-6">
        <div class="auth-form">
          <div id="loginForm">
            @include('Front.partials.flash_message')
            <h3 class="mb-4">Sign In</h3>
            <form method="POST" action="{{ route('postlogin') }}">
              @csrf
              <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email address">
                @if($errors->has('email'))
                  <div class="error">{{ $errors->first('email') }}</div>
                @endif
              </div>
              <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password">
                @if($errors->has('password'))
                  <div class="error">{{ $errors->first('password') }}</div>
                @endif
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Sign In</button>
              </div>
              <span class="toggle-link">Don't have an account? <a href="{{ route('showonboardform') }}"> Sign Up </a></span>
            </form>
          </div>

          <!-- Sign Up Form -->
          <div id="registerForm" style="display: none;">
            @include('Front.partials.flash_message')
            <h3 class="mb-4">Sign Up</h3>
            <form method="post" action="{{ route('register') }}">
              @csrf
              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Full Name" name="name" value="{{ old('name') }}">
                @if($errors->has('name'))
                  <div class="error">{{ $errors->first('name') }}</div>
                @endif
              </div>
              <div class="mb-3">
                <input type="email" class="form-control" placeholder="Email address" name="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                  <div class="error">{{ $errors->first('email') }}</div>
                @endif
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password" value="{{ old('password') }}">
                @if($errors->has('password'))
                  <div class="error">{{ $errors->first('password') }}</div>
                @endif
              </div>
              <div class="mb-3">
                <select name="role_id" class="form-control">
                  <option>Select User</option>
                  <option value="2">Customer</option>
                  <option value="3">Developer</option>
                </select>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Sign Up</button>
              </div>
              <span class="toggle-link" onclick="toggleForms()">Already have an account? Sign In</span>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script>
      function toggleForms() {
        const loginForm = document.getElementById("loginForm");
        const registerForm = document.getElementById("registerForm");
        loginForm.style.display = loginForm.style.display === "none" ? "block" : "none";
        registerForm.style.display = registerForm.style.display === "none" ? "block" : "none";
      }
    </script>
  </body>
</html>