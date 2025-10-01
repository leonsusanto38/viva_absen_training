<?php
$headTitle = "Master User - ";
require '../header.php';
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

if(isset($_POST['search'])) {
  $users = SearchUsers($_POST['key']);
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

<form class="mt-3 d-flex col-10 col-lg-4" method="post">
  <input class="form-control me-2" type="search" name="key" placeholder="cari..." aria-label="Search" autofocus>
  <button class="btn btn-outline-success" type="submit" name="search">Search</button>
</form>

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
      <th scope="col" class="text-center">Status</th>
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
          <td class="text-center">
            <span class="badge bg-<?= $user['active'] == 'y' ? 'success' : 'secondary' ?>">
              <?= $user["active"] == 'y' ? 'ACTIVE' : 'INACTIVE' ?>
            </span>
          </td>
          <td class="text-center">
            <button type="button" class="btn btn-warning" onclick="window.location.href='master_user_detail.php?id=<?= $user['id'] ?>'">
              Edit / Details
            </button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete<?= $user['id'] ?>">
              <i class="bi bi-trash"></i> Delete
            </button>
          </td>

          <?php $i++; ?>
        </tr>

        <!-- Modal Konfirmasi -->
        <div class="modal fade" id="confirmDelete<?= $user['id'] ?>" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                Apakah Anda yakin ingin menghapus user <strong><?= $user['name'] ?></strong>?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form method="post" class="d-inline">
                  <input type="hidden" name="delete" value="<?= $user['id'] ?>">
                  <button type="submit" class="btn btn-danger">Ya, Hapus!</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <tr>
        <td colspan="10" class="text-center">No data available in table</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>

<?php 
require '../footer.php';
?>
