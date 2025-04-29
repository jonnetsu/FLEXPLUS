<?php
session_start();
error_reporting(0);
require_once '../../config/puri-conn.php';
include 'includes/functions.php';
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if (strlen($_SESSION['uemail'] ?? '') === 0) {
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$uid = $_SESSION['uid'];
$uemail = $_SESSION['uemail'];

$today = date("Y-m-d");

if (isset($_POST['submit'])) {
   
    //Include required PHPMailer files
    require 'includes/credentials.php';
    $mail = new PHPMailer();

    $password = sanitize_input($_POST['password']);
    $repassword = sanitize_input($_POST['repassword']);

    $passwordhash = password_hash($password, PASSWORD_DEFAULT);


    $sql = "SELECT * FROM users WHERE email = '$uemail'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);

    $username = $row['username'];

    // Check if the email exists in the database
    $query = "SELECT * FROM `users` WHERE `email` = '$uemail'";
    $result = mysqli_query($con, $query);

    if ($password !== $repassword) {
        $msg = "Passwords do not match";
        $type = "warning";
    } elseif (strlen($password) < 6) {
        $msg = "Password should be at least 6 characters long";
        $type = "warning";
    }elseif (strlen($repassword) < 6) {
      $msg = "Password should be at least 6 characters long";
      $type = "warning";
     } else {
        // Store the new password in the 'password' column of the users table
        $updateQuery = "UPDATE `users` SET `password` = '$passwordhash' WHERE `email` = '$uemail'";
        mysqli_query($con, $updateQuery);

        if ($updateQuery) {
            // Send the email with the code using PHPMailer
            $mail->isSMTP();
            $mail->Host = 'smtp-pulse.com';
            $mail->SMTPAuth = true;
            $mail->Username = EMAIL;
            $mail->Password = PASS;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('support@earnixincome.com', 'Promiq Technololgy');
            $mail->addAddress($uemail);
            $mail->addReplyTo('support@earnixincome.com');

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset';
            $mail->Encoding = 'base64';
            $mail->Body = '
            <!DOCTYPE html>
            <html>
              <head>
                <meta charset="UTF-8" />
                <title>Password Reset Successful</title>
                <style>
                  body {
                    font-family: Arial, sans-serif;
                    background-color: #f6f6f6;
                    margin: 0;
                    padding: 0;
                  }
                  .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #ffffff;
                  }
                  h1 {
                    font-size: 24px;
                    font-weight: bold;
                    color: #1b70f1;
                    margin-top: 0;
                  }
                  p {
                    font-size: 16px;
                    line-height: 1.5;
                    color: #000000;
                  }
                  .footer {
                    font-size: 14px;
                    color: #808080;
                    margin-top: 20px;
                  }
                  .logo {
                    text-align: center;
                    margin-bottom: 20px;
                  }
                </style>
              </head>
              <body>
                <div class="container">
                  <div class="logo">
                    <img src="https://promiqtechnology.online/images/logo.png" alt="Logo" width="200" height="auto" />
                  </div>
                  <h1>Password Reset Successful</h1>
                  <p>
                    <b>Hello '.$username.',</b><br />
                    Your password has been successfully reset for your Promiq Technololgy account.
                  </p>
                  <p>
                    If you did not initiate this password reset, please contact our support team immediately.
                  </p>
                  <p class="footer">
                    Thank you for using Promiq Technololgy.
                  </p>
                </div>
              </body>
            </html>
            ';
            if ($mail->send()) {
                // Email sent successfully
                $msg = "Password Reset successful. Redirecting you to login...";
                $type = "success";

                  // Destroy the session after successful password reset
                  session_destroy();
                  ?>
                  <script>
                  setTimeout(function () {
                  window.location ='login.php';
                  }, 3000);
                  </script>;
                 <?php
            } else {
                // Error sending email
                $msg = "Password Reset successful but couldn't send an email. Redirecting you to login...";
                $type = "warning";

                  // Destroy the session after successful password reset
                  session_destroy();
                  ?>
                  <script>
                  setTimeout(function () {
                  window.location ='login.php';
                  }, 3000);
                  </script>;
                 <?php
            }
        } else {
            // Error updating the password in the database
            $msg = "Error updating password.Please try again";
            $type = "warning";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">    
<head>
        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="description" content="Promiq Technology">
        <meta name="author" content="">

        <!-- Favicon and touch Icons -->
        <link href="assets/img/favicon.png" rel="shortcut icon" type="image/png">
        <link href="assets/img/favicon.png" rel="apple-touch-icon">
        <link href="assets/img/favicon.png" rel="apple-touch-icon" sizes="72x72">
        <link href="assets/img/favicon.png" rel="apple-touch-icon" sizes="114x114">
        <link href="assets/img/favicon.png" rel="apple-touch-icon" sizes="144x144">

        <!-- Page Title -->
        <title>Promiq Technology</title>
        
        
        <!-- Styles Include -->
        <link rel="stylesheet" href="assets/css/main.css" id="stylesheet">
        <link rel="stylesheet" href="assets/css/custom.css" id="stylesheet">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

        <style>
    .form-group {
    position: relative;
}

.password-toggle {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
}

.password-toggle i {
    color: #999;
}

.password-toggle i:hover {
    color: #333;
}

</style>
    </head>


    <body class="bg-primary">
        <!-- Preloader -->
        <div id="preloader">
            <div class="preloader-inner">
                <div class="spinner"></div>
                <div class="logo"><img src="assets/img/favicon.png" alt="img"> </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xl-7 col-lg-7 col-md-6">
                <div class="d-none d-md-flex align-items-center justify-content-center" style="height: calc(100vh - 100px);">
                    <img src="assets/img/company.jpg" alt="img" class="img-fluid" style="width:200px;">
                </div>
            </div>

            <div class="col-xl-5 col-lg-5 col-md-6">
                <div class="d-flex align-items-center justify-content-center vh-100 bg-white">
                    <div class="card rounded-0 border-0 p-5 m-0 w-100">

                        <div class="card-header border-0 p-0">
                            <a href="../index.php" class="w-100 d-inline-block mb-5">
                                <img src="assets/img/logo.png" alt="img" style="width:200px;">
                            </a>
                            <h2>Reset Password</h2>
                            <p class="text-dark mt-4 mb-5">Please enter a new password.</p>
                        </div>
                        <?php if (isset($_SESSION['errmsg']) && $_SESSION['errmsg'] !== "") { ?>
                        <div class="alert alert-danger" style="width: 100%; padding: 10px;">
                            <?php echo $_SESSION['errmsg']; ?><?php $_SESSION['errmsg'] = ""; ?>
                        </div>
                        <?php } ?>

                        <div class="card-body p-0">
                            <form class="form-horizontal" method="post">
                               
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="password" value="" 
                                    placeholder="Password" required>
                                    <span id="password-toggle" class="password-toggle" onclick="togglePasswordVisibility()"><i class="fa fa-eye"></i></span>
                                </div>
                                <div class="form-group">
                                    <input type="repassword" class="form-control" name="repassword" id="repassword" value="" 
                                    placeholder="Password" required>
                                    <span id="repassword-toggle" class="password-toggle" onclick="toggleRePasswordVisibility()"><i class="fa fa-eye"></i></span>  
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary w-100 text-uppercase text-white rounded-2 lh-34 ff-heading fw-bold shadow">Reset Password</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- Core JS -->
        <script src="assets/js/jquery-3.6.0.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>

        <!-- jQuery UI Kit -->
        <script src="plugins/jquery_ui/jquery-ui.1.12.1.min.js"></script>
        
        <!-- ApexChart -->
        
        
        <!-- Peity  -->
        <script src="plugins/peity/jquery.peity.min.js"></script>
        <script src="plugins/peity/piety-init.js"></script>

        <!-- Select 2 -->
        <script src="plugins/select2/js/select2.min.js"></script>

        <!-- Datatables -->
        <script src="plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/js/datatables.init.js"></script>
        
        

        <!-- Date Picker -->
        <script src="plugins/flatpickr/flatpickr.min.js"></script>

        <!-- Dropzone -->
        <script src="plugins/dropzone/dropzone.min.js"></script>
        <script src="plugins/dropzone/dropzone_custom.js"></script>
        
        <!-- TinyMCE -->
        <script src="plugins/tinymce/tinymce.min.js"></script>
        <script src="plugins/prism/prism.js"></script>
        <script src="plugins/jquery-repeater/jquery.repeater.js"></script>

        

        

        <!-- Sweet Alert -->
        <script src="plugins/sweetalert/sweetalert2.min.js"></script>
        <script src="plugins/sweetalert/sweetalert2-init.js"></script>
        <script src="plugins/nicescroll/jquery.nicescroll.min.js"></script>

        <!-- Snippets JS -->
        <script src="assets/js/snippets.js"></script>

        <!-- Theme Custom JS -->
        <script src="assets/js/theme.js"></script>
         
        <script>
                              function togglePasswordVisibility() {
                              var passwordInput = document.getElementById("password");
                              var passwordToggle = document.getElementById("password-toggle");
                          
                              if (passwordInput.type === "password") {
                                  passwordInput.type = "text";
                                  passwordToggle.innerHTML = '<i class="fa fa-eye-slash"></i>';
                              } else {
                                  passwordInput.type = "password";
                                  passwordToggle.innerHTML = '<i class="fa fa-eye"></i>';
                              }
                          }
                          
                          function toggleRePasswordVisibility() {
                              var passwordInput = document.getElementById("repassword");
                              var passwordToggle = document.getElementById("repassword-toggle");
                          
                              if (passwordInput.type === "password") {
                                  passwordInput.type = "text";
                                  passwordToggle.innerHTML = '<i class="fa fa-eye-slash"></i>';
                              } else {
                                  passwordInput.type = "password";
                                  passwordToggle.innerHTML = '<i class="fa fa-eye"></i>';
                              }
                          }
                          
                          </script>

    </body>
</html>