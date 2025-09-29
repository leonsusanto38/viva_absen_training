<?php
require 'header.php';
// ambil data dari tabel users
$users = GetUsers();

if(isset($_SESSION['successMessage'])) {
  echo "
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>" . $_SESSION['successMessage'] . "</strong>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
  ";

  unset($_SESSION['successMessage']); // Hapus agar tidak muncul lagi saat refresh
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $result = DeleteUser($id);
    if($result === true) {
      $_SESSION['successMessage'] = "User berhasil dihapus!";

      header("location: master_user.php");
      exit;
    } else {
      $errorMessage = $result;
    }
}
?>

<h1 class="h1">Master User</h1>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-3" onclick="window.location.href='master_user_detail.php'">
  Add User
</button>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Name</th>
      <th scope="col">NIK</th>
      <!-- <th scope="col">Password</th> -->
      <th scope="col">Role</th>
      <!-- <th scope="col">Created At</th>
      <th scope="col">Created By</th>
      <th scope="col">Updated At</th>
      <th scope="col">Updated By</th> -->
      <th scope="col">Status</th>
      <th scope="col" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1 ?>
    <?php if(count($users) > 0) : ?>
      <?php foreach($users as $user) : ?>
        <tr>
          <th scope="row"><?= $i; ?></th>
          <td><?= $user["name"]; ?></td>
          <td><?= $user["nik"]; ?></td>
          <!-- <td><?= $user["password"]; ?></td> -->
          <td><?= $user["role"]; ?></td>
          <!-- <tzd><?= date('j/m/Y, H:i:s', strtotime($user["created_at"])); ?></tzd>
          <td><?= $user["created_by"]; ?></td>
          <td><?= date('j/m/Y, H:i:s', strtotime($user["updated_at"])); ?></td>
          <td><?= $user["updated_by"]; ?></td> -->
          <td>
            <span class="badge bg-<?= $user['active'] ? 'success' : 'secondary' ?>">
              <?= $user["active"] ? 'ACTIVE' : 'INACTIVE' ?>
            </span>
          </td>
          <td class="text-center">
            <button type="button" class="btn btn-warning" onclick="window.location.href='master_user_detail.php?id=<?= $user['id'] ?>'">
              Edit / Details
            </button>
            <form method="post" style="display:inline-block;" onsubmit="return confirm('Yakin mau hapus user ini?')">
              <input type="hidden" name="delete" value="<?= $user['id'] ?>">
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>

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

<?php 
require 'footer.php';
?>
