<?php
session_start();
error_reporting(0);
require_once '../../config/puri-conn.php';
include 'includes/functions.php';
include 'includes/mail-settings.php';
date_default_timezone_set('Africa/Lagos');

if (strlen($_SESSION['email'] ?? '') !== 0) {
    echo "<script>window.location.href='index.php';</script>";
}

ini_set('display_errors', 1);

$today = date("Y-m-d");

if (isset($_POST['submit'])) {
    $email = sanitize_input($_POST['email']);

    // Check if the email exists in the database
    $query = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // Check the last code request time for the user
        $sql = "SELECT `last_code_request` FROM `users` WHERE `email` = '$email'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $lastCodeRequest = $row['last_code_request'];

        // Calculate the time difference since the last code request
        $currentTime = time();
        $timeDifference = $currentTime - strtotime($lastCodeRequest);

        // Check if the cooldown period has passed (60 seconds) or if it's the first code request
        if ($timeDifference >= 60 || empty($lastCodeRequest)) {
            // Generate a new six-digit code
            $code = mt_rand(100000, 999999);
            $code = str_pad($code, 6, '0', STR_PAD_LEFT);

            // Store the code in the 'code' column of the users table
            $updateQuery = "UPDATE `users` SET `code` = '$code', `last_code_request` = NOW() WHERE `email` = '$email'";
            mysqli_query($con, $updateQuery);

            $toEmail = $email;
        $subject = $form_type;
        $mailHeaders = "MIME-Version: 1.0" . "\r\n";
        $mailHeaders .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $mailHeaders .= 'From: Promiq Technology <' . $noreply_email . '>' . "\r\n";
        $mailHeaders .= "Date: " . date('r') . " \r\n";
        $mailHeaders .= "Return-Path: " . $site_email . "\r\n";
        $mailHeaders .= "Errors-To: " . $site_email . "\r\n";
        $mailHeaders .= "Reply-to: " . $site_email . " \r\n";
        $mailHeaders .= "Organization: " . $site_title . " \r\n";
        $mailHeaders .= "X-Sender: " . $site_email . " \r\n";
        $mailHeaders .= "X-Priority: 3 \r\n";
        $mailHeaders .= "X-MSMail-Priority: Normal \r\n";
        $mailHeaders .= "X-Mailer: PHP/" . phpversion();
            
            $content = '
            <!DOCTYPE html>
            <html>
              <head>
                <meta charset="UTF-8" />
                <title>Password Recovery</title>
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
                  .code {
                    font-size: 32px;
                    font-weight: bold;
                    color: #1b70f1;
                    text-transform: uppercase;
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
                  <h1>Password Recovery</h1>
                  <p>
                    <b>Hello user,</b><br />
                    We have received a request to recover your password for your Promiq Technology account.
                  </p>
                  <p>
                    Please use the 6-digit verification code below on the Promiq Technology website to proceed with the password recovery process:
                  </p>
                  <p class="code">'.$code.'</p>
                  <p class="footer">
                    If you did not request a password recovery, please ignore this message.
                  </p>
                </div>
              </body>
            </html>
            '; // Add your email message content here
            if (mail($toEmail, $subject, $content, $mailHeaders)) {

                // Email sent successfully
                $msg = "Email sent successfully. Please check your email for the password reset code. Redirecting you...";
                $type = "success";
                ?>
                <script>
                setTimeout(function () {
                window.location ='email-verification-code.php?stats=<?php echo $code+433456644 ?>&email=<?php echo $email ?>';
                }, 3000);
                </script>;
               <?php
            } else {
                // Error sending email
                $msg = "Error sending email. Please try again later.";
                $type = "warning";
                
            }
        } else {
            // Email exists but cooldown period has not passed
            $remainingTime = 60 - $timeDifference;
            $msg = "Please wait for $remainingTime seconds before requesting another code.";
            $type = "warning";
        }
    } else {
        // Email does not exist in the database
        $msg = "This email address is not related to any account";
        $type = "warning";
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
                            <h2>Forgot Password</h2>
                            <p class="text-dark mt-4 mb-5">Please enter the email address related to your account</p>
                        </div>
                        <?php if(isset($msg)) { ?>
                        <div class="error-wrapper-<?php echo $type?>">
                        <span class="message-<?php echo $type?>"><?php echo $msg; ?></span>
                        </div>
                        <?php }?>
                        <div class="card-body p-0">
                            <form class="form-horizontal" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" value="" placeholder="Email or Username"
                                    <?php if(isset($_POST['email'])) echo $_POST['email']; ?>  required>
                                </div>
                
                               
                                <button type="submit" name="submit" class="btn btn-primary w-100 text-uppercase text-white rounded-2 lh-34 ff-heading fw-bold shadow">Login</button>


                                <p class="d-flex align-items-center justify-content-between mt-4 mb-4">Don't have an account? <a href="signup.php" class="text-primary fw-bold text-decoration-underline">Signup</a></p>
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

</script>

    </body>
</html>