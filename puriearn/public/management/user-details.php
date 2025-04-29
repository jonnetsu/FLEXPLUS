<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
$title="Admins";

$currentTime = date( 'd-m-Y h:i:s A', time () );

error_reporting(E_ALL);
ini_set('display_errors', '1');

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"DELETE FROM users WHERE id = '".$_GET['id']."'");
                  echo "<script>window.location.href='users.php';</script>";

		  }

if(isset($_GET) & !empty($_GET)){
	$uid=intval($_GET['uid']);// farmer's id
}else{
		echo "<script>window.location.href='users.php';</script>";
	}

$uid=intval($_GET['uid']);// farmer's id

if(isset($_POST) && !empty($_POST)){
  
$fullname = mysqli_real_escape_string($con, $_POST['fullname']);
$phone = mysqli_real_escape_string($con, $_POST['phone']);
//$referred_by = mysqli_real_escape_string($con, $_POST['referred_by']);
$ref_bonus = mysqli_real_escape_string($con, $_POST['ref_bonus']);
$job_balance = mysqli_real_escape_string($con, $_POST['job_balance']);
$ads_balance = mysqli_real_escape_string($con, $_POST['ads_balance']);
$indirect_ref_bonus = mysqli_real_escape_string($con, $_POST['indirect_ref_bonus']);
$tiktok_balance = mysqli_real_escape_string($con, $_POST['tiktok_balance']);
$telegram = mysqli_real_escape_string($con, $_POST['telegram']);
$twitter = mysqli_real_escape_string($con, $_POST['twitter']);
$youtube = mysqli_real_escape_string($con, $_POST['youtube']);
$tiktok = mysqli_real_escape_string($con, $_POST['tiktok']);
$bank = mysqli_real_escape_string($con, $_POST['bank']);
$account_name = mysqli_real_escape_string($con, $_POST['account_name']);
$account_number = mysqli_real_escape_string($con, $_POST['account_number']);
$coupon_account_bal=mysqli_real_escape_string($con, $_POST['coupon_account_bal']);
$sql = "UPDATE `users` SET `fullname`='$fullname', `phone`='$phone',`ref_bonus`='$ref_bonus',`coupon_account_bal`='$coupon_account_bal',
         `job_balance`='$job_balance', `indirect_ref_bonus`='$indirect_ref_bonus', `youtube`='$youtube', `telegram`='$telegram',
         `twitter`='$twitter', `tiktok`='$tiktok', `bank_name`='$bank',`ads_balance`='$ads_balance',
         `account_name`='$account_name', `account_number`='$account_number', `updated_at`='$currentTime'
         WHERE `id`='$uid' ";    
$res = mysqli_query($con, $sql);
if($res){
    $msg = "Profile Updated Successfully!";
    $type = "success";
} else {
    $msg = "Failed to Update Profile";
    $type = "warning";
}



    }
	?>

  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User/</span> Edit Profile</h4>

<?php 
          $query="SELECT * FROM users WHERE id='$uid' ";
          $result=mysqli_query($con,$query);
          while($row=mysqli_fetch_array($result))
{?>
 
 <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          src="../admin/profilepics/<?php echo $row['user_picture'] ?>"
                          alt="Profile Picture"
                          class="d-block rounded"
                          height="100"
                          width="100"
                        />
                       
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
                        <label class="form-label" for="basic-icon-default-email">Username</label>
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
                        <label class="form-label" for="basic-default-company">Referred By</label>
                         <input type="text" class="form-control" name="referred_by" value="<?php echo $row['referred_by']; ?>" disabled/>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Affiliate Balance</label>        
                       <input type="text" class="form-control" name="ref_bonus"  value="<?php echo $row['ref_bonus']; ?>" />
                      </div> 
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Job Balance</label>        
                       <input type="text" class="form-control" name="job_balance"  value="<?php echo $row['job_balance']; ?>" />
                      </div> 
                      
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Ads Balance</label>        
                       <input type="text" class="form-control" name="ads_balance"  value="<?php echo $row['ads_balance']; ?>" />
                      </div> 
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Indirect Affiliate Balance</label>        
                       <input type="text" class="form-control" name="indirect_ref_bonus"  value="<?php echo $row['indirect_ref_bonus']; ?>" />
                      </div> 
                        <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Tiktok Balance</label>        
                           <input type="text" class="form-control" name="tiktok_balance"  value="<?php echo $row['tiktok_balance']; ?>" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Vendor Coupon Account Balance</label>        
                           <input type="text" class="form-control" name="coupon_account_bal"  value="<?php echo $row['coupon_account_bal']; ?>" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Youtube</label>        
                   <input type="text" class="form-control" name="youtube"  value="<?php echo $row['youtube']; ?>" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Twitter</label>        
                   <input type="text" class="form-control" name="twitter"  value="<?php echo $row['twitter']; ?>" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Telegram</label>        
                   <input type="text" class="form-control" name="telegram"  value="<?php echo $row['telegram']; ?>" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Tiktok</label>        
                   <input type="text" class="form-control" name="tiktok"  value="<?php echo $row['tiktok']; ?>" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Bank Name</label>        
                        <input type="text" class="form-control" name="bank"  value="<?php echo $row['bank_name']; ?>" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Account Holder Name</label>        
                        <input type="text" class="form-control" name="account_name"  value="<?php echo $row['account_name']; ?>" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Account Number</label>        
                        <input type="text" class="form-control" name="account_number"  value="<?php echo $row['account_number']; ?>" />
                      </div>
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2" type="submit" name="submit" >Save changes</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                      <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                          <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                          <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                      </div>
                       
                        <a href="?id=<?php echo $row['id'];?>&del=delete" 
                        onClick="return confirm('Are you sure you want to delete this user account?')" class="btn btn-danger deactivate-account">
                        Delete Account</a>
                    </div>
                  </div>
                </div>

</div></div>

                <?php }?>
              </div>
            </div>
            <!-- / Content -->




<?php include('include/footer.php');?>
