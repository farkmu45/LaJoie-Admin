<?php
require_once '../vendor/autoload.php';

use LaJoie\models\Admin;
use LaJoie\modules\Auth;

session_start();

Auth::guard();

if ($_SESSION['adminType'] == 1) {
  header('HTTP/1.0 403 Forbidden');
  exit();
}

if ($_POST) {
  Admin::delete($_POST['id']);
}

$admins = Admin::getAll();



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
  <title>Manajemen &rsaquo; User &mdash; LaJoie</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css" />

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/datatables/datatables.min.css" />
  <link rel="stylesheet" href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" />

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/components.css" />

</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li>
              <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
            </li>
            <li>
              <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
            </li>
          </ul>
        </form>
        <ul>
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1" />
              <div class="d-sm-none d-lg-inline-block">Hi, <?= $_SESSION['adminName'] ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="editProfile.php" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="logout.php" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a>LaJoie</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a>LJ</a>
          </div>
          <ul class="sidebar-menu">
            <li>
              <a href="dashboard.php"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li>
              <a class="nav-link" href="wall.php"><i class="fas fa-th-large"></i>
                <span>Manajemen Wall</span></a>
            </li>
            <li class="active" class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Manajemen User</span></a>
              <ul class="dropdown-menu">
                <li class="active"><a href="admins.php">Admin</a></li>
                <li><a href="users.php">User</a></li>
              </ul>
            </li>
            <li>
              <a class="nav-link" href="knowledge.php"><i class="far fa-lightbulb"></i>
                <span>Manajemen Knowledge</span></a>
            </li>
            <li>
              <a class="nav-link" href="submission.php"><i class="far fa-file"></i>
                <span>Manajemen Submission</span></a>
            </li>
          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Manajemen Admin</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active">
                <a href="#">Manajemen User</a>
              </div>
              <div class="breadcrumb-item">Admin</div>
            </div>
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php foreach ($admins as $key => $admin) { ?>
                            <tr>
                              <td class="text-center"><?= $key + 1 ?></td>
                              <td><?= $admin['name'] ?></td>
                              <td><?= $admin['username'] ?></td>
                              <td>
                                <a href="userEdit.php?id=<?= $admin['id'] ?>" class="btn btn-icon icon-left btn-primary"><i class="fas fa-edit"></i>Edit</a>

                                <form method="post" style="display: inline;">
                                  <input type="hidden" name="id" value="<?= $admin['id'] ?>">
                                  <button class="btn btn-icon icon-left btn-primary"><i class="fas fa-trash"></i>Delete</button>
                                </form>

                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="card-footer text-right">
                      <div class="buttons">
                        <a href="addAdmin.php" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>Add</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2021
          <div class="bullet"></div>
          Design By LaJoie
        </div>
        <div class="footer-right"></div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="assets/modules/datatables/datatables.min.js"></script>
  <script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="assets/modules/jquery-ui/jquery-ui.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/modules-datatables.js"></script>

  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>