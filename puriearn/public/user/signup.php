<?php 
require_once '../../config/puri-conn.php';
include 'includes/functions.php';
session_start();

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

if(isset($_GET) & !empty($_GET)){
    $ref = isset($_GET['ref']) ? $_GET['ref'] : '';
    $referrer_code =sanitize_input($ref);  
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the form data
      $fullname = sanitize_input($_POST['fullname']);
      $username = sanitize_input($_POST['username']);
      $email = sanitize_input($_POST['email']);
      $coupon_code = sanitize_input($_POST['coupon_code']);
      $password = sanitize_input($_POST['password']);
  
      $fullname=mysqli_real_escape_string($con,$fullname);
      $username=mysqli_real_escape_string($con,$username);
      $email=mysqli_real_escape_string($con,$email);
      $coupon_code=mysqli_real_escape_string($con,$coupon_code);
      $password=mysqli_real_escape_string($con,$password);
  
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  
      // Assuming you have established a database connection object $con
  
    // Checking if the referral is set
    if (empty($referrer_code)) {
      $referrer_code = "PURIEARN";
    }
  
  // Checking if the email and username already exist
  $queryCheck = "SELECT * FROM users WHERE email = ? OR username = ?";
  $stmtCheck = mysqli_prepare($con, $queryCheck);
  mysqli_stmt_bind_param($stmtCheck, "ss", $email, $username);
  mysqli_stmt_execute($stmtCheck);
  $resultCheck = mysqli_stmt_get_result($stmtCheck);
  
  if (mysqli_num_rows($resultCheck) > 0) {
        $msg="Username or email already exists!";
        $type = "warning"; 
  } else {
    // Proceed with checking the coupon code
    $coupon_stmt = $con->prepare("SELECT `id`, `plan_id`, `amount` FROM `coupons` WHERE `coupon_code` = ? AND `status` ='0'");
    $coupon_stmt->bind_param("s", $coupon_code);
    $coupon_stmt->execute();
    $coupon_result = $coupon_stmt->get_result();
  
     if ($coupon_result->num_rows > 0) {
        $coupon = $coupon_result->fetch_assoc();
        $cid = $coupon['id'];
        $plan_id = $coupon['plan_id'];
  
        //Define the bonuses
        $ref_bonus_amount=1700;
        $indirect_bonus_amount=200;
        $initial_earning=0;
  
        $coupon_code = sanitize_input($_POST['coupon_code']);
  
        // Proceed with inserting the new record
        $query = "INSERT INTO users (`fullname`,`username`, `email`,`referral_code`,`referred_by`,`password`, `plan_id`,`coupon_code`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "ssssssss", $fullname,$username, $email,$username,$referrer_code, $hashed_password, $plan_id,$coupon_code );
  
        if (mysqli_stmt_execute($stmt)) {
            $newUserId = mysqli_insert_id($con); // Get the ID of the newly inserted record
  
             // Update the earnings of the referrer (if any)
            $referral_stmt = $con->prepare("SELECT `referral_code` FROM `users` WHERE `referral_code` = ? ");
            $referral_stmt->bind_param("s", $referrer_code);
            $referral_stmt->execute();
            $referral_result = $referral_stmt->get_result();
            //if ($referral_result->num_rows > 0) {
              $referrer = $referral_result->fetch_assoc();
              $referrer_id = $referrer['referral_code'];
  
              //Fetch the id of the referral and indirect referral
              $sql = "SELECT * FROM `users` WHERE `username`='$referrer_id' ";
              $res = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($res);
              $ruserid=$row['id'];
              $indirect_referrer=$row['referred_by'];
              $ref_bonus_amount = 1700;
              $bonus_message = "Referral bonus of ₦1700 on $username";

               if($ref_bonus_amount > 0){
                 
                // Update referral bonus for the referral
              $queryReferral = "UPDATE users SET ref_bonus = ref_bonus + 1700 WHERE id = ?";
              $stmtReferral = mysqli_prepare($con, $queryReferral);
              mysqli_stmt_bind_param($stmtReferral, "i", $ruserid);
              mysqli_stmt_execute($stmtReferral);
  
             // Send a notification for the referral bonus
             if (mysqli_stmt_affected_rows($stmtReferral) > 0) {
              $notificationsql = "INSERT INTO `notifications` (`receiver_id`, `action_type`, `body`) VALUES ('$ruserid', 'Referral', '$bonus_message')";
              $result2 = mysqli_query($con, $notificationsql);
            
              // Enter the earning history
              $earningsql = "INSERT INTO `earning_history` (`user_id`, `amount`) VALUES ('$ruserid', '1700')";
              $result3 = mysqli_query($con, $earningsql);
              }
  
  
            // Update indirect referral bonus for the indirect referral
            $queryIndirectReferral = "UPDATE users SET indirect_ref_bonus = indirect_ref_bonus + 200 WHERE username = ?";
            $stmtIndirectReferral = mysqli_prepare($con, $queryIndirectReferral);
            mysqli_stmt_bind_param($stmtIndirectReferral, "s", $indirect_referrer);
            mysqli_stmt_execute($stmtIndirectReferral);
  
            // Send a notification for indirect referral bonus
  
             //Fetch the id of the referral and indirect referral
             $sql = "SELECT * FROM `users` WHERE `username`='$indirect_referrer' ";
             $res = mysqli_query($con, $sql);
             $row = mysqli_fetch_assoc($res);
             $iuserid=$row['id'];
             $third_referrer=$row['referred_by'];
             $ref_bonus_amount = 1700;
             $bonus_message = "Indirect referral bonus of ₦200 on $username";
  
            if (mysqli_stmt_affected_rows($stmtReferral) > 0) {
              $notificationsql = "INSERT INTO `notifications` (`receiver_id`, `action_type`, `body`) VALUES ('$iuserid', 'Referral', '$bonus_message')";
              $result2 = mysqli_query($con, $notificationsql);
              
              
              // Enter the earning history
              $iearningsql = "INSERT INTO `earning_history` (`user_id`, `amount`) VALUES ('$iuserid', '200' )";
              $result4 = mysqli_query($con, $iearningsql);
  
              }
             
               }  
                  
            // Update the coupon status to '1' to mark it as used
            $queryCouponStatus = "UPDATE coupons SET status = '1',used_by='$username' WHERE id = ?";
            $stmtCouponStatus = mysqli_prepare($con, $queryCouponStatus);
            mysqli_stmt_bind_param($stmtCouponStatus, "i", $cid);
            mysqli_stmt_execute($stmtCouponStatus);
  
  
            // Redirect the user or display a success message
  
            // Log the user in and redirect to the dashboard
            $_SESSION['email']=$email;
            $_SESSION['id'] = $newUserId;
            $_SESSION['username'] = $username;
           
            $msg="Registration Successful. Redirecting you ...";
            $type = "success";
            ?>
            <script>
            setTimeout(function () {
            window.location ='index.php';
            }, 3000);
            </script>
           <?php
           } else {
            $msg="Invalid coupon code.";
            $type = "warning"; 
           }
  
        mysqli_stmt_close($stmtReferral);
        mysqli_stmt_close($stmtIndirectReferral);
        mysqli_stmt_close($stmtCouponStatus);
  
  }
  
  }
  
  } 
