<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Login & Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/front/css/custom.css') }}" rel="stylesheet">
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
        background: linear-gradient(135deg, #6c63ff, #4e54c8);
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
        <h2><a class="logo" href="{{ route('home') }}">VarneXStudio</a></h2>
        <p>Start building amazing apps with our low-code platform. Log in or sign up to get started.</p>
      </div>

      <!-- Right Panel (Forms) -->
      <div class="col-md-6">
        <div class="auth-form">
          <!-- Sign In Form -->
          <div id="loginForm">
            @include('Front.partials.flash_message')
            <h3 class="mb-4">Enter OTP</h3>
            <p class="text-muted mb-4">We've sent a 4-digit code to your registered email.</p>
            <form method="post" action="{{ route('otpverify', $id) }}">
              @csrf
              <div class="d-flex justify-content-center mb-4 otp-input">
                <input type="text" name="otp[]" maxlength="1" class="form-control mx-1" required>
                <input type="text" name="otp[]" maxlength="1" class="form-control mx-1" required>
                <input type="text" name="otp[]" maxlength="1" class="form-control mx-1" required>
                <input type="text" name="otp[]" maxlength="1" class="form-control mx-1" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Verify</button>
            </form>
            <p class="mt-4 text-muted">Didn't receive the code? <a href="#">Resend</a></p>
          </div>
        </div>
      </div>
    </div>
    <script>
      // Auto-focus next input
      const inputs = document.querySelectorAll('.otp-input input');
      inputs.forEach((input, index) => {
        input.addEventListener('input', () => {
          if (input.value.length === 1 && index < inputs.length - 1) {
            inputs[index + 1].focus();
          }
        });
      });
    </script>
  </body>
</html>