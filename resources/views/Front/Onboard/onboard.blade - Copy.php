<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Onboarding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .step { display: none; }
      .step.active { display: block; }
      .dropdown-checkboxes {
        max-height: 200px;
        overflow-y: auto;
      }
      .dropdown-menu label {
        display: flex;
        align-items: center;
        padding: 5px 10px;
        width: 100%;
        cursor: pointer;
      }
    </style>
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">Company Onboarding</h2>
    <form id="onboardingForm" action="{{ route('onboardsubmit') }}" method="POST" enctype="multipart/form-data">
      @csrf
        <!-- Step 1: Company Details -->
        <div class="step active" id="step1">
            <h4>Step 1: Company Details</h4>
            <div class="mb-3">
              <label class="form-label">Company Name</label>
              <input type="text" class="form-control" name="company_name" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Director / Owner Name</label>
              <input type="text" class="form-control" name="director_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Industry</label>
                <input type="text" class="form-control" name="industry">
            </div>
            <div class="mb-3">
                <label class="form-label">Number of Employees</label>
                <select class="form-select" name="company_size">
                    <option>1-10</option>
                    <option>11-50</option>
                    <option>51-200</option>
                    <option>201-500</option>
                    <option>500+</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Website Url</label>
                <input type="url" class="form-control" name="website">
            </div>
            <div class="mb-3">
                <label class="form-label">Company Logo</label>
                <input type="file" class="form-control" name="logo">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>
            <button type="button" class="btn btn-primary next-step">Next</button>
        </div>

        <!-- Step 2: Address & Contact -->
        <div class="step" id="step2">
            <h4>Step 2: Address & Contact</h4>
            <div class="mb-3">
                <label class="form-label">Address Line 1</label>
                <input type="text" class="form-control" name="address1">
            </div>
            <div class="mb-3">
                <label class="form-label">Address Line 2</label>
                <input type="text" class="form-control" name="address2">
            </div>
            <div class="mb-3">
                <label class="form-label">City</label>
                <input type="text" class="form-control" name="city">
            </div>
            <div class="mb-3">
                <label class="form-label">State/Province</label>
                <input type="text" class="form-control" name="state">
            </div>
            <div class="mb-3">
                <label class="form-label">Zip Code</label>
                <input type="text" class="form-control" name="zip">
            </div>
            <div class="mb-3">
                <label class="form-label">Country</label>
                <input type="text" class="form-control" name="country">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="phone">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <button type="button" class="btn btn-secondary prev-step">Back</button>
            <button type="button" class="btn btn-primary next-step">Next</button>
        </div>

        <!-- Step 3: Admin Setup -->
        <div class="step" id="step3">
          <h4>Step 3: Primary Contact</h4>
          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" name="admin_name">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="admin_email">
          </div>
          <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="text" class="form-control" name="admin_phone">
          </div>
          <div class="mb-3">
            <label class="form-label">Designation</label>
            <input type="text" class="form-control" name="admin_role">
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="admin_password">
          </div>
          <button type="button" class="btn btn-secondary prev-step">Back</button>
          <button type="button" class="btn btn-primary next-step">Next</button>
        </div>

        <!-- Step 4: Settings -->
        <div class="step" id="step4">
            <h4>Step 4: Company Settings</h4>
            <div class="mb-3">
                <label class="form-label">Currency</label>
                <input type="text" class="form-control" name="currency">
            </div>
            <div class="mb-3">
                <label class="form-label">Language</label>
                <input type="text" class="form-control" name="language">
            </div>
            <div class="mb-3">
                <label class="form-label">Communication Preference</label>
                <select class="form-select" name="communication">
                    <option>Email</option>
                    <option>SMS</option>
                    <option>In-app</option>
                </select>
            </div>
            <button type="button" class="btn btn-secondary prev-step">Back</button>
            <button type="button" class="btn btn-primary next-step">Next</button>
        </div>

        <!-- Step 5: Departments & Roles -->
        <!-- <div class="step" id="step5">
            <h4>Step 5: Departments & Roles</h4>
            <div class="mb-3">
                <label class="form-label">Departments (comma-separated)</label>
                <input type="text" class="form-control" name="departments">
            </div>
            <div class="mb-3">
            <div id="departmentsContainer"></div>
                <button type="button" class="btn btn-outline-primary mb-4" id="addDepartmentBtn">+ Add Department</button></br>
                <label class="form-label">Roles (comma-separated)</label>
                <input type="text" class="form-control" name="roles">
            </div>
            <button type="button" class="btn btn-secondary prev-step">Back</button>
            <button type="button" class="btn btn-primary next-step">Next</button>
        </div> -->

        <!-- Step 6: Billing -->
        <div class="step" id="step6">
            <h4>Step 6: Billing & Plan</h4>
            <div class="mb-3">
                <label class="form-label">Subscription Plan</label>
                <select class="form-select" name="plan">
                    <option>Basic</option>
                    <option>Pro</option>
                    <option>Enterprise</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Billing Address</label>
                <input type="text" class="form-control" name="billing_address">
            </div>
            <div class="mb-3">
                <label class="form-label">Tax ID / VAT</label>
                <input type="text" class="form-control" name="tax_id">
            </div>
            <div class="mb-3">
                <label class="form-label">Billing Email</label>
                <input type="email" class="form-control" name="billing_email">
            </div>
            <button type="button" class="btn btn-secondary prev-step">Back</button>
            <button type="button" class="btn btn-primary next-step">Next</button>
        </div>

        <!-- Step 7: verification -->
        <div class="step" id="step7">
          <h4>Step 7: Verification</h4>
            <div class="mb-3">
              <label class="form-label">Business Registration</label>
              <input type="file" class="form-control" name="busniess_registration">
            </div>
            <div class="mb-3">
              <label class="form-label">PAN / TAX Identification Number</label>
              <input type="file" class="form-control" name="busniess_registration">
            </div>
            <div class="mb-3">
              <label class="form-label">GST / VAT Registration Certificate</label>
              <input type="file" class="form-control" name="registration_certificate">
            </div>
            <div class="mb-3">
              <label class="form-label">Company License</label>
              <input type="file" class="form-control" name="company_license">
            </div>
            <div class="mb-3">
              <label class="form-label">Director / Owner Govertment Identification</label>
              <input type="file" class="form-control" name="director_id">
            </div>
            <div class="mb-3">
              <label class="form-label">Director / Owner Address Proof</label>
              <input type="file" class="form-control" name="address_proof">
            </div>
            <button type="button" class="btn btn-secondary prev-step">Back</button>
            <button type="button" class="btn btn-primary next-step">Next</button>
        </div>

        <!-- Step 8: Process -->
        <div class="step" id="step8">
          <h4>Step 8: Select workflow</h4>
            <div class="mb-3">
              <input class="form-check-input" name="workflow[]" type="checkbox" value="inventory" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                Inventory
              </label>
            </div>
            <div class="mb-3">
              <input class="form-check-input" name="workflow[]" type="checkbox" value="order">
              <label class="form-check-label" for="flexCheckChecked">
                Order Processing
              </label>
            </div>

            <div class="mb-3">
              <input class="form-check-input" name="workflow[]" type="checkbox" value="maintenance">
              <label class="form-check-label" for="flexCheckChecked">
                Maintenance & Asset Management
              </label>
            </div>
            <div class="mb-3">
              <input class="form-check-input" name="workflow[]" type="checkbox" value="workflow">
              <label class="form-check-label" for="flexCheckChecked">
                Workflow & Automation
              </label>
            </div>
            <div class="mb-3">
              <input class="form-check-input" name="workflow[]" type="checkbox" value="finance">
              <label class="form-check-label" for="flexCheckChecked">
                Finance & Accounting
              </label>
            </div>
            <div class="mb-3">
              <input class="form-check-input" name="workflow[]" type="checkbox" value="hr">
              <label class="form-check-label" for="flexCheckChecked">
                HR Operations
              </label>
            </div>
            <div class="mb-3">
              <input class="form-check-input" name="workflow[]" type="checkbox" value="administrative">
              <label class="form-check-label" for="flexCheckChecked">
                Strategic / Administrative
              </label>
            </div>
          <button type="button" class="btn btn-secondary prev-step">Back</button>
          <button type="button" class="btn btn-primary next-step">Next</button>
        </div>

        <!-- step 9 : ER Diagrams -->
        <div class="step" id="step9">
          <h4>Step 9: Relations and Mappings</h4>
          <div id="app">
            <ERDiagram />
          </div>
          
          <button type="button" class="btn btn-secondary prev-step">Back</button>
          <button type="button" class="btn btn-primary next-step">Next</button>
        </div>

        <!-- Step 10: Review -->
        <div class="step" id="step10">
          <h4>Step 9: Review & Confirm</h4>
          <p>All data will be reviewed on submit (or show summary via JS).</p>
          <button type="button" class="btn btn-secondary prev-step">Back</button>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
</div>

<script>
    const steps = document.querySelectorAll('.step');
    let currentStep = 0;

    function showStep(index) {
        steps.forEach((step, i) => {
            step.classList.toggle('active', i === index);
        });
    }

    document.querySelectorAll('.next-step').forEach(btn => {
        btn.addEventListener('click', () => {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        });
    });

    document.querySelectorAll('.prev-step').forEach(btn => {
      btn.addEventListener('click', () => {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
      });
    });
</script>
</body>
</html>