?>

<style>
                    .form-check-input:checked {
                        background-color: #06b32a !important;
                        border-color: #06b32a !important;
                    }

                    /* Optional: Custom styling for the checkbox */
                    .form-check-input {
                        width: 20px;
                        height: 20px;
                    }
                </style>

<!DOCTYPE html><html lang="en"><head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Puriearn">
    <meta name="keywords" content="Puriearn, cpa marketing">
    <meta name="author" content="Puriearn">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <title>Puriearn - Sign-Up</title>
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

  </head>
  <body>
    <style>
      .show-hide {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  user-select: none;
}

.show-hide .show, .show-hide .hide {
  display: none;
}

.show-hide.showing .show {
  display: none;
}

.show-hide.showing .hide {
  display: inline;
}

.show-hide:not(.showing) .show {
  display: inline;
}

.show-hide:not(.showing) .hide {
  display: none;
}

</style>

    <!-- login page start-->
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-12 p-0">    
          <div class="login-card login-dark">
            <div>
              <div>
                <a class="logo" href="../">
                    <img class="img-fluid for-dark" src="images/logo_2.png" alt="Puriearn">
                    <img class="img-fluid for-light" src="images/logo_2.png" alt="Puriearn" style="width:200px;"></a>
                </div>
              <div class="login-main" >
             
                <form class="theme-form" method="post" action="" >
                    <input type="hidden" name="plan" value="1">
                  <h4>Create Account </h4>
                  <p></p>
                  <?php if(isset($msg)) { ?>
                    <div class="alert alert-<?php echo $type?>">
                    <span class="message-<?php echo $type?>"><?php echo $msg; ?></span>
                    </div>
                  <?php }?>
                    <div class="form-group ">
                    <label class="col-form-label">Fullname</label>
                        <input type="text" name="fullname" class="form-control" placeholder="Full Name" aria-label="Fullname" required
                        value="<?php if(isset($_POST['fullname'])) echo $_POST['fullname']; ?>">
                    </div>
                 
                    <div class="form-group">
                    <label class="col-form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" required
                        id="username"  onBlur="userAvailability()"  value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">
                            <span class="" id="user-availability-status" 
                            style="font-size:13px;margin-top:2px;margin-bottom:5px;"></span>                               
                    </div>
                    <div class="form-group">
                    <label class="col-form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Email Address" aria-label="Email Address" 
                        value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required>
                    </div>
                    <div class="form-group form-box">
                    <label class="col-form-label">Referral</label>
                        <input type="text" name="referrer_id" class="form-control" placeholder="Referral (optional)"  aria-label="Username" 
                        value="<?php if(isset($_GET['ref'])) echo $_GET['ref']; ?>" disabled>
                    </div>
                    <div class="form-group form-box">
                    <label class="col-form-label">Coupon Code</label>
                        <input type="text" name="coupon_code" class="form-control" placeholder="Coupon Code" aria-label="Username" required
                        value="<?php if(isset($_POST['coupon'])) echo $_POST['coupon']; ?>">
                    </div>
                    <div class=" form-group" style="margin-top:0px;">
                        Don't have Coupon? <a href="../vendors.php" class="terms fw-bold text-decoration-underline">Buy Now</a>
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
                  
                    <div class="form-check checkbox-theme">
                    <input class="form-check-input" type="checkbox" value="" name="terms" id="rememberMe" required> 
                    <label class="form-check-label" for="rememberMe">
                        I agree to all Terms & Conditions <a href="#" class="terms"></a>
                    </label>
                </div>
                    <button class="btn btn-primary btn-block w-100" type="submit" name="submit">Sign Up</button>
                  <p class="mt-4 mb-0 text-center">Already have account?<a class="ms-2" href="login.php">Login</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

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
  
<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "includes/check_availablility.php",
data:'username='+$("#username").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

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

</body>
</html>