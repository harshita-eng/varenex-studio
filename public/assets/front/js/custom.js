setTimeout(() => {
  const alerts = document.querySelectorAll('.alert');
  alerts.forEach(alert => {
    alert.classList.remove('show');
  });
}, 2000); // 4 seconds

// onbaord form js 
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

// Departmets , roles and users js
  // departments and user role
  let departmentIndex = 0;
  const permissionsList = ['create', 'read', 'update', 'delete'];

  $(document).on('click','#addDepartmentBtn',function() {
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

// ER DIAGARMS JS
