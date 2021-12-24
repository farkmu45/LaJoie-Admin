<?php
require_once '../vendor/autoload.php';

use LaJoie\modules\Auth;

session_start();

if ($_SESSION['adminId']) {
  header('Location: dashboard.php');
}


// Auth::register('Admin 01', 'farkmu45', 'admin123');
// print_r(Auth::login('farkmu45', 'admin123'));
// Auth::logout();
// die();

if ($_POST) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (Auth::login($username, $password)) {
    header('Location: dashboard.php');
  }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
  <title>Login &mdash; LaJoie</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css" />

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css" />

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/components.css" />

</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="
                col-12 col-sm-8
                offset-sm-2
                col-md-6
                offset-md-3
                col-lg-6
                offset-lg-3
                col-xl-4
                offset-xl-4
              ">
            <div class="login-brand">
              <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle" />
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>

              <div class="card-body">
                <form method="POST">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus />
                    <!-- <div class="invalid-feedback">
                      Please fill in your username
                    </div> -->
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required />
                    <!-- <div class="invalid-feedback">
                      please fill in your password
                    </div> -->
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="3">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">Copyright &copy; LaJoie 2021</div>
          </div>
        </div>
      </div>
    </section>
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