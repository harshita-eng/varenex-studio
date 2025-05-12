
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Step-wise Onboarding</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #ffffff; /* White background for the page */
      margin: 0;
      padding: 0;
    }

    .onboarding-container {
      display: flex;
      justify-content: center;
      margin: 30px auto;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      max-width: 1200px;
    }

    .onboarding-left {
        width: 80%; /* 80% width for the form section */
        padding: 20px;
        /* Remove the background-color property */
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .onboarding-right {
        width: 20%; /* 20% width for the icon section */
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #e0f7fa; /* Light blue pastel color */
        border-radius: 8px;
    }

    .step-heading {
        font-size: 16px;
        text-align: left;
        color: #000000;
        font-weight: bold;
        margin-top: 53px;
        margin-bottom: -16px;
        margin-left: 143px;
    }

    .step-description {
        font-size: 12px;
        text-align: center;
        margin-bottom: 20px;
        color: #555;
        margin-right: -100px;
    }

    .step-indicator {
      display: flex;
      gap: 7px;
      margin-bottom: 20px;
      font-size: 16px;
      font-weight: bold;
      justify-content: center; /* Align items to center */
    }

    .step-indicator .step {
      width: 22px;
      height: 22px;
      border-radius: 50%;
      background-color: #e9ecef; /* Default grey color for inactive steps */
      display: flex;
      justify-content: center;
      align-items: center;
      transition: background-color 0.3s ease;
    }

    .step-indicator .active {
      background-color: #007bff; /* Blue color for active steps */
      color: white;
    }

    .step-indicator .completed {
      background-color:rgb(60, 127, 234); /* Green color for completed steps */
      color: white;
    }

    .form-field {
      margin-bottom: 15px;
    }

    .form-label {
      font-weight: 600;
    }

    .form-input {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .buttons-container {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 20px;
    }

    .btn-custom {
      font-size: 14px;
      padding: 10px 20px;
    }

    .btn-next, .btn-back {
      background-color: #007bff;
      color: white;
      border: none;
    }

    .onboarding-right img {
      max-width: 50%; /* Make the icon smaller */
      height: auto;
    }

    .heading-container {
      display: flex;
      flex-direction: column;
      align-items: center; /* Center align the heading */
      justify-content: center;
      margin-bottom: 20px;
    }

    /* Align logo to left */
    .logo-container {
        position: absolute;
        top: 73px;
        left: 80px;
        font-size: 18px;
    }
    .company-logo {
        max-height: 34px;
    }
  </style>
</head>
<body>

<div class="onboarding-container">
  <div class="onboarding-left">
    <div class="heading-container">
        <!-- Company Logo aligned to the left -->
        <div class="logo-container">
            <img src="{{ asset('assets/front/img/VARENYA EX.png') }}" alt="Company Logo" class="company-logo"> <strong>STUDIO</strong>
        </div>
      <!-- Onboarding Progress Heading -->
      <div class="step-heading">Effortlessly onboard your company and unlock new opportunities</div>
    </div>

    <!-- Step Indicator with Icons and Improved Design -->
    <div class="step-description">Follow the steps below to complete your company onboarding process</div>
    
    <div class="step-indicator" id="stepIndicator">
      <span class="step active"><i class="bi bi-check-lg"></i></span>
      <span class="step"><i class="bi bi-check-lg"></i></span>
      <span class="step"><i class="bi bi-check-lg"></i></span>
      <span class="step"><i class="bi bi-check-lg"></i></span>
      <span class="step"><i class="bi bi-check-lg"></i></span>
    </div>

    <div class="" id="stepHeading" style="margin-bottom: 20px;">Step 1: Welcome to the Onboarding</div>

    <!-- Form Fields (2 columns) -->
    <div class="row">
      <div class="col-md-6 form-field">
        <label class="form-label" for="fullName">Full Name</label>
        <input type="text" class="form-input" id="fullName" placeholder="Enter your full name">
      </div>

      <div class="col-md-6 form-field">
        <label class="form-label" for="email">Email</label>
        <input type="email" class="form-input" id="email" placeholder="Enter your email">
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 form-field">
        <label class="form-label" for="phone">Phone Number</label>
        <input type="tel" class="form-input" id="phone" placeholder="Enter your phone number">
      </div>

      <div class="col-md-6 form-field">
        <label class="form-label" for="address">Address</label>
        <input type="text" class="form-input" id="address" placeholder="Enter your address">
      </div>
    </div>

    <div class="buttons-container">
      <button class="btn btn-custom btn-back" id="backBtn">Back</button>
      <button class="btn btn-custom btn-next" id="nextBtn">Next</button>
    </div>
  </div>

  <div class="onboarding-right">
    <!-- Placeholder for company onboarding related icon -->
    <img src="{{ asset('assets/front/onboarding.png')}}" alt="Onboarding Icon">
  </div>
</div>

<script>
  let currentStep = 1;
  const totalSteps = 5;

  function updateProgress() {
    // Update the progress of active steps in the indicator
    const steps = document.querySelectorAll(".step");
    steps.forEach((step, index) => {
      if (index < currentStep) {
        step.classList.add("completed");
        step.classList.remove("active");
      } else if (index === currentStep - 1) {
        step.classList.add("active");
        step.classList.remove("completed");
      } else {
        step.classList.remove("completed", "active");
      }
    });

    document.getElementById("stepHeading").textContent = `Step ${currentStep}: ` +
      (currentStep === 1 ? 'Welcome to the Onboarding' :
      currentStep === 2 ? 'Fill in Your Details' :
      currentStep === 3 ? 'Review Your Information' :
      currentStep === 4 ? 'Confirm Your Preferences' :
      'All Set! Ready to Go');

    document.getElementById("backBtn").disabled = currentStep === 1;
  }

  document.getElementById("nextBtn").addEventListener("click", function () {
    if (currentStep < totalSteps) {
      currentStep++;
      updateProgress();
    }
  });

  document.getElementById("backBtn").addEventListener("click", function () {
    if (currentStep > 1) {
      currentStep--;
      updateProgress();
    }
  });

  updateProgress();
</script>

<!-- Add Bootstrap Icons -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

</body>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Company Onboarding</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .step-indicator {
      display: flex;
      gap: 8px;
      margin-bottom: 20px;
    }
    .step-dot {
      width: 30px;
      height: 4px;
      background-color: #ccc;
      border-radius: 2px;
    }
    .step-dot.active {
      background-color: #007bff;
    }
    .form-section {
      display: none;
    }
    .form-section.active {
      display: block;
    }
    .sidebar {
      background-color: #fff;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100%;
      padding: 20px 10px;
      border-left: 1px solid #dee2e6;
    }
    .sidebar img {
      max-width: 100%;
      height: auto;
      align-self: center;
    }
    .onboarding-header {
      font-weight: bold;
      color: #000;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="onboarding-header text-center mb-4">
    <h4>Company Onboarding</h4>
  </div>
  
  <div class="row">
    <!-- Left (80%) -->
    <div class="col-md-9">
      <!-- Step indicators -->
      <div class="step-indicator">
        <div class="step-dot active" data-step="1"></div>
        <div class="step-dot" data-step="2"></div>
        <div class="step-dot" data-step="3"></div>
      </div>

      <!-- Form Sections -->
      <form id="onboardingForm">
        <div class="form-section active" data-step="1">
          <div class="mb-3">
            <label for="companyName" class="form-label">Company Name</label>
            <input type="text" class="form-control" id="companyName" placeholder="Enter company name">
          </div>
          <div class="mb-3">
            <label for="companyName" class="form-label">Company email</label>
            <input type="text" class="form-control" id="companyName" placeholder="Enter company name">
          </div>
        </div>
        <div class="form-section" data-step="2">
          <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <input type="text" class="form-control" id="department" placeholder="Enter department">
          </div>
        </div>
        <div class="form-section" data-step="3">
          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <input type="text" class="form-control" id="role" placeholder="Enter role">
          </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="d-flex justify-content-between mt-4">
          <button type="button" class="btn btn-outline-dark" id="prevBtn">Back</button>
          <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
        </div>
      </form>
    </div>

    <!-- Right (20%) -->
    <div class="col-md-3 sidebar">
      <img src="https://via.placeholder.com/100x100.png?text=Logo" alt="Icon Top">
      <img src="https://via.placeholder.com/100x100.png?text=Help" alt="Icon Bottom">
    </div>
  </div>
</div>

<script>
  let currentStep = 1;
  const totalSteps = 3;

  function showStep(step) {
    document.querySelectorAll('.form-section').forEach(section => {
      section.classList.remove('active');
      if (parseInt(section.dataset.step) === step) {
        section.classList.add('active');
      }
    });

    document.querySelectorAll('.step-dot').forEach(dot => {
      dot.classList.remove('active');
      if (parseInt(dot.dataset.step) === step) {
        dot.classList.add('active');
      }
    });

    // Handle button state
    document.getElementById('prevBtn').disabled = step === 1;
    document.getElementById('nextBtn').innerText = step === totalSteps ? 'Finish' : 'Next';
  }

  document.getElementById('nextBtn').addEventListener('click', () => {
    if (currentStep < totalSteps) {
      currentStep++;
      showStep(currentStep);
    } else {
      alert('Form submitted!');
      // submit form here if needed
    }
  });

  document.getElementById('prevBtn').addEventListener('click', () => {
    if (currentStep > 1) {
      currentStep--;
      showStep(currentStep);
    }
  });

  showStep(currentStep);
</script>

</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Card UI</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Card -->
    <div class="bg-white shadow-md rounded-xl p-4 relative">
      <!-- Header -->
      <div class="flex justify-between items-start">
        <h2 class="text-lg font-bold text-gray-800">Application Title</h2>
        
        <!-- Dropdown -->
        <div class="relative group">
          <button class="text-gray-500 hover:text-gray-700">
            ⋮
          </button>
          <div class="absolute right-0 mt-2 w-28 bg-white border rounded shadow-md hidden group-hover:block">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
            <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Delete</a>
          </div>
        </div>
      </div>

      <!-- Created date -->
      <p class="text-sm text-gray-500 mt-1">Created on: 2025-05-05</p>

      <!-- Footer -->
      <div class="flex justify-between items-center mt-6">
        <!-- Edit Icon -->
        <a href="#" class="text-gray-600 hover:text-blue-600 flex items-center space-x-1">
          ✏️ <span class="text-sm">Edit</span>
        </a>

        <!-- Run link -->
        <a href="#" class="text-blue-600 hover:underline text-sm font-medium">Run Application →</a>
      </div>
    </div>
  </div>

</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Card with Initials</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Card -->
    <div class="bg-gray-50 border border-gray-200 shadow-sm rounded-xl p-4 relative">
      
      <!-- Header -->
      <div class="flex justify-between items-start">
        <div class="flex items-center space-x-3">
          <!-- Initials -->
          <div class="bg-blue-100 text-blue-600 font-semibold rounded-full border border-blue-300 px-3 py-1 text-sm">
            AT
          </div>
          <!-- Title -->
          <h2 class="text-lg font-bold text-gray-800">Application Title</h2>
        </div>

        <!-- Dropdown -->
        <div class="relative group">
          <button class="text-gray-500 hover:text-gray-700">
            ⋮
          </button>
          <div class="absolute right-0 mt-2 w-28 bg-white border rounded shadow-md hidden group-hover:block z-10">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
            <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Delete</a>
          </div>
        </div>
      </div>

      <!-- Created date -->
      <p class="text-sm text-gray-500 mt-2">Created on: 2025-05-05</p>

      <!-- Footer -->
      <div class="flex justify-between items-center mt-6">
        <!-- Edit Icon -->
        <a href="#" class="text-gray-600 hover:text-blue-600 flex items-center space-x-1">
          ✏️ <span class="text-sm">Edit</span>
        </a>

        <!-- Run link -->
        <a href="#" class="text-blue-600 hover:underline text-sm font-medium">Run Application →</a>
      </div>
    </div>
  </div>

</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Styled App Cards</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md hover:bg-gray-50 transition duration-200 p-4 flex flex-col justify-between min-h-[180px] group relative">
      
      <!-- Top section -->
      <div class="flex justify-between items-start">
        <div class="flex items-center space-x-3">
          <div class="bg-blue-100 text-blue-600 font-bold rounded-full px-3 py-1 text-sm border border-blue-300">
            DI
          </div>
          <div>
            <h2 class="text-base font-semibold text-gray-800">Demo Industry</h2>
            <p class="text-sm text-gray-500 mt-1">Created on Feb 13, 2025</p>
          </div>
        </div>

        <!-- Dropdown -->
        <div class="relative">
          <button class="text-gray-400 hover:text-gray-600 focus:outline-none">
            ⋮
          </button>
          <div class="absolute right-0 mt-2 w-28 bg-white border rounded shadow-md opacity-0 group-hover:opacity-100 invisible group-hover:visible transition duration-200 z-10">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
            <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Delete</a>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="flex justify-between items-center mt-6">
        <span class="text-sm text-gray-500 flex items-center space-x-1">
          <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
               viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 16h8M8 12h8m-4-4h4M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
          <span>Application</span>
        </span>
        <a href="#" class="text-sm text-blue-600 font-medium hover:underline flex items-center space-x-1">
          <span>Run</span>
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path d="M5.23 7.21a.75.75 0 011.06-.02L10 10.677l3.71-3.49a.75.75 0 111.04 1.08l-4.25 4a.75.75 0 01-1.04 0l-4.25-4a.75.75 0 01-.02-1.06z"/>
          </svg>
        </a>
      </div>
    </div>
  </div>

</body>
</html>

