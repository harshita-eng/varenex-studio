@extends('Front.layout.front_layout')
@section('content')

<section id="starter-section" class="starter-section section">
  <div class="container section-title" data-aos="fade-up">
    <p style="font-size:26px;">Effortlessly onboard your company and unlock new opportunities !</p>
  </div>
  <div class="container" data-aos="fade-up" style="margin-top: -70px;">
    <!-- onboard form -->
    <div class="onboarding-container">
      <div class="onboarding-left">
        <!-- Step Indicator with Icons and Improved Design -->
        <div class="step-description">Follow the steps below to complete your company onboarding process</div>
        <!-- active steps -->
        <!-- <div class="step-indicator" id="stepIndicator">
          <span class="step active"><i class="bi bi-check-lg"></i></span>
          <span class="step"><i class="bi bi-check-lg"></i></span>
          <span class="step"><i class="bi bi-check-lg"></i></span>
          <span class="step"><i class="bi bi-check-lg"></i></span>
          <span class="step"><i class="bi bi-check-lg"></i></span>
        </div> -->
        <div class="d-flex justify-content-center">
            <div class="step-indicator">
                <div class="step-dot active" data-step="1"></div>
                <div class="step-dot" data-step="2"></div>
                <div class="step-dot" data-step="3"></div>
                <div class="step-dot" data-step="4"></div>
                <div class="step-dot" data-step="5"></div>
                <div class="step-dot" data-step="6"></div>
                <div class="step-dot" data-step="7"></div>
                <div class="step-dot" data-step="8"></div>
                <div class="step-dot" data-step="9"></div>
                <div class="step-dot" data-step="10"></div>
            </div>
        </div>

        <!-- Form Steps -->
        <form id="onboardingForm" action="{{ route('onboardsubmit') }}" method="POST" enctype="multipart/form-data">
        @csrf
          <!-- Step 1: Company Details -->
          <div class="step active" id="step1">
              <h4 class="step-title">Step 1: Organization Details</h4>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Organization Name</label>
                  <input type="text" class="form-control" name="company_name" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Director / Owner Name</label>
                  <input type="text" class="form-control" name="director_name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Industry</label>
                    <input type="text" class="form-control" name="industry">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Number of Employees</label>
                    <select class="form-select" name="company_size">
                        <option>1-10</option>
                        <option>11-50</option>
                        <option>51-200</option>
                        <option>201-500</option>
                        <option>500+</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Website Url</label>
                    <input type="url" class="form-control" name="website">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Company Logo</label>
                    <input type="file" class="form-control" name="logo">
                </div>
              </div>
              <button type="button" class="btn btn-primary next-step" id="nextBtn">Next</button>
          </div>

          <!-- Step 2: Address & Contact -->
          <div class="step" id="step2">
            <div class="row">
              <h4 class="step-title">Step 2: Address & Contact</h4>
              <div class="col-md-6 mb-3">
                  <label class="form-label">Address Line 1</label>
                  <input type="text" class="form-control" name="address1">
              </div>
              <div class="col-md-6 mb-3">
                  <label class="form-label">Address Line 2</label>
                  <input type="text" class="form-control" name="address2">
              </div>
              <div class="col-md-6 mb-3">
                  <label class="form-label">City</label>
                  <input type="text" class="form-control" name="city">
              </div>
              <div class="col-md-6 mb-3">
                  <label class="form-label">State/Province</label>
                  <input type="text" class="form-control" name="state">
              </div>
              <div class="col-md-6 mb-3">
                  <label class="form-label">Zip Code</label>
                  <input type="text" class="form-control" name="zip">
              </div>
              <div class="col-md-6 mb-3">
                  <label class="form-label">Country</label>
                  <input type="text" class="form-control" name="country">
              </div>
              <div class="col-md-6 mb-3">
                  <label class="form-label">Phone Number</label>
                  <input type="text" class="form-control" name="phone">
              </div>
              <div class="col-md-6 mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" name="email">
              </div>
            </div>
              <button type="button" class="btn btn-secondary btn-back prev-step">Back</button>
              <button type="button" class="btn btn-primary btn-next next-step">Next</button>
          </div>

          <!-- Step 3: Admin Setup -->
          <div class="step" id="step3">
            <div class="row">
              <h4 class="step-title">Step 3: Account Settings</h4>
              <div class="col-md-6 mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="admin_name">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="admin_email">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="admin_phone">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Designation</label>
                <input type="text" class="form-control" name="admin_role">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="admin_password">
              </div>
              <div class="col-md-6 mb-3">
                  <label class="form-label">Currency</label>
                  <input type="text" class="form-control" name="currency">
              </div>
              <div class="col-md-6 mb-3">
                  <label class="form-label">Language</label>
                  <input type="text" class="form-control" name="language">
              </div>
              <div class="col-md-6 mb-3">
                  <label class="form-label">Communication Preference</label>
                  <select class="form-select" name="communication">
                      <option>Email</option>
                      <option>SMS</option>
                      <option>In-app</option>
                  </select>
              </div>
            </div>
            <button type="button" class="btn btn-secondary btn-back prev-step">Back</button>
            <button type="button" class="btn btn-primary btn-next next-step">Next</button>
          </div>

          <!-- Step 4: Settings -->
          <div class="step" id="step4">
            <h4 class="step-title">Step 4: Billing & Plan</h4>
              <div class="row">
              <div class="col-md-6 mb-3">
                  <label class="form-label">Subscription Plan</label>
                  <select class="form-select" name="plan">
                      <option>Basic</option>
                      <option>Pro</option>
                      <option>Enterprise</option>
                  </select>
              </div>
              <div class="col-md-6 mb-3">
                  <label class="form-label">Billing Address</label>
                  <input type="text" class="form-control" name="billing_address">
              </div>
              <div class="col-md-6 mb-3">
                  <label class="form-label">Tax ID / VAT</label>
                  <input type="text" class="form-control" name="tax_id">
              </div>
              <div class="col-md-6 mb-3">
                  <label class="form-label">Billing Email</label>
                  <input type="email" class="form-control" name="billing_email">
              </div>
            </div>
            <button type="button" class="btn btn-secondary btn-back prev-step">Back</button>
            <button type="button" class="btn btn-primary btn-next next-step">Next</button>
          </div>

          <!-- Step 5: verification -->
          <div class="step" id="step5">
            <h4 class="step-title">Step 5: Verification</h4>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Business Registration</label>
                <input type="file" class="form-control" name="busniess_registration">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">PAN / TAX Identification Number</label>
                <input type="file" class="form-control" name="busniess_registration">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">GST / VAT Registration Certificate</label>
                <input type="file" class="form-control" name="registration_certificate">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Company License</label>
                <input type="file" class="form-control" name="company_license">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Director / Owner Govertment Identification</label>
                <input type="file" class="form-control" name="director_id">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Director / Owner Address Proof</label>
                <input type="file" class="form-control" name="address_proof">
              </div>
            </div>
            <button type="button" class="btn btn-secondary btn-back prev-step">Back</button>
            <button type="button" class="btn btn-primary btn-next next-step">Next</button>
          </div>

          <!-- Step 6: verification -->
          <div class="step" id="step6">
            <h4 class="step-title">Step 6: Departments & Roles</h4>
            <div class="row">
              <div class="mb-3">
                <label class="form-label">Add Departments & Roles</label>
                <div id="departmentsContainer"></div>
                <button type="button" class="btn btn-outline-primary mb-4" id="addDepartmentBtn">+ Add Department</button></br>
              </div>
            </div>
            <button type="button" class="btn btn-secondary btn-back prev-step">Back</button>
            <button type="button" class="btn btn-primary btn-next next-step">Next</button>
          </div>

          <!-- Step 7: Process -->
          <div class="step" id="step7">
            <h4 class="step-title"> Step 7: How would you like to create ? </h4>
              <div class="mb-3">
                <input class="form-check-input radio-select" type="radio" name="source_type" id="option1" value="scratch">
                <label class="form-check-label" for="flexCheckDefault">
                  Create from scratch
                </label>
              </div>
              <div class="mb-3">
                <input class="form-check-input radio-select" type="radio" name="source_type" id="option2" value="gallery">
                <label class="form-check-label" for="flexCheckChecked">
                  Pick from gallery
                </label>
              </div>

              <div class="mb-3">
                <input class="form-check-input radio-select" type="radio" name="source_type" id="option3" value="csv">
                <label class="form-check-label" for="flexCheckChecked">
                  Import csv
                </label>
              </div>

              <div class="col-md-6 mb-3 csv-import" style="display:none;">
                <label class="form-label">Upload File</label>
                <input type="file" class="form-control" name="import_csv" id="csv">
              </div>

              <button type="button" class="btn btn-secondary btn-back prev-step">Back</button>
              <button type="button" class="btn btn-primary btn-next next-step">Next</button>
          </div>

          <!-- Step 8: Process -->
          <div class="step" id="step7">
            <h4 class="step-title"> Step 8: Select Workflow </h4>
              <div class="mb-3 checkbox-box" onclick="toggleCheck(this)">
                <input type="checkbox" name="items[]" value="inventory" />
                <span>Inventory Management</span>
              </div>

              <div class="checkbox-box" onclick="toggleCheck(this)">
                <input type="checkbox" name="items[]" value="order" />
                <span>Order Management</span>
              </div>

              <div class="checkbox-box" onclick="toggleCheck(this)">
                <input type="checkbox" name="items[]" value="vendor" />
                <span>Vendor Management</span>
              </div></br>

              <div class="checkbox-box" onclick="toggleCheck(this)">
                <input type="checkbox" name="items[]" value="distributor" />
                <span>Distributor Management</span>
              </div>

              <div class="checkbox-box" onclick="toggleCheck(this)">
                <input type="checkbox" name="items[]" value="employee" />
                <span>Employee Management</span>
              </div>

              <div class="checkbox-box" onclick="toggleCheck(this)">
                <input type="checkbox" name="items[]" value="appointment" />
                <span>Appointment Management</span>
              </div></br>

              <div class="checkbox-box" onclick="toggleCheck(this)">
                <input type="checkbox" name="items[]" value="finance" />
                <span>Finance & Accounting</span>
              </div>

              <div class="checkbox-box" onclick="toggleCheck(this)">
                <input type="checkbox" name="items[]" value="hr" />
                <span>HR Operations</span>
              </div>

              <div class="checkbox-box" onclick="toggleCheck(this)">
                <input type="checkbox" name="items[]" value="admin" />
                <span>Strategic & Administrative</span>
              </div></br></br>

              <!-- <div class="mb-3">
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
              </div> -->

              <button type="button" class="btn btn-secondary btn-back prev-step">Back</button>
              <button type="button" class="btn btn-primary btn-next next-step">Next</button>
          </div>

          <!-- step 9 : ER Diagrams -->
          <div class="step" id="step9">
            <h4 class="step-title">Step 8: Relations and Mappings</h4>
              <div class="container editor-container">
                <div class="toolbar d-flex justify-content-between align-items-center">
                  <div>
                    <button id="addTableBtn" class="btn btn-outline-success me-2" id="createTable">＋ Create Table</button>
                    <button id="save-schema" class="btn btn-primary" id="saveDiagram">💾 Save Diagram </button>
                  </div>
                </div>
                <div class="canvas-area" id="canvas"></div>
              </div>
            <button type="button" class="btn btn-secondary btn-sm prev-step">Back</button>
            <button type="button" class="btn btn-primary btn-sm next-step">Next</button>
          </div>

          <!-- Step 10: Review -->
          <div class="step" id="step10">
            <h4 class="step-title">Step 9: Final Setup</h4>
            <div class="col-md-6 mb-3">
              <label class="form-label"> Application Name </label>
              <input type="text" class="form-control" name="app_name" placeholder="Name" required>
            </div>
            <button type="button" class="btn btn-secondary prev-step">Back</button>
            <button type="button" class="btn btn-primary next-step">Next</button>
          </div>

          <!-- Step 11: Review -->
          <div class="step" id="step11">
            <h4 class="step-title">Step 10: Review & Confirm</h4>
            <p>All data will be reviewed on submit (or show summary via JS).</p>
            <button type="button" class="btn btn-secondary prev-step">Back</button>
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
      </form>
    </div>

      <!-- Right section  -->
      <div class="onboarding-right">
        <img src="{{ asset('assets/front/onboarding.png')}}" alt="Onboarding Icon">
      </div>
    </div>
  </div>
