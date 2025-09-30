<?php
require 'header.php';
?>

<form method="post" class="col-4 mx-auto">
  <div class="mb-3">
    <label for="nik" class="form-label">NIK</label>
    <input type="number" class="form-control" id="nik" required>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="remember">
    <label class="form-check-label" for="rembemer">Remember me</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  
<?php
require 'footer.php';
?>