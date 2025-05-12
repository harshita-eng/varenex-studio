<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Smooth Checkboxes</title>
  <style>
    .checkbox-box {
      display: inline-block;
      width: 40px;
      height: 40px;
      border: 2px solid #007bff;
      border-radius: 5px;
      margin: 5px;
      cursor: pointer;
      position: relative;
      text-align: center;
      transition: background-color 0.2s, color 0.2s;
    }

    .checkbox-box input[type="checkbox"] {
      display: none; /* Hide the checkbox completely */
    }

    .checkbox-box.checked {
      background-color: #007bff;
      color: white;
    }

    .checkbox-box span {
      line-height: 40px;
      font-weight: bold;
      user-select: none;
    }
  </style>
</head>
<body>

<div class="checkbox-box" onclick="toggleCheck(this)">
  <input type="checkbox" name="items[]" value="1" />
  <span>1</span>
</div>

<div class="checkbox-box" onclick="toggleCheck(this)">
  <input type="checkbox" name="items[]" value="2" />
  <span>2</span>
</div>

<div class="checkbox-box" onclick="toggleCheck(this)">
  <input type="checkbox" name="items[]" value="3" />
  <span>3</span>
</div>

<script>
  function toggleCheck(box) {
    const checkbox = box.querySelector('input[type="checkbox"]');
    checkbox.checked = !checkbox.checked;
    box.classList.toggle('checked', checkbox.checked);
  }
</script>

</body>
</html>
