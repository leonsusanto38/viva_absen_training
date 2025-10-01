<?php
require 'functions.php';
session_start();

if(!$_SESSION["login"]) {
  header("location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($headTitle) ? $headTitle : ""?>Viva Absen Training</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>

  <body>
    <nav class="navbar navbar-expand-lg bg-light p-2">
      <div class="container-fluid">
        <a class="navbar-brand" href="/viva_absen_training/home.php">Viva Absen Training</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item mx-2">
              <a class="nav-link active" aria-current="page" href="/viva_absen_training/home.php">Home</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link" href="#">Pricing</a>
            </li>
            <?php if($_SESSION["role"] === "administrator") : ?>
            <li class="nav-item mx-2 dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Master
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="master/master_user.php">Master User</a></li>
                <li><a class="dropdown-item" href="#">Master Role</a></li>
              </ul>
            </li>
            <li class="nav-item mx-2 dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Report
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Report Absen</a></li>
                <li><a class="dropdown-item" href="#">Report Nilai</a></li>
              </ul>
            </li>
            <?php endif; ?>
          </ul>
          <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                Hello, <?= $_SESSION["user_name"]; ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Ubah Password</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="/viva_absen_training/logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>

        </div>
      </div>
    </nav>

    <div class="container my-5">