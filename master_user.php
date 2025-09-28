<?php
require 'header.php';
// ambil data dari tabel users
$users = GetUsers();
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
        <tr id=<?= $user["id"]; ?>>
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
            <button type="button" class="btn btn-warning" onclick="window.location.href='master_user_detail.php'">
              Edit
            </button>
            <button type="button" class="btn btn-danger" onclick="window.location.href='master_user_delete.php'">
              Delete
            </button>
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
