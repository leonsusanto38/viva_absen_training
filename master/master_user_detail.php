<?php 
if($_SERVER['REQUEST_METHOD'] == 'GET') {
  if(isset($_GET["id"])) {
    $headTitle = "User Detail - ";
    
  } else {
    $headTitle = "Add User - ";
  }
}
require '../header.php';

$roleOptions = GetRoleOptions();

$id = "";
$name = "";
$nik = "";
$password = "";
$created_at = "";
$created_by = "";
$updated_at = "";
$updated_by = "";
$role = "";
$active = "";

$errorMessage = "";
$successMesssage = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(!isset($_GET["id"])) { // id tidak ada -> create user
    $name = $_POST["name"];
    $nik = $_POST["nik"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $active = $_POST["active"];

    $data = [
      'name' => $name,
      'nik' => $nik,
      'password' => $password,
      'created_by' => $_SESSION["uid"],
      'role' => $role,
      'active' => $active
    ];

    $result = CreateUser($data);

    if($result === true) {
      $_SESSION['successMessage'] = "User berhasil disimpan";

      $name = "";
      $nik = "";
      $password = "";
      $role = "";
      $active = "";

      header("location: master_user.php");
      exit;
    } else {
      $errorMessage = $result;
    }

    $name = "";
    $nik = "";
    $password = "";
    $role = "";
    $active = "";
  } else { // id ada -> update user
    $id = $_POST["id"];
    $name = $_POST["name"];
    $nik = $_POST["nik"];
    $password = $_POST["password"];
    $updated_by = $_SESSION["uid"];
    $role = $_POST["role"];
    $active = $_POST["active"];

    $data = [
      'id' => $id,
      'name' => $name,
      'nik' => $nik,
      'password' => $password,
      'updated_by' => $updated_by,
      'role' => $role,
      'active' => $active
    ];

    $result = UpdateUser($data);

    if($result === true) {
      $_SESSION['successMessage'] = "User berhasil diupdate";

      $id = "";
      $name = "";
      $nik = "";
      $password = "";
      $updated_by = "";
      $role = "";
      $active = "";

      header("location: master_user.php");
      exit;
    } else {
      $errorMessage = $result;
    }
  }
  
} else if($_SERVER['REQUEST_METHOD'] == 'GET') {
  if(isset($_GET["id"])) {
    $_SESSION["TITLE"] = "User Detail";
    $_SESSION["SAVE"] = "mengupdate";
    $id = $_GET["id"];
    $result = GetUserById($id);
    if(count($result) == 0) {
      header("location: master_user.php");
      exit;
    }
    $user = $result[0];
    $name = $user["name"];
    $nik = $user["nik"];
    $password = $user["password"];
    $created_at = $user["created_at"];
    $created_by = $user["created_by"];
    $updated_at = $user["updated_at"];
    $updated_by = $user["updated_by"];
    $role = $user["role_id"];
    $active = $user["active"];
  } else {
    $_SESSION["TITLE"] = "Add User";
    $_SESSION["SAVE"] = "menambahkan";
  }
}
?>

<button type="button" class="btn btn-secondary" m-3 onclick="window.location.href='master_user.php'">
  &larr; Back
</button>

<h1 class="h1 my-3"><?= $_SESSION["TITLE"] ?></h1>

<?php
if(!empty($errorMessage)) {
  echo "
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
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
  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="form-floating mb-3">
    <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?= $name ?>" required>
    <label for="name">Name</label>
  </div>
  <div class="form-floating mb-3">
    <input type="number" class="form-control" id="nik" name="nik" placeholder="nik" value="<?= $nik ?>" required>
    <label for="nik">NIK</label>
  </div>
  <div class="form-floating mb-3">
    <input type="text" class="form-control" id="password" name="password" placeholder="password" value="<?= $password ?>">
    <label for="password">Password</label>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="created_at" name="created_at" placeholder="Created at" value="<?= $created_at ?>" disabled>
        <label for="created_at">Created at</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="created_by" name="created_by" placeholder="Created by" value="<?= $created_by ?>" disabled>
        <label for="created_by">Created by</label>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="updated_at" name="updated_at" placeholder="Updated at" value="<?= $updated_at ?>" disabled>
        <label for="updated_at">Updated at</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="updated_by" name="updated_by" placeholder="Updated by" value="<?= $updated_by ?>" disabled>
        <label for="updated_by">Updated by</label>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-floating mb-3">
        <select class="form-select" id="role" name="role" required>
          <option value="" selected>== Pilih Role ==</option>
          <?php foreach($roleOptions as $option) : ?>
          <option value="<?= $option["id"] ?>" <?= ($option["id"] == $role) ? 'selected' : '' ?>><?= $option["name"] ?></option>
          <?php endforeach; ?>
        </select>
        <label for="role" class="col-form-label">Role:</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating mb-3">
        <select class="form-select" id="active" name="active" required>
          <option value="y" <?= ($active == 'y') ? 'selected' : '' ?> selected>Active</option>
          <option value="n" <?= ($active == 'n') ? 'selected' : '' ?>>Inactive</option>
        </select>
        <label for="active" class="col-form-label">Status:</label>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-center mt-3">
    <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#confirmSaveModal">
      Save
    </button>
  </div>

  <div class="modal fade" id="confirmSaveModal" tabindex="-1" aria-labelledby="confirmSaveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmSaveModalLabel">Konfirmasi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin <?= $_SESSION["SAVE"] ?> data ini?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <!-- Tombol Submit Form -->
          <button type="submit" class="btn btn-primary" id="confirmSaveBtn">Ya</button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php 
require '../footer.php';
?>