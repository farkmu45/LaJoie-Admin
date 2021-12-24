<?php

require_once '../vendor/autoload.php';

use LaJoie\models\Submission;
use LaJoie\utils\StringUtil;
use LaJoie\modules\Auth;

session_start();

Auth::guard();

$submissions = Submission::getAll();

if ($_POST) {

  if ($_POST['acceptUserId']) {
    if (Submission::acceptSubmission($_POST['acceptUserId'])) {
      header('Location: submission.php');
    }
  } else if ($_POST['rejectUserId']) {
    if (Submission::rejectSubmission($_POST['rejectUserId'])) {
      header('Location: submission.php');
    }
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
  <title>Manajemen Submission &mdash; LaJoie</title>

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
              <div class="d-sm-none d-lg-inline-block">Hi, <?= $_SESSION['adminName'] ?>Silfa</div>
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
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Manajemen User</span></a>
              <ul class="dropdown-menu">
              <?= $_SESSION['adminType'] == 2 ?  
                '<li class="active"><a href="admins.php">Admin</a></li>' : '' ?>
                <li><a href="users.php">User</a></li>
              </ul>
            </li>
            <li>
              <a class="nav-link" href="knowledge.php"><i class="far fa-lightbulb"></i>
                <span>Manajemen Knowledge</span></a>
            </li>
            <li class="active">
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
            <h1>Manajemen Submission</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active">
                <a href="submission.php">Manajemen Submission</a>
              </div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-2">
                        <thead>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Created at</th>
                            <th>User</th>
                            <th>Experience</th>
                            <th>Options</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php foreach ($submissions as $key => $submission) { ?>
                            <tr>
                              <td class="text-center">
                                <?= $key + 1 ?>
                              </td>
                              <td><?= $submission['created_at_gmt'] ?></td>
                              <td><?= $submission['username'] ?></td>
                              <td>
                                <?= StringUtil::limit($submission['experience']) ?>
                                <div class="table-links">
                                  <a href="submissionDetail.php?id=<?= $submission['user_id'] ?>">View</a>
                                </div>
                              </td>
                              <td>
                                <?php if (!$submission['is_checked']) { ?>
                                  <form style="display: inline;" method="post">
                                    <input type="hidden" name="acceptUserId" value="<?= $submission['user_id'] ?>">
                                    <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="fas fa-check"></i>Accept</button>
                                  </form>
                                  <form style="display: inline;" method="post">
                                    <input type="hidden" name="rejectUserId" value="<?= $submission['user_id'] ?>">
                                    <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="fas fa-minus-circle"></i>Reject</button>
                                  </form>
                                <?php } else { ?>
                                  <p>ACCEPTED</p>
                                <?php } ?>
                              </td>
                            </tr>
                          <?php } ?>

                        </tbody>
                      </table>
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