<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('includes/checklogin.php');
include 'includes/functions.php';

check_login();
$title="Dashboard";
$uip=$_SERVER['REMOTE_ADDR'];
include 'includes/header.php'; 

$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_GET['del']))
		  {

				     $sql = "UPDATE `users` SET  `user_Picture`='avatar.png' WHERE `id` = '".$_GET['id']."' ";	
					 $res = mysqli_query($con, $sql);
					 if($res){
						$msg="Profile Picture Deleted Successfully!";
						$type = "success";
					 }else{
						$msg="Failed to Delete Image";
						$type = "warning";
						}

		  }

$uid= $_SESSION['id'];
$username=$_SESSION['username'];
$sql = "SELECT * FROM `users` WHERE `id`=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$fullname=$row['fullname'];
$email=$row['email'];
$phone=$row['phone'];
$username=$row['username'];
$bank=$row['bank'];
$profile_pic=$row['user_picture'];
$referred_by=$row['referred_by'];

$activity_balance=$row['earnings'];
$referral_balance=$row['ref_bonus'];

$date_string=$row['created_at'];// date retrieved from database
$timestamp = strtotime($date_string); // convert date string to Unix timestamp
$joined = date("d-m-Y", $timestamp);// format timestamp into words

//Update Personal Details
if(isset($_POST['submit']))
{
    $phone = mysqli_real_escape_string($con, $_POST['phone']);

 
    $phone=mysqli_real_escape_string($con,$phone);


  $sql = "UPDATE `users` set `phone`='$phone',updated_at='$currentTime'
         WHERE `id`='$uid' ";	
			$res = mysqli_query($con, $sql);
      if($res){
        $msg="Phone Number Updated Successfully!";
        $type = "success";
        ?>
        <script>
        setTimeout(function () {
        window.location ='profile.php';
        }, 1700);
        </script>
       <?php
}else{
        $msg="Failed to Update Phone Number";
        $type = "warning";
}

}

//Update Social medial accounts
if(isset($_POST['submit-two']))
{
    $youtube = sanitize_input($_POST['youtube']);
    $tiktok = sanitize_input($_POST['tiktok']);
    $telegram = sanitize_input($_POST['telegram']);
    $twitter = sanitize_input($_POST['twitter']);
   

    $tiktok=mysqli_real_escape_string($con,$tiktok);
   
  $sql = "UPDATE `users` set `youtube`='$youtube',`tiktok`='$tiktok',`telegram`='$telegram',`twitter`='$twitter',updated_at='$currentTime'
         WHERE `id`='$uid' ";	
			$res = mysqli_query($con, $sql);
      if($res){
        $msg="Social Account Details Updated Successfully!";
        $type = "success";
        ?>
        <script>
        setTimeout(function () {
        window.location ='profile.php';
        }, 1700);
        </script>
       <?php

}else{
        $msg="Failed to Update Phone Number";
        $type = "warning";
}

}

?>
<style>
  .popup-container {
    display: none;
    position: fixed;
	bottom:0;
	width:100%;
    background-color: #fff;
    border-radius: 10px 10px 5px 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
	background:#fff;
	z-index: 999;
  }

  .popup-button {
    margin: 10px;
    padding: 8px 16px;
    background-color: #4285f4;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  .popup-wrapper{
	display:flex;
	flex-direction:column;
	align-items:center;
	justify-content:center;
  }
  .picture-button{
	border-bottom:.5px solid #00ac46;
	width:100%;
	padding:13px;
	text-align:center;
	color:#041e4f;
	font-size:15px;
	font-weight:500;
  }
