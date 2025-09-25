<?php
require 'functions.php';

// ambil data dari tabel users
$users = GetUsers();

$roleOptions = GetRoleOptions();

// ambil data (fetch) user dari objek result
// while($users = mysqli_fetch_assoc($result)){
//   var_dump($users["name"]);
// }
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
    <div class="container mt-5">
      <h1 class="h1">Master User</h1>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add User
      </button>

      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Name</th>
            <th scope="col">NIK</th>
            <th scope="col">Password</th>
            <th scope="col">Role</th>
            <th scope="col">Created At</th>
            <th scope="col">Created By</th>
            <th scope="col">Updated At</th>
            <th scope="col">Updated By</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1 ?>
          <?php if(count($users) > 0) : ?>
            <?php foreach($users as $user) : ?>
              <tr id=<?= $user["id"]; ?>>
                <th scope="row"><?= $i; ?></th>
                <td><?= $user["name"]; ?></td>
                <td><?= $user["nik"]; ?></td>
                <td><?= $user["password"]; ?></td>
                <td><?= $user["role"]; ?></td>
                <td><?= date('j/m/Y, H:i:s', strtotime($user["created_at"])); ?></td>
                <td><?= $user["created_by"]; ?></td>
                <td><?= date('j/m/Y, H:i:s', strtotime($user["updated_at"])); ?></td>
                <td><?= $user["updated_by"]; ?></td>
                <td>
                  <span class="badge bg-<?= $user['active'] ? 'success' : 'secondary' ?>">
                    <?= $user["active"] ? 'ACTIVE' : 'INACTIVE' ?>
                  </span>
                </td>
                <td>
                  <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                </td>
                <?php $i++; ?>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr>
              <td colspan="10" class="text-center">No data available in table</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="name" class="col-form-label">Name:</label>
                <input type="text" class="form-control" id="name">
              </div>
              <div class="mb-3">
                <label for="nik" class="col-form-label">NIK:</label>
                <input type="number" class="form-control" id="nik">
              </div>
              <div class="mb-3">
                <label for="role" class="col-form-label">Role:</label>
                <select class="form-select" aria-label="Default select example">
                  <option selected>== Pilih Role ==</option>
                  <?php foreach($roleOptions as $option) : ?>
                    <option><?= $option["name"] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="status" class="col-form-label">Status:</label>
                <select class="form-select" aria-label="Default select example">
                  <option selected>Active</option>
                  <option>Inactive</option>
                </select>
              </div>
            </form>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