</section>

<!-- Edit table column -->
<div class="modal fade" id="columnModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="columnForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Column</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="colTableId">
          <input type="hidden" id="colId">
          <div class="form-group">
            <label for="colName">Column Name</label>
            <input type="text" class="form-control" id="colName">
          </div>
          <div class="form-group">
            <label for="colType">Data Type</label>
            <select class="form-control" id="colType">
              <option value="INT">INT</option>
              <option value="BIGINT">BIGINT</option>
              <option value="VARCHAR(255)">VARCHAR(255)</option>
              <option value="TEXT">TEXT</option>
              <option value="BOOLEAN">BOOLEAN</option>
              <option value="DATE">DATE</option>
              <option value="DATETIME">DATETIME</option>
              <option value="FLOAT">FLOAT</option>
              <option value="DECIMAL(10,2)">DECIMAL(10,2)</option>
              <option value="TIME">TIME</option>
              <option value="YEAR">YEAR</option>
              <option value="CHAR(1)">CHAR(1)</option>
              <option value="JSON">JSON</option>
              <option value="ENUM('a','b')">ENUM('a','b')</option>
            </select>
          </div>

          <!-- <div class="form-group">
            <label for="editColFk">Foreign Key Reference</label>
            <select id="editColFk" class="form-control">
              <option value="">-- None --</option>>
            </select>
          </div> -->
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="colPK">
            <label class="form-check-label" for="colPK">Primary Key</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Column</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Add Table Modal -->
