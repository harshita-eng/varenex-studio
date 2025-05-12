<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Complete User Onboarding Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      margin: 0;
      background-color: #f4f7fa;
    }
    .form-step {
      display: none;
    }
    .form-step.active {
      display: block;
    }
    button {
      margin-top: 20px;
      padding: 10px 20px;
      border: none;
      background-color: #4CAF50;
      color: white;
      cursor: pointer;
      border-radius: 5px;
    }
    button:hover {
      background-color: #45a049;
    }
    .form-container {
      width: 100%;
      max-width: 100%;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      background: white;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      margin-bottom: 20px;
      box-sizing: border-box;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
    .progress-bar-container {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }
    .progress-bar {
      width: 100%;
      height: 5px;
      background: #ddd;
      border-radius: 10px;
    }
    .progress-bar > div {
      height: 100%;
      background: #4CAF50;
      border-radius: 10px;
    }
    .form-step h2 {
      text-align: center;
    }
    .back-btn {
      background-color: #f44336;
    }
    .back-btn:hover {
      background-color: #d32f2f;
    }
  </style>
</head>
<body>

<div class="form-container">
  <form id="onboardingForm">
    
    <!-- Progress Bar -->
    <div class="progress-bar-container">
      <div class="progress-bar">
        <div id="progressBar" style="width: 25%;"></div>
      </div>
    </div>

    <!-- Step 1 -->
    <div class="form-step active" id="step-1">
      <h2>Welcome! Let's Get Started</h2>
      <input type="text" name="fullName" placeholder="Enter your full name" required>
      <button type="button" class="next-btn">Next</button>
    </div>

    <!-- Step 2 -->
    <div class="form-step" id="step-2">
      <h2>Account Details</h2>
      <input type="email" name="email" placeholder="Enter your email" required>
      <input type="password" name="password" placeholder="Create a password" required>
      <button type="button" class="back-btn">Back</button>
      <button type="button" class="next-btn">Next</button>
    </div>

    <!-- Step 3 -->
    <div class="form-step" id="step-3">
      <h2>Set Preferences</h2>
      <select name="preference" required>
        <option value="">Select your preference</option>
        <option value="Technology">Technology</option>
        <option value="Fashion">Fashion</option>
        <option value="Food">Food</option>
      </select>
      <button type="button" class="back-btn">Back</button>
      <button type="button" class="next-btn">Next</button>
    </div>

    <!-- Step 4 (Final) -->
    <div class="form-step" id="step-4">
      <h2>Ready to Go!</h2>
      <p>Click Submit to complete your onboarding.</p>
      <button type="button" class="back-btn">Back</button>
      <button type="submit">Submit</button>
    </div>

  </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    var currentStep = 1;
    var totalSteps = 4;

    // Handle next step
    $('.next-btn').click(function() {
      if (currentStep < totalSteps) {
        // Hide current step and show next step
        $('#step-' + currentStep).removeClass('active');
        currentStep++;
        $('#step-' + currentStep).addClass('active');

        // Update progress bar
        var progress = (currentStep / totalSteps) * 100;
        $('#progressBar').css('width', progress + '%');
      }
    });

    // Handle back step
    $('.back-btn').click(function() {
      if (currentStep > 1) {
        // Hide current step and show previous step
        $('#step-' + currentStep).removeClass('active');
        currentStep--;
        $('#step-' + currentStep).addClass('active');

        // Update progress bar
        var progress = (currentStep / totalSteps) * 100;
        $('#progressBar').css('width', progress + '%');
      }
    });

    // Handle form submission
    $('#onboardingForm').submit(function(e) {
      e.preventDefault();
      var formData = $(this).serializeArray();
      var data = {};
      $.each(formData, function(_, field) {
        data[field.name] = field.value;
      });
      console.log('Form Data Submitted:', data);
      alert('Onboarding complete! 🎉 Check the console for submitted data.');
      $(this)[0].reset();
      location.reload(); // Reload or redirect after onboarding
    });
  });
</script>

