<?php

require_once "../vendor/autoload.php";

use LaJoie\models\Knowledge;
use LaJoie\utils\StringUtil;
use LaJoie\modules\Auth;

session_start();

Auth::guard();

$knowledges = Knowledge::getAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
  <title>Manajemen Knowledge &mdash; LaJoie</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css" />

  <!-- CSS Libraries -->

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
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Manajemen User</span></a>
              <ul class="dropdown-menu">
              <?= $_SESSION['adminType'] == 2 ?  
                '<li class="active"><a href="admins.php">Admin</a></li>' : '' ?>
                <li><a href="users.php">User</a></li>
              </ul>
            </li>
            <li class="active">
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
            <h1>Manajemen Knowledge</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active">
                <a href="#">Manajemen Knowledge</a>
              </div>
            </div>
          </div>

          <div class="row">

            <!-- Knowledges data -->
            <?php foreach ($knowledges as $key => $knowledge) { ?>
              <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <article class="article article-style-b">
                  <div class="article-header">
                    <div class="article-image" data-background="<?= StringUtil::getImage($knowledge['picture']) ?>"></div>
                  </div>
                  <div class="article-details">
                    <div class="article-title">
                      <h2><a href="knowledgeList.php?category_id=<?= $knowledge['id'] ?>&name=<?= StringUtil::encodeUrl($knowledge['name']) ?>"><?= $knowledge['name'] ?></a></h2>
                    </div>
                  </div>
                </article>
              </div>
            <?php }  ?>
            <!--  -->
          </div>
          <div class="footer text-right">
            <a href="addKnowledgeCategory.php" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>Add</a>
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2021
          <div class="bullet"></div>
          Design By LaJoie
        </div>
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

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>