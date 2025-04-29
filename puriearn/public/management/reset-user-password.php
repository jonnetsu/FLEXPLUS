<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
$title="UChange Password";
$currentTime = date( 'd-m-Y h:i:s A', time () );


if (isset($_GET['uid']) && !empty($_GET['uid'])) {
    $uid = intval($_GET['uid']); // farmer's id
} else {
    echo "<script>window.location.href='users.php';</script>";
    exit(); // Add an exit statement to stop further execution
}

if (isset($_POST['submit'])) {
  $newpassword = $_POST['npassword'];
  $confirmnewpassword = $_POST['cpassword'];

  if ($newpassword === $confirmnewpassword) {
      // Hash the new password using password_hash
      $newpasswordhash = password_hash($newpassword, PASSWORD_DEFAULT);
      $sql = "UPDATE users SET password = '$newpasswordhash', updated_at = '$currentTime' WHERE id = '$uid'";
      $result = mysqli_query($con, $sql);

      if ($result) {
          $msg = "Password Successfully Updated!!";
          $type = "success";
      } else {
          $msg = "An error occurred while updating the password.";
          $type = "warning";
      }
  } else {
      $msg = "Passwords do not match!";
      $type = "warning";
  }
} else {
  $msg = ""; // Set an empty value for $msg
  $type = ""; // Set an empty value for $type
}
  
?>


<?php include('include/header.php');?>
		
<?php include('include/sidebar.php');?>

<style>
  .form-box {
    position: relative;
    margin-bottom:20px;
  }

  .password-toggle {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
  }
</style>


<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            
            <div class="card-body px-0 pt-0 pb-2">
            <div class="card-body">
                    <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>         

<div style="margin:2%;">
<div class="form-group text-box" >

<h4>Reset User Password </h4>

<?php 
 if(isset($data['updationDate'])) {
  ?>
<?php   }?>
<hr />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<form role="form" method="post" action="">
  <div class="form-group form-box">
    <input type="password" name="npassword" id="npassword" class="form-control" placeholder="New Password" required>
    <span id="npassword-toggle" class="password-toggle" onclick="togglePasswordVisibility('npassword')"><i class="fas fa-eye"></i></span>
  </div>
  <div class="form-group form-box">
    <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm New Password" required>
    <span id="cpassword-toggle" class="password-toggle" onclick="togglePasswordVisibility('cpassword')"><i class="fas fa-eye"></i></span>
  </div>
  <div class="mt-2">
    <button type="submit" name="submit" class="btn btn-o btn-primary">Change Password</button>
  </div>
</form>



												
              </div>
            </div>
          </div>
        </div>
      </div>



      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

      <script>
  function togglePasswordVisibility(inputId) {
    const passwordInput = document.getElementById(inputId);
    const passwordToggle = document.getElementById(inputId + "-toggle");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      passwordToggle.innerHTML = '<i class="fas fa-eye-slash"></i>';
    } else {
      passwordInput.type = "password";
      passwordToggle.innerHTML = '<i class="fas fa-eye"></i>';
    }
  }
</script>

<?php include('include/footer.php');?>