</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dynamic Fields with Subcategories</title>
  <style>
    .dropdown {
      position: relative;
      display: inline-block;
      margin-bottom: 20px;
    }
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 220px;
      border: 1px solid #ccc;
      z-index: 1;
      padding: 10px;
      border-radius: 8px;
    }
    .dropdown-content label {
      display: block;
      padding: 5px;
    }
    .dropdown:hover .dropdown-content {
      display: block;
    }
    .subcategory-section {
      border: 1px solid #ccc;
      padding: 15px;
      margin-top: 15px;
      border-radius: 8px;
      background: #fafafa;
    }
    .subcategory {
      margin-top: 10px;
    }
    .subcategory input[type="text"] {
      width: 150px;
      margin-left: 10px;
    }
    .edit-btn {
      margin-left: 10px;
    }
  </style>
</head>
<body>

<h2>Select Categories</h2>

<div class="dropdown">
  <button>Select Categories</button>
  <div class="dropdown-content" id="dropdownOptions">
    <!-- Checkbox options will come here -->
  </div>
</div>

<div id="fieldsContainer"></div>

<br><br>
<button onclick="submitForm()">Submit</button>

<script>
  // Example data
  const categories = {
    1: {name: 'Technology', subcategories: ['Software', 'Hardware', 'AI']},
    2: {name: 'Fashion', subcategories: ['Clothing', 'Accessories', 'Footwear']},
    3: {name: 'Food', subcategories: ['Snacks', 'Drinks', 'Desserts']}
  };

  const dropdownOptions = document.getElementById('dropdownOptions');
  const fieldsContainer = document.getElementById('fieldsContainer');
  let selectedOptions = [];

  // Populate dropdown
  for (const [id, cat] of Object.entries(categories)) {
    const label = document.createElement('label');
    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.value = id;
    checkbox.addEventListener('change', handleCategorySelection);
    label.appendChild(checkbox);
    label.append(' ' + cat.name);
    dropdownOptions.appendChild(label);
  }

  function handleCategorySelection(e) {
    const id = e.target.value;
    const checked = e.target.checked;

    if (checked) {
      if (!selectedOptions.includes(id)) {
        selectedOptions.push(id);
        createFieldSection(id);
      }
    } else {
      selectedOptions = selectedOptions.filter(item => item !== id);
      const section = document.getElementById('section-' + id);
      if (section) {
        section.remove();
      }
    }
  }

  function createFieldSection(id) {
    const section = document.createElement('div');
    section.className = 'subcategory-section';
    section.id = 'section-' + id;

    const title = document.createElement('h4');
    title.textContent = 'Subcategories for ' + categories[id].name;
    section.appendChild(title);

    categories[id].subcategories.forEach(subcat => {
      const wrapper = document.createElement('div');
      wrapper.className = 'subcategory';

      const checkbox = document.createElement('input');
      checkbox.type = 'checkbox';
      checkbox.name = `subcategories[${id}][]`;
      checkbox.value = subcat;

      const textField = document.createElement('input');
      textField.type = 'text';
      textField.value = subcat;
      textField.disabled = true;

      const editBtn = document.createElement('button');
      editBtn.type = 'button';
      editBtn.className = 'edit-btn';
      editBtn.textContent = 'Edit';
      editBtn.onclick = function () {
        textField.disabled = !textField.disabled;
        if (!textField.disabled) textField.focus();
      };

      wrapper.appendChild(checkbox);
      wrapper.appendChild(textField);
      wrapper.appendChild(editBtn);

      section.appendChild(wrapper);
    });

    fieldsContainer.appendChild(section);
  }

  function submitForm() {
    const data = {};
    selectedOptions.forEach(id => {
      const checkedSubs = Array.from(document.querySelectorAll(`#section-${id} input[type="checkbox"]:checked`))
        .map(cb => cb.value);
      data[categories[id].name] = checkedSubs;
    });
    console.log('Form Data:', data);
    alert('Check console for form data!');
  }
</script>

</body>
</html>

