<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
$title="Add Farmer";

if(isset($_POST['submit'])) {
  $fullname = $_POST['fullname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $location = $_POST['location'];
  $contact = $_POST['phone'];
  $password = $_POST['password'];
  $repassword = $_POST['repassword'];

  // Regular expressions for validation
  $name = "/^[A-Z][a-zA-Z ]+$/";
  $emailValidation = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z]{2,3})$/';
  $number = "/^[0-9]+$/";

  if(empty($username) || empty($password)) {
      $msg = "All fields are required";
      $type = "warning";
  } elseif(!preg_match($emailValidation, $email)) {
      $msg = 'Please enter a valid email';
      $type = "warning";
  } elseif($password != $repassword) {
      $msg = 'Passwords should be the same!';
      $type = "warning";
  } elseif(!preg_match($number, $contact)) {
      $msg = 'Please enter a valid number';
      $type = "warning";
  } else {
      // Escape inputs to prevent SQL injection
      $fullname = mysqli_real_escape_string($con, $fullname);
      $username = mysqli_real_escape_string($con, $username);
      $email = mysqli_real_escape_string($con, $email);
      $location = mysqli_real_escape_string($con, $location);
      $contact = mysqli_real_escape_string($con, $contact);

      // Hash the password using bcrypt
      $password = password_hash($password, PASSWORD_BCRYPT);

      // Check if username already exists in the database
      $sql = "SELECT `username` FROM admin WHERE `username`='$username' LIMIT 1";
      $result = mysqli_query($con, $sql);
      if(mysqli_num_rows($result) > 0) {
          $msg = "An admin with the username '$username' already exists";
          $type = "warning";
      } else {
          // Insert new admin into the database
          $sql1 = "INSERT INTO `admin` (`username`, `email`, `fullname`, `location`, `phone`, `password`)
                  VALUES  ('$username','$email','$fullname','$location','$contact','$password')";
          $result1 = mysqli_query($con, $sql1);
          if($result1) {
              $msg = "New Admin Added Successfully !!";
              $type = "success";
          } else {
              $msg = "Something went wrong, please try again";
              $type = "warning";
          }
      }
  }
}


?>

  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">New/</span> Add Admin</h4>
 
 <div class="card mb-4">
                    <h5 class="card-header">New Admin</h5>
                    <!-- Account -->
                    <hr class="my-0" />
                    <div class="card-body">
                    <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
                    <form  method="post" action="">
                        <div class="row">
                        <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Full Name</label>
                        <input type="text" class="form-control" name="fullname" 
                         value="<?php if(isset($_POST['fullname'])) echo $_POST['fullname']; ?>"  />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Username</label>
                        <input type="text" class="form-control" name="username" 
                         value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>"  required/>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Email</label>
                        <input type="email" class="form-control" name="email" 
                         value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required />
                      </div> 
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Location</label>
                        <input type="text" class="form-control" name="location" 
                         value="<?php if(isset($_POST['location'])) echo $_POST['location']; ?>"  />
                      </div>
                    
                       <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Contact Number</label>
                        <input type="text" class="form-control" name="phone" 
                         value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>"  />
                      </div> 
                      
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Password</label>
                        <input type="password" class="form-control" name="password" required />
                      </div> <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Confirm Password</label>
                        <input type="password" class="form-control" name="repassword"  required />
                      </div>
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2" type="submit" name="submit" >Submit</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                

</div></div>

             
              </div>
            </div>
            <!-- / Content -->



                  
<?php include('include/footer.php');?>
