<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
$title="UChange Password";
$currentTime = date( 'd-m-Y h:i:s A', time () );

$aid=$_SESSION['id'];


if(isset($_POST['submit'])) {
  $aid = $_SESSION['id'];
  $password = $_POST['password'];
  $newpassword = $_POST['npassword'];
  $confirmnewpassword = $_POST['cpassword'];

  // Fetch the hashed password from the database
  $result = mysqli_query($con,"SELECT `password` FROM `admin` WHERE `id`='$aid'");
  if($row = mysqli_fetch_assoc($result)) {
      // Verify if the provided password matches the hashed password
      if(password_verify($password, $row['password'])) {
          // Check if new password and confirm password match
          if($newpassword === $confirmnewpassword) {
              // Hash the new password using bcrypt
              $newpasswordhash = password_hash($newpassword, PASSWORD_BCRYPT);
              // Update the password in the database
              $sql = mysqli_query($con,"UPDATE `admin` SET `password` = '$newpasswordhash', updationDate='$currentTime' WHERE id = '$aid'");
              if($sql) {
                  $msg = "Password Successfully Updated!!";
              } else {
                  $msg = "Error updating password!";
              }
          } else {
              $msg = "Passwords do not match!";
          }
      } else {
          $msg = "The password is not correct!";
      }
  } else {
      $msg = "The user does not exist!";
  }
}
?>


<?php include('include/header.php');?>
		
<?php include('include/sidebar.php');?>

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
			  <p style="padding-left:10vw;color:#cb0c9f;padding-top:10px;">	<?php if($msg) { echo htmlentities($msg);}?></p> 
         

<div style="margin:2%;">
<div class="form-group text-box" >

<h4>Change Password </h4>

<?php 
 if(isset($data['updationDate'])) {
  ?>
<p><b>Password Last Update Date: </b><?php echo htmlentities($data['updationDate']);?></p>
<?php   }?>
<hr />
<form role="form"  method="post" action="">
<div class="form-group">
<label for="status">
 <br>Old Password 
</label>
<input type="password" name="password" class="form-control" >
</div>
<div class="form-group">
<label for="status">
 <br>New Password 
</label>
<input type="password" name="npassword" class="form-control" >
</div>
  <div class="form-group">
  <label for="status">
  Confirm New Password</label>
<input type="password" name="cpassword" class="form-control" >
          </div>    
		  <div class="mt-2">
	<button type="submit" name="submit" class="btn btn-o btn-primary">
															Change Password
														</button>
 </div>
													</form>
												
              </div>
            </div>
          </div>
        </div>
      </div>




<?php include('include/footer.php');?>
