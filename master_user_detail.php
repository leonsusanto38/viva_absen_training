<?php 
require 'header.php';

$roleOptions = GetRoleOptions();

$name = "";
$nik = "";
$password = "";
// $role = "";
// $status = "";

$errorMessage = "";
$successMesssage = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST["name"];
  $nik = $_POST["nik"];
  $password = $_POST["password"];
  // $role = $_POST["role"] ?? '';
  // $status = $_POST["status"] ?? '';

  $data = {$name, $nik, $password}

  AddUser($data);

  $successMessage = "User berhasil disimpan";

  $name = "";
  $nik = "";
  $password = "";
}
?>

<button type="button" class="btn btn-secondary" m-3 onclick="window.location.href='master_user.php'">
  &larr; Back
</button>

<h1 class="h1 my-3">Master User Detail</h1>

<?php
if(!empty($errorMessage)) {
  echo "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong>$errorMessage</strong>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
  ";
}

if(!empty($successMessage)) {
  echo "
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>$successMessage</strong>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
  ";
}
?>

<form method="post">
  <div class="form-floating mb-3">
    <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?= $name ?>" required>
    <label for="name">Name</label>
  </div>
  <div class="form-floating mb-3">
    <input type="number" class="form-control" id="nik" name="nik" placeholder="nik" value="<?= $nik ?>" required>
    <label for="nik">NIK</label>
  </div>
  <div class="form-floating mb-3">
    <input type="text" class="form-control" id="password" name="password" placeholder="password"  value="<?= $password ?>" required>
    <label for="password">Password</label>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="created_at" placeholder="Created at" disabled>
        <label for="created_at">Created at</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="created_by" placeholder="Created by" disabled>
        <label for="created_by">Created by</label>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="updated_at" placeholder="Updated at" disabled>
        <label for="updated_at">Updated at</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="updated_by" placeholder="Updated by" disabled>
        <label for="updated_by">Updated by</label>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-floating mb-3">
        <select class="form-select" id="role">
          <option selected>== Pilih Role ==</option>
          <?php foreach($roleOptions as $option) : ?>
          <option><?= $option["name"] ?></option>
          <?php endforeach; ?>
        </select>
        <label for="role" class="col-form-label">Role:</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating mb-3">
        <select class="form-select" id="status">
          <option selected>Active</option>
          <option>Inactive</option>
        </select>
        <label for="status" class="col-form-label">Status:</label>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-center mt-3">
    <button type="submit" class="btn btn-primary px-5">Save</button>
  </div>
</form>

<?php 
require 'footer.php';
?>