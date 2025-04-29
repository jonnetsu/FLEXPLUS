<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
$title="Admins";

ini_set('display_errors', 1); error_reporting(E_ALL);

$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_GET) & !empty($_GET)){
	$uid=intval($_GET['uid']);// farmer's id
}else{
		echo "<script>window.location.href='users.php';</script>";
	}

$uid=intval($_GET['uid']);// farmer's id


$sql = "SELECT * FROM users WHERE `id`='$uid' ";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);

if(isset($_POST['submit'])) {
  $amount = $_POST['amount'];
  $balance = $row['tiktok_balance'];
  $newBalance=$balance+$amount;

  $sql1 = "UPDATE `users` SET `tiktok_balance` = '$newBalance' WHERE `id` = '$uid'";
  $result1 = mysqli_query($con, $sql1);

  if($result1) {
      $msg = "Reward Added Successfully";
      $type = "success";

       //Set a bonus message to send as a notification
       $bonus_message="Congrats! You just received ₦$amount TikTok Task  reward.";    
       $notificationsql="INSERT INTO `notifications` (`receiver_id`,`action_type`,`body`)
                                 VALUES  ('$uid','Tiktok Task','$bonus_message')";
       $result2=mysqli_query($con,$notificationsql);

          // Enter the earning history
          $earningsql = "INSERT INTO `earning_history` (`user_id`, `amount`) VALUES ('$uid', '$amount' )";
          $result4 = mysqli_query($con, $earningsql);
          
  } else {
      $msg = "Something went wrong. Please try again";
      $type = "warning";
  }
}



?>

  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User/</span> Add TikTok Reward - <?php echo $row['username'] ?></h4>

<?php 
          $query="SELECT * FROM users WHERE id='$uid' ";
          $result=mysqli_query($con,$query);
          while($row=mysqli_fetch_array($result))
{?>
 
 <div class="card mb-4">
                    <h5 class="card-header">Tiktok Balance - ₦<?php echo $row['tiktok_balance'] ?></h5>
                  
                    <hr class="my-0" />
                    <div class="card-body">
                    <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
                    <form  method="post" enctype="multipart/form-data">

                        <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Amount</label>
                        <input type="text" class="form-control" name="amount"  value="" />
                        </div>
                     
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2" type="submit" name="submit" >Add Reward</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                
                </div>

</div></div>

                <?php }?>
              </div>
            </div>
            <!-- / Content -->




<?php include('include/footer.php');?>
