<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>VarXStudio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', sans-serif;
      height: 100vh;
      display: flex;
      flex-direction: column;
      margin: 0;
    }
    .form-wrapper {
      max-width: 100%;
      width: 100%;
      padding: 2rem;
    }
    .logo-heading {
      display: flex;
      align-items: center;
      margin-bottom: 4rem;
    }
    .logo-heading img {
      height: 50px;
      margin-right: 1rem;
      color:black;
    }
    .heading {
      font-size: 1.5rem;
      color:rgb(28, 28, 35);
    }
    .step {
      display: none;
    }
    .step.active {
      display: block;
    }
    .is-invalid {
      border-color: #dc3545;
    }

    /* Step Dash Progress */
    .step-dash-wrapper {
      display: flex;
      gap: 10px;
      justify-content: center;
    }
    .step-dash {
      width: 30px;
      height: 4px;
      background-color: #ccc;
      border-radius: 2px;
      transition: background-color 0.3s;
    }
    .step-dash.active {
      background-color: #6f42c1;;
    }
    .bottom-progress {
      margin-top: auto;
      padding: 1rem 0;
    }
  </style>
</head>
<body>

<div class="container-fluid d-flex flex-column" style="min-height: 100vh;">
  <div class="form-wrapper bg-white shadow rounded">

    <!-- Logo and Heading -->
    <div class="logo-heading">
      <h1 class="heading">VarneXStudio</h1>
    </div>

    <!-- Form Start -->
    <form id="multiStepForm" method="POST" action="{{ route('onboardsubmit') }}" enctype="multipart/form-data">
      @csrf

      <!-- Step 1 -->
      <div class="step active">
        <h4 class="mb-4" style="color:#6f42c1;">Time to bring your app to life !</h4>
        <div class="mb-3">
          <label class="form-label">Name your app</label>
          <input type="text" class="form-control step1-required" name="name" required>
        </div>
        <!-- <div class="mb-3">
          <label class="form-label">Email Address</label>
          <input type="email" class="form-control step1-required" name="email" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Country</label>
          <select class="form-select step1-required" name="country" required>
            <option value="">Select Country</option>
            <option>USA</option>
            <option>UK</option>
            <option>India</option>
          </select>
        </div> -->
        <button type="button" class="btn btn-primary next-btn">Next</button>
      </div>

      <!-- Step 2 -->
      <div class="step">
        <h4 class="mb-4" style="color:#6f42c1;">Department & Role Setup</h4>
        <div id="departmentsContainer"></div>
        <button type="button" class="btn btn-outline-primary mb-4" id="addDepartmentBtn">+ Add Department</button></br>
        <button type="button" class="btn btn-secondary prev-btn">Back</button>
        <button type="button" class="btn btn-primary next-btn">Next</button>
      </div>

      <!-- step 4 -->
      <div class="step">
        <h4 class="mb-4" style="color:#6f42c1;">Select Data Source</h4>
        <div class="mb-3">
          <div class="form-check">
           <input class="form-check-input radio-select" type="radio" name="source_type" id="option1" value="student">
            <label class="form-check-label" for="option1">Create from Scratch</label> 
          </div>
          <div class="form-check">
            <input class="form-check-input radio-select" type="radio" name="source_type" id="option2" value="teacher">
            <label class="form-check-label" for="option2">Use Sample Data</label>
          </div>
          <div class="form-check">
            <input class="form-check-input radio-select" type="radio" name="source_type" id="option3" value="admin">
            <label class="form-check-label" for="option3">Import CSV</label>
          </div>
        </div>
        <button type="button" class="btn btn-secondary prev-btn">Back</button>
        <button type="button" class="btn btn-primary next-btn">Next</button>
      </div>

      <!-- scratch 5-->
      <div class="step">
        <h4 class="mb-4" style="color:#6f42c1;">Table and forms Setup</h4>
        <div id="studentContent" class="conditional-content" style="display: none;">
          <p><strong>Build From Scratch:</strong></p>
          <div class="build-wrap form-wrapper-div" id="build-wrap"></div>
          <input type="hidden" name="scratch" id="scratch" value="">
        </div></br>

        <div id="teacherContent" class="conditional-content" style="display: none;">
          <p><strong>Teacher Info:</strong></p>
          <input type="text" class="form-control mb-2" placeholder="Department">
          <input type="text" class="form-control mb-2" placeholder="Subject Specialization">
        </div>

        <div id="adminContent" class="conditional-content" style="display: none;">
          <label class="form-label">Upload CSV</label>
          <input type="file" class="form-control mb-2" name="import_csv">
          <span>Note: Only CSV format is supported</span>
        </div></br>
        <button type="button" class="btn btn-secondary prev-btn">Back</button>
        <button type="button" class="btn btn-primary next-btn">Next</button>
      </div>

      <!-- csv 53-->
      <!-- <div class="step" style="display:none;">
        <h4 class="mb-4" style="color:#6f42c1;">Table and forms Setup</h4>
        <div class="mb-3">
          <label class="form-label">Import CSV</label>
          <input type="file" class="form-control" name="csv">
        </div>
        <button type="button" class="btn btn-secondary prev-btn">Back</button>
        <button type="button" class="btn btn-primary next-btn">Next</button>
      </div> -->

      <!-- Step 6 -->
      <div class="step">
        <h4 class="mb-4" style="color:#6f42c1;">Final Setup</h4>
        <div class="mb-3">
          <h3>You're almost done!</h3>
          <p>Please review the details you've provided. Once you're ready, click "Submit" to complete your onboarding.</p>
        </div>
        <button type="button" class="btn btn-secondary prev-btn">Back</button>
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </form>
  </div>

  <!-- Step Dash Progress Bar at Bottom -->
  <div class="bottom-progress bg-white">
    <div class="step-dash-wrapper">
      <span class="step-dash active"></span>
      <span class="step-dash"></span>
      <span class="step-dash"></span>
      <span class="step-dash"></span>
    </div>
  </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<!-- jQuery FormBuilder Plugin -->
