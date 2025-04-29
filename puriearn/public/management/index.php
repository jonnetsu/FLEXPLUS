<?php
session_start();
include('../../config/puri-conn.php');
error_reporting(0);
if(isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Fetch the user from the database by username
  $query = "SELECT * FROM admin WHERE username='$username'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);

  if($row) {
      // Verify password using password_verify
      if(password_verify($password, $row['password'])) {
          // Password matches, set session variables and log the user in
          $_SESSION['dlogin'] = $username;
          $_SESSION['id'] = $row['id'];
          $_SESSION['name'] = $row['fullname'];

          $uip = $_SERVER['REMOTE_ADDR'];
          $status = 1;
          $log = "INSERT INTO adminlog(uid, username, userip, status) VALUES ('{$row['id']}', '$username', '$uip', '$status')";
          mysqli_query($con, $log);

          // Redirect to dashboard
          header("Location: dashboard.php");
          exit();
      } else {
          // Password does not match
          $uip = $_SERVER['REMOTE_ADDR'];
          $status = 0;
          $log = "INSERT INTO adminlog(username, userip, status) VALUES ('$username', '$uip', '$status')";
          mysqli_query($con, $log);

          $_SESSION['errmsg'] = "Invalid username or password";
          header("Location: index.php");
          exit();
      }
  } else {
      // User not found
      $_SESSION['errmsg'] = "Invalid username or password";
      header("Location: index.php");
      exit();
  }
}

?>

<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  >
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title>Puriearn - Administrator</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />
    <link rel="stylesheet" href="assets/css/custom.css" />


    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
  </head>


  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.php" class="app-brand-link gap-2">
                <img src="assets/img/favicon/logo.png"  class="logo" style="width:150px !important;"/>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Welcome Back! 👋</h4>
              <p class="mb-4">Enter your username and password to sign in</p>
              <span style="color:red;text-align:center;width:100%;">
                <?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?>
              </span>
              <form  class="mb-3" form action="" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Username</label>
                  <input
                    type="text"
                    class="form-control"
                    name="username"
                    placeholder="Enter your username"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>      
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                 
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" name="submit" type="submit">Sign in</button>
                </div>
              </form>

            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->
  
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
