<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
$aid=$_SESSION['id'];
$title="Edit Farmer's Details";
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"DELETE FROM `admin` WHERE id = '".$_GET['id']."'");
                  echo "<script>window.location.href='admins.php';</script>";

		  }

	if(isset($_POST) & !empty($_POST)){
		$fullname = mysqli_real_escape_string($con, $_POST['fullname']);
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$phone = mysqli_real_escape_string($con, $_POST['phone']);
		$location = mysqli_real_escape_string($con, $_POST['location']);
		$value = mysqli_real_escape_string($con, $_POST['value']);
		
			
		$sql = "UPDATE `admin` set `fullname`='$fullname',`email`='$email',`phone`='$phone',`location`='$location',`level`='$value'
        ,updationDate='$currentTime'
         WHERE `id`='$aid' ";	
			$res = mysqli_query($con, $sql);
      if($res){
        $msg="Profile Updated Successfully!";
        $type = "success";
}else{
        $msg="Failed to Update Profile";
        $type = "warning";
}
	
}
	?>
<?php include('include/header.php');?>
		
<?php include('include/sidebar.php');?>


  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin/</span> Edit Profile</h4>

<?php 
          $query="SELECT * FROM `admin` WHERE id='$aid' ";
          $result=mysqli_query($con,$query);
          while($row=mysqli_fetch_array($result))
{
    $updation_date = $row['updationDate'];
    $updation_date = date('l jS F Y \a\t g:ia');
    ?>
 
 <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          src="assets/img/avatars/1.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                        />
                        <div class="button-wrapper">
                       
                       <?php 
                if(isset($row['updationDate'])) {
                ?>
<p class="text-muted mb-0">Last Updated On <?php echo $updation_date;?></p>
                <?php   }?>     
                      </div>
			  
                      </div>
                    </div>

                    <hr class="my-0" />
                    <div class="card-body">
                    <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
                    <form  method="post" enctype="multipart/form-data">
                        <div class="row">
                        <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Full Name</label>
                        <input type="text" class="form-control" name="fullname"  value="<?php echo $row['fullname']; ?>" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Usernname</label>
                        <input type="text" class="form-control"
                         value="<?php echo $row['username']; ?>" disabled />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Email</label>
                        <input type="email" class="form-control"
                         value="<?php echo $row['email']; ?>" disabled />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-phone">Phone No</label>
                        <input
                          type="text" class="form-control phone-mask"
                          value="<?php echo $row['phone']; ?>"
                          name="phone"
                        />                  
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-company">Location</label>
                        <input type="text" class="form-control" name="location" value="<?php echo $row['location']; ?>" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-company">Code</label>
                        <input type="text" class="form-control" name="value" value="<?php echo $row['level']; ?>" />
                      </div>

                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2" type="submit" name="submit" >Save changes</button>
                          <a href="change-password.php" class="text-danger">Change Password</a>

                        </div>
                      </form>

                    </div>
                    <!-- /Account -->

                  </div>

</div></div>

                <?php }?>
              </div>
            </div>
            <!-- / Content -->




<?php include('include/footer.php');?>
