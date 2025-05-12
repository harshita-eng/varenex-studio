<!DOCTYPE html>
<html>
  <head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
      body {
        background-color: #f8f9fa;
      }

      .editor-container {
        padding: 30px;
      }

      .toolbar {
        margin-bottom: 20px;
      }

      .canvas-area {
        position: relative;
        background-color: #ffffff;
        border: 1px solid #ced4da;
        border-radius: 6px;
        min-height: 600px;
        overflow: auto;
      }

      .er-table {
        position: absolute;
        background: #ffffff;
        border: 1px solid #ced4da;
        border-radius: 6px;
        padding: 10px;
        min-width: 200px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
      }

      .er-table .header {
        background-color: #d4edda;
        border-radius: 4px;
        padding: 4px 8px;
        margin-bottom: 6px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .tbl-name {
        font-weight: bold;
        color: #155724;
      }

      .cols {
        padding: 0;
        margin: 0;
        list-style: none;
      }

      .cols li {
        margin-bottom: 6px;
        padding: 4px 6px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 4px;
        background-color: #f8f9fa;
      }

      .col-info {
        display: flex;
        align-items: center;
        gap: 6px;
      }

      .key-type {
        font-size: 16px;
        width: 20px;
        text-align: center;
        color: #6c757d;
      }

      .col-name {
        font-size: 14px;
      }

      .cols button {
        background: none;
        border: none;
        font-size: 13px;
        margin-left: 4px;
        cursor: pointer;
      }

      .cols button:hover {
        opacity: 0.7;
      }

      .btn-sm {
        font-size: 12px !important;
      }
    </style>
  </head>
  <body>
    <!-- View Tables and mappings -->
    <div class="container editor-container">
      <div class="toolbar d-flex justify-content-between align-items-center">
        <h4>ER Diagram Editor</h4>
        <div>
          <button id="addTableBtn" class="btn btn-outline-success me-2" id="createTable">＋ Create Table</button>
          <button id="save-schema" class="btn btn-primary" id="saveDiagram">💾 Save Diagram</button>
        </div>
      </div>
      <div class="canvas-area" id="canvas"></div>
    </div>

    <!-- <div id="canvas" style="position:relative; width:100%; height:80vh; background:#f9f9f9; overflow:hidden;"></div>
    <div class="mt-4">
      <button id="save-schema" class="btn btn-danger text-black rounded">Save Diagram</button>
      <button id="addTableBtn" class="btn btn-primary text-black rounded">➕ Table</button>
    </div> -->

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
                  <input type="text" class="form-control" id="colName" required>
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
    <!-- End column  -->

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
    <!-- End Column -->

    <script>
      var ER = @json(json_decode($erJson, true));
      var csrf = '{{ csrf_token() }}';
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                  <button class="btn btn-outline-secondary btn-sm edit-table" title="Edit Table">✎</button>
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
                    <button class="text-primary edit-col" style="font-size:11px">✎</button>
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
        $canvas.on('click','.edit-table',function(){
          let $t     = $(this).closest('.er-table'),
              id     = $t.data('id'),
              tblObj = ER.tables.find(t=>t.id===id),
              name   = prompt('Table name:', tblObj.name);
          if(!name) return;
          tblObj.name = name;
          $t.find('.tbl-name').text(name);
        });

        // add column
        // $canvas.on('click','.add-col',function(){
        //   let $t      = $(this).closest('.er-table'),
        //       id      = $t.data('id'),
        //       tblObj  = ER.tables.find(t=>t.id===id),
        //       colName = prompt('Column name:'),
        //       colType = prompt('Type:', 'VARCHAR(255)');
        //   if(!colName||!colType) return;
        //   let colId = `${id}.${colName}`;
        //   let newCol = { id:colId, name:colName, type:colType, primary:false };
        //   tblObj.columns.push(newCol);
        //   render();
        // });

        // delete column
        $canvas.on('click','.del-col',function(){
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

        // edit column
        // $canvas.on('click','.edit-col',function(){
        //   let $li     = $(this).closest('li'),
        //       colId   = $li.data('col-id'),
        //       [tblId] = colId.split('.'),
        //       tblObj  = ER.tables.find(t=>t.id===tblId),
        //       colObj  = tblObj.columns.find(c=>c.id===colId),
        //       name    = prompt('Column name:', colObj.name),
        //       type    = prompt('Type:', colObj.type);
        //   if(!name||!type) return;
        //   colObj.name = name;
        //   colObj.type = type;
        //   // update its id so relationships stay accurate
        //   let newId = `${tblId}.${name}`;
        //   ER.relationships.forEach(r=>{
        //     if(r.from===colId) r.from = newId;
        //     if(r.to  ===colId) r.to   = newId;
        //   });
        //   colObj.id = newId;
        //   render();
        // });

        // add relationship: click to select src, then click target
        let srcCol = null;
        $canvas.on('click','.col-name',function(){
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
        $svg.on('click','line',function(){
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

        $('#save-schema').click(function(){
          $.ajax({
            url:   '{{ route("erd.save") }}',
            method:'POST',
            data:  { er: JSON.stringify(ER), _token:csrf },
            success(){
              alert('Diagram saved!');
            },
            error(){
              alert('Save failed.');
            }
          });
        });
      });

      // Add table and columns
      
    </script>
    @stack('scripts')
  </body>
</html>
