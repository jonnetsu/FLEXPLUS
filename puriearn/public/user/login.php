<?php 
session_start();
error_reporting(0);
require_once '../../config/puri-conn.php';
include 'includes/functions.php';


error_reporting(E_ALL);
ini_set('display_errors', 1);


if (isset($_SESSION['email']) && strlen($_SESSION['email']) !== 0) {
    echo "<script>window.location.href='index.php';</script>";
}

$today = date("Y-m-d");

if (isset($_POST['submit'])) {
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);

    $email = mysqli_real_escape_string($con, $email);
    $password = mysqli_real_escape_string($con, $password);

    // Fetch the hashed password from the database based on the provided email or username
    $sql = "SELECT `id`, `password`,`username` FROM `users` WHERE (`email`='$email' OR `username`='$email')";
    $result = mysqli_query($con, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Verify the provided password against the stored hashed password
        if (password_verify($password, $user['password'])) {
            // Password is correct
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $uip2 = $_SERVER['REMOTE_ADDR'];
            $userid = $_SESSION['id'];
            $uip = getenv("REMOTE_ADDR"); // Fetch IP address in PHP
            $status = "Successful";

            // Check for the last login and give the user a bonus
            $sql = "SELECT * FROM `users` WHERE `email`='$email'";
            $res = mysqli_query($con, $sql);
            $rlog = mysqli_fetch_assoc($res);

        
            $log = "INSERT INTO userslog(uid, email, userip, status) VALUES ('".$_SESSION['id']."','".$_SESSION['email']."','$uip','$status')";
            $result = mysqli_query($con, $log);

            header("Location: index.php");
            exit();
        } else {
            // Password is incorrect
            $status = "Failed";
            $log = "INSERT INTO userslog(uid, email, userip, status) VALUES ('".$user['id']."','$email','$uip','$status')";
            $result = mysqli_query($con, $log);
            $_SESSION['errmsg'] = "Invalid username or password";
            header("Location: login.php");
            exit();
        }
    } else {
        // User not found
        $status = "Failed";
        $log = "INSERT INTO userslog(email, userip, status) VALUES ('$email','$uip','$status')";
        $result = mysqli_query($con, $log);
        $_SESSION['errmsg'] = "Invalid username or password";
        header("Location: login.php");
        exit();
    }
}

    
?>
<!DOCTYPE html><html lang="en"><head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Puriearn">
    <meta name="keywords" content="Puriearn, cpa marketing">
    <meta name="author" content="Puriearn">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <title>Puriearn - CPA </title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="css/feather-icon.css">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link id="color" rel="stylesheet" href="css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
  </head>
  <body>
    <!-- login page start-->
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-12 p-0">    
          <div class="login-card login-dark">
            <div>
              <div>
                <a class="logo" href="../">
                    <img class="img-fluid for-dark" src="images/logo-2.png" alt="Puriearn">
                    <img class="img-fluid for-light" src="images/logo_2.png" alt="Puriearn" style="width:200px;"></a>
                </div>
              <div class="login-main">
                <form class="theme-form" method="post" action="" >
                  <h4>Welcome Back </h4>
                  <p>Enter your email &amp; password to login</p>
                  <?php if (isset($_SESSION['errmsg']) && $_SESSION['errmsg'] !== "") { ?>
                        <div class="alert alert-danger" style="width: 100%; padding: 10px;">
                            <?php echo $_SESSION['errmsg']; ?><?php $_SESSION['errmsg'] = ""; ?>
                        </div>
                <?php } ?> 
                  <div class="form-group">
                    <label class="col-form-label">Username/Email</label>
                    <input class="form-control" type="text" name="email" required
                    <?php if(isset($_POST['email'])) echo $_POST['email']; ?> placeholder="tunde@gmail.com">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <div class="form-input position-relative">
                      <input id="password" class="form-control" type="password" name="password" required placeholder="*********">
                      <div id="toggle-password" class="show-hide">
                        <span class="show"></span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <div class="checkbox p-0">
                      <input id="checkbox1" type="checkbox">
                    </div><a class="link" href="">Forgot password?</a>
                    <div class="text-end mt-3">
                      <button class="btn btn-primary btn-block w-100" type="submit" name="submit">Sign in</button>
                    </div>
                  </div>
                  
                  <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="signup.php">Sign Up</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
  var passwordInput = document.getElementById('password');
  var toggle = document.getElementById('toggle-password');
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    toggle.classList.add('showing');
    toggle.innerHTML = '<span class="hide"></span>';
  } else {
    passwordInput.type = 'password';
    toggle.classList.remove('showing');
    toggle.innerHTML = '<span class="show"></span>';
  }
});
</script>
      <!-- latest jquery-->
      <script src="js/jquery.min.js"></script>
      <!-- Bootstrap js-->
      <script src="js/bootstrap.bundle.min.js"></script>
      <!-- feather icon js-->
      <script src="js/feather.min.js"></script>
      <script src="js/feather-icon.js"></script>
      <!-- scrollbar js-->
      <!-- Sidebar jquery-->
      <script src="js/config.js"></script>
      <!-- Plugins JS start-->
      <!-- calendar js-->
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="js/script.js"></script>
    </div>
  
</body>
</html>