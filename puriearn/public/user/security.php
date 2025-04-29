<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('includes/checklogin.php');
include 'includes/functions.php';
//Include PHPMailer files
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

date_default_timezone_set('Africa/Lagos');

//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
check_login();
$title="Dashboard";
$uip=$_SERVER['REMOTE_ADDR'];
include 'includes/header.php'; 

$currentTime = date( 'd-m-Y h:i:s A', time () );


$uid= $_SESSION['id'];
$username=$_SESSION['username'];
$sql = "SELECT * FROM `users` WHERE `id`=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$profile_pic=$row['user_picture'];

$password=$row['password'];
$pin=$row['withdrawal_pin'];

 //Make user a vendor
 if(isset($_GET['reset']))
 {
      //Include required PHPMailer files
      require 'includes/credentials.php';
      $mail = new PHPMailer();

      $email = sanitize_input($_GET['uemail']);

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

     // Send the email with the code using PHPMailer
     $mail->isSMTP();
     $mail->Host = 'smtp-pulse.com';
     $mail->SMTPAuth = true;
     $mail->Username = EMAIL;
     $mail->Password = PASS;
     $mail->SMTPSecure = 'ssl';
     $mail->Port = 465;

     $mail->setFrom('support@promiqtechnology.com', 'Promiq Technology');
     $mail->addAddress($email);
     $mail->addReplyTo('support@promiqtechnology.com');

     $mail->isHTML(true);
     $mail->Subject = 'Email Confirmation Code';
     $mail->Encoding = 'base64';
     $mail->Body = '
     <!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Reset Withdrawal Pin</title>
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
        <img src="https://promiqtechnology.com/images/logo.png" alt="Logo" width="200" height="auto" />
      </div>
      <h1>Withdrawal Pin Reset Confirmation</h1>
      <p>
        <b>Hello '.$username.',</b><br />
        We have received a request to reset your withdrawal pin for your Promiq Technology account.
      </p>
      <p>
        Please use the 6-digit verification code below on the Promiq Technology website to proceed with the withdrawal pin reset process:
      </p>
      <p class="code">'.$code.'</p>
      <p class="footer">
        If you did not request a withdrawal pin reset, please ignore this message.
      </p>
    </div>
  </body>
</html>

     ';

     if ($mail->send()) {
         // Email sent successfully
         $msg="A verification code has been sent to you email. Please check your email for the withdrawal pin reset code.Redirecting you ...";
         $type = "success";
         ?>
         <script>
         setTimeout(function () {
         window.location ='reset-pin-code.php';
         }, 3000);
         </script>;
        <?php
     } else {
         // Error sending email
         $msg="Error sending email. Please try again later.";
         $type = "warning";
     }
 } else {
     // Email exists but cooldown period has not passed
     $remainingTime = 60 - $timeDifference;
     $msg="Please wait for $remainingTime seconds before requesting another code.";
     $type = "warning";
 }

 }

// Update Password 
if(isset($_POST['submit'])) {
 
  $oldpassword = sanitize_input($_POST['oldpassword']);
  $newpassword = sanitize_input($_POST['newpassword']);
  $confirmpassword = sanitize_input($_POST['confirmpassword']);

  $newpassword = mysqli_real_escape_string($con, $newpassword);
  $confirmpassword = mysqli_real_escape_string($con, $confirmpassword);

  // Retrieve the hashed password from the database based on the user ID
  $query = "SELECT `password` FROM `users` WHERE `id` = '$uid'";
  $result = mysqli_query($con, $query);

  if (!$result) {
      // Handle database query error
      $msg = "Error retrieving password from the database";
      $type = "error";
  } else {
      $row = mysqli_fetch_assoc($result);
      $hashedPassword = $row['password'];

      // Verify old password
      if (!password_verify($oldpassword, $hashedPassword)) {
          $msg = 'Old password is not correct';
          $type = "warning";
      } elseif ($newpassword !== $confirmpassword) {
          $msg = "Passwords do not match!";
          $type = "warning";
      } else {
          // Hash the new password
          $newpasswordhash = password_hash($newpassword, PASSWORD_DEFAULT);

          // Update the password in the database
          $sql1 = "UPDATE `users` SET `password`='$newpasswordhash' WHERE `id` = '$uid'";
          $result1 = mysqli_query($con, $sql1);

          if ($result1) {
              $msg = "Password Successfully Updated!!";
              $type = "success";
          } else {
              $msg = "Something went wrong, please try again";
              $type = "warning";
          }
      }
  }
}