<link rel="stylesheet" href="https://formbuilder.online/assets/css/form-builder.min.css">
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>

<script>
  function validateStep(step) {
    let isValid = true;
    $('.is-invalid').removeClass('is-invalid');
    $(`.step${step}-required`).each(function () {
      if ($(this).attr('type') === 'checkbox') {
        if ($(`.step${step}-required:checked`).length === 0) {
          $(this).closest('div').addClass('is-invalid');
          isValid = false;
          return false;
        }
      } else if (!$(this).val()) {
        $(this).addClass('is-invalid');
        isValid = false;
      }
    });
    return isValid;
  }

  $(function () {
    let currentStep = 0;
    const steps = $(".step");
    const totalSteps = steps.length;

    function showStep(index) {
      steps.removeClass("active");
      steps.eq(index).addClass("active");

      $(".step-dash").removeClass("active");
      $(".step-dash").eq(index).addClass("active");
    }

    $(".next-btn").click(function () {
      if (validateStep(currentStep + 1)) {
        if (currentStep < steps.length - 1) {
          currentStep++;
          showStep(currentStep);
        }
      }
    });

    $(".prev-btn").click(function () {
      if (currentStep > 0) {
        currentStep--;
        showStep(currentStep);
      }
    });

    $("#addFieldBtn").click(function () {
      $("#dynamicFields").append(`
        <div class="dynamic-field mb-2">
          <label class="form-label">Additional Field</label>
          <input type="text" class="form-control" name="extra_fields[]">
        </div>
      `);
    });
  });

  // departments and user role
  let departmentIndex = 0;
  const permissionsList = ['create', 'read', 'update', 'delete', 'manage-users'];

  $('#addDepartmentBtn').click(function () {
    departmentIndex++;

    const departmentHtml = `
      <div class="border p-3 mb-4 rounded shadow-sm bg-light">
        <h5 class="text-primary">Department ${departmentIndex}</h5>
        <input type="text" name="departments[${departmentIndex}][name]" class="form-control mb-3" placeholder="Department Name">

        <div class="rolesWrapper mb-3">
          <h6>Roles</h6>
          <div class="roleContainer"></div>
          <button type="button" class="btn btn-outline-secondary btn-sm addRoleBtn">+ Add Role</button>
        </div>

        <div class="usersWrapper">
          <h6>Users</h6>
          <div class="userContainer"></div>
          <button type="button" class="btn btn-outline-secondary btn-sm addUserBtn">+ Add User</button>
        </div>
      </div>
    `;
    $('#departmentsContainer').append(departmentHtml);
  });

  $(document).on('click', '.addRoleBtn', function () {
    const deptWrapper = $(this).closest('.border');
    const roleContainer = deptWrapper.find('.roleContainer');
    const deptIndex = $('#departmentsContainer .border').index(deptWrapper) + 1;
    const roleIndex = roleContainer.children().length + 1;

    let permissionCheckboxes = permissionsList.map(p => `
      <label class="form-check form-check-inline me-3">
        <input class="form-check-input" type="checkbox" name="departments[${deptIndex}][roles][${roleIndex}][permissions][]" value="${p}"> ${p}
      </label>
    `).join('');

    const roleHtml = `
      <div class="mb-3">
        <input type="text" name="departments[${deptIndex}][roles][${roleIndex}][name]" class="form-control mb-2" placeholder="Role Name">
        <div>${permissionCheckboxes}</div>
      </div>
    `;

    roleContainer.append(roleHtml);
  });

  $(document).on('click', '.addUserBtn', function () 
  {
    const deptWrapper = $(this).closest('.border');
    const userContainer = deptWrapper.find('.userContainer');
    const deptIndex = $('#departmentsContainer .border').index(deptWrapper) + 1;
    const userIndex = userContainer.children().length + 1;

    const userHtml = `
      <div class="mb-3">
        <div class="row g-2">
          <div class="col-md-4">
            <input type="text" name="departments[${deptIndex}][users][${userIndex}][name]" class="form-control" placeholder="User Name">
          </div>
          <div class="col-md-4">
            <input type="email" name="departments[${deptIndex}][users][${userIndex}][email]" class="form-control" placeholder="User Email">
          </div>
          <div class="col-md-4">
            <input type="text" name="departments[${deptIndex}][users][${userIndex}][role]" class="form-control" placeholder="Assign Role">
          </div>
        </div>
      </div>
    `;
    userContainer.append(userHtml);
  });

  // Forms and tables 
  let selectedUserType = '';
  let currentStep = 0;
  const steps = $(".step");
  const dots = $(".step-dots .dot");

  function showStep(index) {
    steps.removeClass("active").eq(index).addClass("active");
    dots.removeClass("active").eq(index).addClass("active");
  }

  $('.radio-select').on('change', function () {
    selectedUserType = $(this).val();
  });

  $('.next-btn').click(function () {
    if (currentStep === 1 && !selectedUserType) {
      alert("Please select an option before proceeding.");
      return;
    }

    if (currentStep === 1 && selectedUserType) {
      $('#studentContent, #teacherContent, #adminContent').hide();
      $(`#${selectedUserType}Content`).show();
    }

    if (currentStep < steps.length - 1) {
      currentStep++;
      showStep(currentStep);
    }
  });

  // from builder
  $(function() {
    jQuery(function($) {
      $(document.getElementById('build-wrap')).formBuilder({
          onSave: function(evt,formData) {
            console.log(formData);
            //saveForm(formData);
            $('#scratch').val(formData);
          }
      });
    })
  });
</script>
</body>
</html>