<div class="modal fade" id="tableModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="tableForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Table</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="tableName">Table Name</label>
            <input type="text" class="form-control" id="tableName" required>
          </div>
          <hr>
          <div id="tableColumns">
            <!-- Dynamically added column fields here -->
          </div>
          <button type="button" id="addTableColumnBtn" class="btn btn-sm btn-secondary">➕ Add Column</button>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Create Table</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

<link href="{{ asset('assets/front/css/onboard.css') }}" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  var ER = @json(json_decode($erJson, true));
  var csrf = '{{ csrf_token() }}';
</script>
<script>
$(function()
{         
  // open add new table modal popup
  $('#addTableBtn').on('click', function () {
    $('#tableName').val('');
    $('#tableColumns').html('');
    addTableColumn(); // Add one column input by default
    $('#tableModal').modal('show');
  });

  // Add a new column input row while adding a new table
  $('#addTableColumnBtn').on('click', function () {
    addTableColumn();
  });

  // open modal popup to add a new table and schema 
  function addTableColumn() {
    const existingColumns = ER.tables.flatMap(t =>
      t.columns.map(c => `${t.name}.${c.name}`)
    );

    const refOptions = ['<option value="">-- None --</option>'];
    existingColumns.forEach(col => {
      refOptions.push(`<option value="${col}">${col}</option>`);
    });

    const index = $('#tableColumns .table-col-row').length;
    const html = `
    <div class="table-col-row mb-3 border p-2">
      <div class="d-flex mb-1">
        <input type="text" class="form-control col-name mr-2" placeholder="Column name" required>
        <select class="form-control col-type mr-2">
          <option value="INT">INT</option>
          <option value="VARCHAR(255)">VARCHAR(255)</option>
          <option value="TEXT">TEXT</option>
          <option value="BOOLEAN">BOOLEAN</option>
        </select>
        <div class="form-check form-check-inline mt-1">
          <input class="form-check-input col-pk" type="checkbox">
          <label class="form-check-label">PK</label>
        </div>
      </div>
      <div>
        <label>Foreign Key Reference</label>
        <select class="form-control col-fk">
          ${refOptions.join('')}
        </select>
      </div>
    </div>`;
    $('#tableColumns').append(html);
  }

  // Submit new table
  $('#tableForm').on('submit', function (e) {
    e.preventDefault();
    const name = $('#tableName').val().trim();
    if (!name) return alert('Table name is required.');

    const columns = [];
    const newRelationships = [];
    $('#tableColumns .table-col-row').each(function () {
      const colName = $(this).find('.col-name').val().trim();
      const colType = $(this).find('.col-type').val();
      const isPK = $(this).find('.col-pk').is(':checked');
      const fkRef = $(this).find('.col-fk').val();
      if (colName) {
        const fullId = `${name}.${colName}`;
        columns.push({
          id: `${name}.${colName}`,
          name: colName,
          type: colType,
          primary: isPK
        });
        if (fkRef) {
        newRelationships.push({
          from: fullId,
          to: fkRef
        });
      }
      }
    });

    if (columns.length === 0) return alert('At least one column is required.');
    ER.tables.push({
      id: name,
      name: name,
      columns: columns
    });

    $('#tableModal').modal('hide');
    render(); // re-render diagram
    //drawRelationships(); // re-draw lines
  });

  // Add Column button to add a new column in the existing table 
  $('#canvas').on('click', '.add-col', function () {
    const tableId = $(this).closest('.er-table').data('id');
    $('#columnModal .modal-title').text('Add Column');
    $('#colTableId').val(tableId);
    $('#colId').val('');
    $('#colName').val('');
    $('#colType').val('VARCHAR(255)');
    $('#colPK').prop('checked', false);
    $('#columnModal').modal('show');
  });

  // Edit Column Button to edit a column in the existing table 
  $('#canvas').on('click', '.edit-col', function () {
    const $li = $(this).closest('li');
    const colId = $li.data('col-id');
    const [tableId] = colId.split('.');
    const table = ER.tables.find(t => t.id === tableId);
    const col = table.columns.find(c => c.id === colId);
    const fullId = `${tableId}.${colName}`;

    $('#columnModal .modal-title').text('Edit Column');
    $('#colTableId').val(tableId);
    $('#colId').val(colId);
    $('#colName').val(col.name);
    $('#colType').val(col.type);
    $('#colPK').prop('checked', !!col.primary);
    const $fkSelect = $('#editColFk');
    $fkSelect.html('<option value="">-- None --</option>');
    ER.tables.forEach(t => {
      t.columns.forEach(c => {
        const ref = `${t.name}.${c.name}`;
        if (ref !== fullId) {
          const selected = ER.relationships.some(rel => rel.from === fullId && rel.to === ref);
          $fkSelect.append(`<option value="${ref}" ${selected ? 'selected' : ''}>${ref}</option>`);
        }
      });
    });

    $('#columnModal').modal('show');
  });

  // Save Column
  $('#columnForm').submit(function (e) 
  {
    e.preventDefault();  
    const tableId  = $('#colTableId').val(); 
    const oldColId = $('#colId').val(); 
    const name   = $('#colName').val().trim(); 
    const type   = $('#colType').val(); 
    const isPK   = $('#colPK').is(':checked'); 
    //const fkRef  = $('#editColFk').val(); 
    const table  = ER.tables.find(t => t.id === tableId); 
    //const column = table.columns.find(c => c.name === oldColId); console.log(column); false;

    if (!name) return alert('Column name is required.');
    //if (!column) return;

    const oldFullId = `${tableId}.${oldColId}`; 
    //const newFullId = `${tableId}.${newName}`;

    if (oldColId) {
      const col = table.columns.find(c => c.id === oldColId);
      const newColId = `${tableId}.${name}`;
      col.name = name;
      col.type = type;
      col.primary = isPK;

      // Update relationships pointing TO this column if name changed
      ER.relationships.forEach(rel => {
        if (rel.to === oldFullId) {
          rel.to = newFullId;
        }
      });

      col.id = newColId;
    } else {
      const newCol = {
        id: `${tableId}.${name}`,
        name: name,
        type: type,
        primary: isPK
      };
      table.columns.push(newCol);
    }
    $('#columnModal').modal('hide');
    render(); // re-render diagram
  });

  // delete complete table
  $(document).on('click', '.delete-table', function () 
  {
    const tableId = $(this).data('table-id');
    const confirmDelete = confirm(`Are you sure you want to delete table "${tableId}"?`);

    if (!confirmDelete) return;

    // Remove table
    ER.tables = ER.tables.filter(t => t.id !== tableId);

    // Remove any related relationships
    ER.relationships = ER.relationships.filter(rel => {
      return !rel.from.startsWith(`${tableId}.`) && !rel.to.startsWith(`${tableId}.`);
    });
    render();
    drawRelationships();
  });

  const $canvas = $('#canvas');
  const svgNS   = "http://www.w3.org/2000/svg";
  // helper: redraw all FK lines
  let $svg = $('<svg>')
    .attr({ width:'100%', height:'100%', style:'position:absolute;top:0;left:0;pointer-events:none' })
    .appendTo($canvas);

  function redraw() {
    $svg.empty();
    ER.relationships.forEach(rel=>{
      let [fromT,fromC] = rel.from.split('.');
      let [toT,toC]     = rel.to.split('.');
      let $from = $(`.er-table[data-id="${fromT}"] li[data-col-id="${rel.from}"]`);
      let $to   = $(`.er-table[data-id="${toT}"]   li[data-col-id="${rel.to}"]`);
      if(!$from.length||!$to.length) return;
      let p1 = $from.offset(), p2 = $to.offset();
      let x1 = p1.left + $from.outerWidth(), y1 = p1.top + $from.outerHeight()/2;
      let x2 = p2.left,                    y2 = p2.top + $to.outerHeight()/2;

      let line = document.createElementNS(svgNS,'line');
      $(line).attr({ x1,y1,x2,y2, stroke:'#4299E1','stroke-width':2 });
      $svg.append(line);
    });
  }

  // render tables & columns
  function render() {
    $canvas.find('.er-table').remove();
    ER.tables.forEach(tbl=>{
      let $t = $(`
        <div class="er-table ui-draggable ui-draggable-handle" data-id="${tbl.id}" style="top:${tbl.y}px; left:${tbl.x}px;">
          <div class="header">
            <span class="tbl-name">${tbl.name}</span>
            <button class="btn btn-outline-info btn-sm edit-table" title="Edit Table"><i class="bi bi-pencil"></i></button>
          </div>
          <ul class="cols"></ul>
          <div class="d-grid gap-1 mt-2">
            <button class="add-col btn btn-sm btn-outline-primary">＋ Add Column</button>
            <button class="delete-table btn btn-sm btn-outline-danger" data-table-id="${tbl.id}">Delete Table</button>
          </div>
        </div>`);
      $canvas.append($t);

      // make draggable
      $t.draggable({
        containment: 'parent',
        stop(e, ui){
          tbl.x = ui.position.left;
          tbl.y = ui.position.top;
          redraw();
        }
      });

      // columns
      let $ul = $t.find('.cols');
      tbl.columns.forEach(col=>{
        let pk = col.primary ? '🔑 ' : '';
        let $li = $(`
          <li data-col-id="${col.id}">
            <div class="col-info">
              <span class="col-name">${pk}${col.name} (${col.type})</span>
              <span class="key-type" title="Foreign Key">FK</span>
            </div>
            <div>
              <button class="text-primary edit-col"><i class="bi bi-pencil"></i></button>
              <button class="text-danger del-col"><i class="bi bi-trash"></i></button>
            </div>
          </li>`);
        $ul.append($li);
      });
    });
    redraw();
  }
  
  render();

  // ——— inline edits & CRUD —————————————————————————————————

  // table rename
  $canvas.on('click','.edit-table',function()
  {
    let $t     = $(this).closest('.er-table'),
        id     = $t.data('id'),
        tblObj = ER.tables.find(t=>t.id===id),
        name   = prompt('Table name:', tblObj.name);
    if(!name) return;
    tblObj.name = name;
    $t.find('.tbl-name').text(name);
  });

  // delete column
  $canvas.on('click','.del-col',function()
  {
    if(!confirm('Drop this column?')) return;
    let $li     = $(this).closest('li'),
        colId   = $li.data('col-id'),
        [tblId] = colId.split('.'),
        tblObj  = ER.tables.find(t=>t.id===tblId);
    // remove column
    tblObj.columns = tblObj.columns.filter(c=>c.id!==colId);
    // remove any relationships touching it
    ER.relationships = ER.relationships
      .filter(r=>r.from!==colId && r.to!==colId);
    render();
  });

  // add relationship: click to select src, then click target
  let srcCol = null;
  $canvas.on('click','.col-name',function()
  {
    let $li   = $(this).closest('li'),
        colId = $li.data('col-id');

    if(!srcCol) {
      srcCol = colId;
      $(this).css('background','#fffbdd');
    } else if(srcCol!==colId) {
      ER.relationships.push({ from: srcCol, to: colId });
      $('.col-name').css('background','');
      srcCol = null;
      redraw();
    }
  });

  // delete relationship: click line
  $svg.on('click','line',function()
  {
    // find which rel this is by matching coords
    let x1 = +$(this).attr('x1'), y1 = +$(this).attr('y1'),
        x2 = +$(this).attr('x2'), y2 = +$(this).attr('y2');
    ER.relationships = ER.relationships.filter(rel=>{
      let keep = true;
      // compute endpoints again
      let [fT,fC]=rel.from.split('.'), [tT,tC]=rel.to.split('.');
      let $from = $(`.er-table[data-id="${fT}"] li[data-col-id="${rel.from}"]`);
      let $to   = $(`.er-table[data-id="${tT}"]   li[data-col-id="${rel.to}"]`);
      if($from.length && $to.length) {
        let p1=$from.offset(), p2=$to.offset();
        let xx1=p1.left+$from.outerWidth(), yy1=p1.top+$from.outerHeight()/2;
        let xx2=p2.left, yy2=p2.top+$to.outerHeight()/2;
        if(xx1===x1 && yy1===y1 && xx2===x2 && yy2===y2) keep = false;
      }
      return keep;
    });
    redraw();
  });

  // ——— persist back to server ——————————————————————————

  $('#save-schema').click(function() 
  {
    $.ajax({
      url:   '{{ route("erd.save") }}',
      method:'POST',
      data:  { er: JSON.stringify(ER), _token:csrf },
      success() {
        alert('Diagram saved!');
      },
      error() {
        alert('Save failed.');
      }
    });
  });
});

// checkboxes workflow
function toggleCheck(box) {
  const checkbox = box.querySelector('input[type="checkbox"]');
  checkbox.checked = !checkbox.checked;
  box.classList.toggle('checked', checkbox.checked);
}

// show csv file upload field
$(document).on('click', '.radio-select', function() {

  var value = $(this).val();

  if(value == 'csv') {
    $('.csv-import').show();

  } else {
    $('.csv-import').hide();
  }
})
</script>
<style>
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
</style>