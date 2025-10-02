<?php 
require 'header.php';

$name = $_SESSION["user_name"];
$nik = $_SESSION["nik"];

$id = "";
$current_password = "";
$password = "";
$confirm_password = "";

$errorMessage = "";
$successMesssage = "";

if(isset($_POST["update"])) {
  $id = $_SESSION["uid"];
  $current_password = $_POST["current_password"];
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm_password"];
  
  // Validasi password
  if(ValidatePassword($id, $current_password)) {
    if($password == $confirm_password) {
      $data = [
        'id' => $id,
        'password' => $password
      ];

      $result = UpdateProfile($data);

      if($result === true) {
        $_SESSION['successMessage'] = "Berhasil melakukan Update Profile";

        $id = "";
        $current_password = "";
        $password = "";
        $confirm_password = "";

        header("location: profile.php");
        exit;
      } else {
        $errorMessage = $result;
      }
    } else {
      $errorMessage = "Confirm Password Salah!";
    }
  } else {
    $errorMessage = "Password Sekarang Salah!";
  }
}
?>

<?php
if(isset($_SESSION['successMessage'])) {
  echo "
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>" . $_SESSION['successMessage'] . "</strong>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
  ";

  unset($_SESSION['successMessage']); // Hapus agar tidak muncul lagi saat refresh
}

if(!empty($errorMessage)) {
  echo "
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>$errorMessage</strong>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
  ";
}
?>

<button type="button" class="btn btn-secondary" m-3 onclick="window.location.href='home.php'">
  &larr; Back
</button>

<form method="post" class="col-8 col-md-4 mx-auto">
  <h1 class="h1 my-5 text-center">Profile</h1>

  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="form-floating mb-3">
    <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?= $name ?>" disabled>
    <label for="name">Name</label>
  </div>
  <div class="form-floating mb-3">
    <input type="number" class="form-control" id="nik" name="nik" placeholder="nik" value="<?= $nik ?>" disabled>
    <label for="nik">NIK</label>
  </div>
  <div class="mt-4 mb-2">
    <h7 class="h7">Ubah Password :</h7>
  </div>
  <div class="form-floating mb-3">
    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="current password" required autocomplete="off">
    <label for="current_password">Password Sekarang</label>
  </div>
  <div class="form-floating mb-3">
    <input type="password" class="form-control" id="password" name="password" placeholder="password" required autocomplete="off">
    <label for="password">Password Baru</label>
  </div>
  <div class="form-floating mb-3">
    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="confirm password" required autocomplete="off">
    <label for="confirm_password">Confirm Password Baru</label>
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
          Apakah Anda yakin ingin mengupdate Profile anda?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <!-- Tombol Submit Form -->
          <button type="submit" class="btn btn-primary" id="confirmSaveBtn" name="update">Ya</button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php 
require 'footer.php';
?>