</style>


  <!-- Page Sidebar Ends-->
  <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>User Profile</h4>
                </div>
              
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
          <?php if(isset($msg)){ ?>
                                <div class="alert alert-<?php echo $type?>">
                                <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                                <p class="mb-0"><?php echo $msg?></p>
                                </div>
                            <?php }?>
            <div class="user-profile">
              <div class="row">
                <!-- user profile first-style start-->
                <div class="col-sm-12">
                  <div class="card hovercard text-center">
                    <div class="cardheader" style="height:200px;" ></div>
                    <div class="user-image">
                      <div class="avatar"><img alt="" src="../admin/profilepics/<?php echo $profile_pic; ?>"></div>
                      <div class="icon-wrapper" data-bs-toggle="dropdown" onclick="showPopup()"><i class="fa fa-pencil"></i></div>
                    </div>
                    <div class="dropdown-menu p-0">
                        <a class="dropdown-item" href="update-profile-pic.php">Change Profile Picture</a>
                        <a class="dropdown-item" href="?id=<?php echo $uid;?>&del=delete" onClick="return confirm('Are you sure you want to delete profile picture ?')">Delete Profile Picture</a>
                        <a class="dropdown-item" href="security.php">Security</a>
                    </div>
                    <div class="info">
                      <div class="row">
                        <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="ttl-info text-start">
                                <h6><i class="fa fa-envelope"></i> Email</h6><span><?php echo $email ;?></span>
                              </div>
                            </div>
                            <?php 
									 if($phone !== "") {
									?>
                            <div class="col-md-6">
                              <div class="ttl-info text-start">
                                <h6><i class="fa fa-phone"></i> Phone</h6><span><?php echo $phone ;?></span>
                              </div>
                            </div>
                            <?php } ?>
                          </div>
                        </div>
                        <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                          <div class="user-designation">
                            <div class="title"><a target="_blank" href=""><?php echo $fullname ;?></a></div>
                            <div class="desc"><?php echo $username ;?></div>
                          </div>
                        </div>
                        
                      </div>
                                          
                     
                    </div>
                  </div>
                </div>
                <!-- user profile first-style end-->
                <!-- user profile second-style start-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body pt-3"> 
                            <h4 class="mb-3">Update Phone Number</h4>
                            <form class="" method="post" action="">
                                    <div class="row g-3">
                                        <div class="col-12"> 
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" name="phone" class="form-control" 
                                                                value="<?php echo $row['phone']; ?>" required>
                                        </div>
                                        <div class="col-12"> 
                                                <button type="submit" class="btn btn-primary w-100" name="submit">Update</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>

                 <!-- user profile second-style start-->
                 <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body pt-3"> 
                            <h4 class="mb-3">Update Social Media Handles</h4>
                            <form class="" method="post" action="">
                                    <div class="row g-3">
                                        <div class="col-12"> 
                                            <label class="form-label">Youtube</label>
                                            <input type="text" name="youtube" class="form-control" 
                                                                value="<?php echo $row['youtube']; ?>">
                                        </div>
                                        <div class="col-12"> 
                                            <label class="form-label">Tiktok</label>
                                            <input type="text" name="tiktok" class="form-control" 
                                                                value="<?php echo $row['tiktok']; ?>">
                                        </div>
                                        <div class="col-12"> 
                                            <label class="form-label">X(Twitter)</label>
                                            <input type="text" name="twitter" class="form-control" 
                                                                value="<?php echo $row['twitter']; ?>">
                                        </div>
                                        <div class="col-12"> 
                                            <label class="form-label">Telegram</label>
                                            <input type="text" name="telegram" class="form-control" 
                                                                value="<?php echo $row['telegram']; ?>">
                                        </div>
                                        <div class="col-12"> 
                                                <button type="submit" class="btn btn-primary w-100" name="submit-two">Update</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>

          </div>
          <!-- Container-fluid Ends-->
        </div>
      

 <!-- Popup HTML code -->
<div id="popup" style="display: none;" class="popup-container">
 <div class="popup-wrapper">
 <span class="picture-button" onclick="closePopup()" >Close</span>
 <a href="update-profile-pic.php" class="picture-button">Change Image</a>
 <a href="?id=<?php echo $uid;?>&del=delete" class="picture-button"  
 onClick="return confirm('Are you sure you want to delete profile picture ?')" 
 style="border-bottom:none;color:#ff0000">Delete Image</a>

  </div>
</div>

	<!-- JavaScript code to profile picture options-->
<script>
  function showPopup() {
    var popup = document.getElementById("popup");
    popup.style.display = "block";
  }


  function closePopup() {
    var popup = document.getElementById("popup");
    popup.style.display = "none";
  }

</script>

<?php include 'includes/footer.php' ?>