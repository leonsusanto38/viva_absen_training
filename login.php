<?php
require 'functions.php';
session_start();

if(isset($_SESSION["login"])) {
  header("location: index.php");
  exit;
}

$errorMessage = "";

if(isset($_POST["login"])) {
  $nik = $_POST["nik"];
  $password = $_POST["password"];

  $result = query("SELECT
                      *
                    FROM users
                    WHERE nik = '$nik'
  ");

  if(count($result) === 1) {
    $row = $result[0];
    if(password_verify($password, $row["password"])) {
      $_SESSION["login"] = true;
      $_SESSION["uid"] = $row["id"];
      $_SESSION["user_name"] = $row["name"];
      $_SESSION["role"] = $row["role_id"] == 1 ? "administrator" : "user" ;
      header("location: index.php");
      exit;
    }
  }

  $errorMessage = "Login Gagal!";
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

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>

  <body>
    <div class="container my-5">
      <form method="post" class="col-8 col-md-6 col-lg-3 mx-auto">
        <h1 class="h1 mb-3">Login</h1>
        <div class="mb-3">
          <label for="nik" class="form-label">NIK</label>
          <input type="number" class="form-control" name="nik" id="nik" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <div class="input-group">
            <input type="password" class="form-control" name="password" id="password" required autocomplete="off">
            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
              👁
            </button>
          </div>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" name="remember" id="remember">
          <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <div class="text-center">
          <button type="submit" name="login" class="btn btn-primary w-50">Login</button>
        </div>
      </form>

      <script>
        const togglePassword = document.querySelector("#togglePassword");
        const passwordField = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
          const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
          passwordField.setAttribute("type", type);

          // ubah icon (optional)
          this.textContent = type === "password" ? "👁" : "🙈";
        });
      </script>

<?php
require 'footer.php';
?>