//Update Withdrawal Pin
if(isset($_POST['submit2']))
{
 
    $oldpin = sanitize_input($_POST['oldpin']);
    $newpin = sanitize_input($_POST['newpin']);
    $confirmpin = sanitize_input($_POST['confirmpin']);


    $newpin = mysqli_real_escape_string($con, $newpin);
    $confirmpin = mysqli_real_escape_string($con, $confirmpin);


    $oldpin=md5($oldpin);
    $newpinhash=md5($newpin);

    if(empty($oldpin) || empty($newpin) || empty($confirmpin)){
      $msg="All pin fields must be filled";
      $type = "warning";
    }elseif(strlen($newpin) > 6){ 
        $msg = "Pin must be 6 digits"; 
        $type = "warning";
    }elseif(strlen($newpin) < 6){ 
        $msg = "Pin must be 6 digits"; 
        $type = "warning";
    }elseif($pin !== $oldpin){ 
      $msg = 'Old pin not correct'; 
      $type = "warning";
  }elseif($newpin !== $confirmpin){ 
    $msg="Pins do not match!";
    $type = "warning";
  }else{
    $sql1="UPDATE `users` SET `withdrawal_pin`='$newpinhash'
    WHERE `id` = '$uid' ";
    $result1=mysqli_query($con,$sql1);
    if($result1){ 
      $msg="Withdrawal Pin Successfully Updated!!";
      $type = "success";
    }else{
    $msg="something went wrong,please try again";
    $type = "warning";
    }   
   
}

}



?>
							<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <h4>Security</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">


                        <?php if(isset($msg)){ ?>
                                <div class="alert alert-<?php echo $type?>">
                                <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                                <p class="mb-0"><?php echo $msg?></p>
                                </div>
                        <?php }?>
                    </div>
                
                    <div class="card border-0">
                    <div class="card-body pt-3">
                    <h4 class="nk-block-title mb-3">Update Password</h4>
                            <form class="" method="post" action="">
                                <div class="row g-3">
                                   <div class="col-12"> 
                                   <label class="form-label">Old Password</label>
													  <input type="password" name="oldpassword" class="form-control" 
                                                    value="" required>
												</div>
											  <div class="col-12"> 
                          <label class="form-label">New Password</label>
													<input type="password" name="newpassword" class="form-control" 
                              value="" required>
												</div>
											  <div class="col-12"> 
                            <label class="form-label">Confirm Password</label>
                              <input type="password" name="confirmpassword" class="form-control" 
                              value="" required>
												</div>
                        <div class="col-12"> 
				                              <button type="submit" name="submit" class="btn  btn-primary w-100">Update</button>
				                        	</div>
                    </form>
                              
                        </div>
                
              </div>
              </div>
                       
              <div class="card border-0">
                    <div class="card-body pt-3">

                            <h4 class="nk-block-title mb-3">Update Withdrawal Pin</h4>

                    <form action="#" class="invest-form" method="post">
                                    
                    <div class="row g-3">
                        <div class="col-12"> 
                          <label class="form-label">Old Pin</label>
                            <input type="password" name="oldpin" class="form-control" 
                                                      value="" required>
                          </div>
                          <div class="col-12"> 
                          <label class="form-label">New Pin</label>
                            <input type="number" name="newpin" class="form-control" 
                                                      value="" required>
                          </div>
                          <div class="col-12"> 
                          <label class="form-label">Confirm Pin</label>
                            <input type="number" name="confirmpin" class="form-control" 
                                                      value="" required>
                          </div>
                          <div class="col-12"> 
                              <button type="submit" name="submit2" class="btn btn-primary w-100">Update</button>
                        </div>
                        <div class="col-12"> 
                                    <a href="?uemail=<?php echo $row['email'];?>&reset=ture" 
                                onClick="return confirm('Are you sure you want to reset your withdrawal pin?')" class="btn btn-secondary">Reset Pin</a>
                        </div>
                  </form>
                                
                                
                                </div>
                        </div> 
							

                      
							
							</div>
						</div>
     

					</div>
				</div>
			</div>
			
		</div>
	</div>
  <br> <br>
</main>
    <?php include 'bottom-tabs.php' ?>
<?php include 'includes/footer.php' ?>
