<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('includes/checklogin.php');
include 'includes/functions.php';

check_login();
$title="Dashboard";
include 'includes/header.php'; 
$today = date("Y-m-d");

$uid= $_SESSION['id'];
$username=$_SESSION['username'];
$sql = "SELECT * FROM `users` WHERE `id`=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$uplan=$row['plan_id'];
$bank=$row['bank_name'];


if(isset($_POST['submit'])){

   $profile_image=$_FILES["profile_image"]["name"];
	
   $target_dir = "../admin/profilepics/";
   $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
   $filename = $_FILES['profile_image']['name'];
   $uploadOk = 1;
   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 
   // Check if image file is a actual image or fake image
   if(isset($_POST["submit"])) {
     $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
     if($check !== false) {
     
       $uploadOk = 1;
     } else {
       $msg = " file is not an image";
       $type = "warning";
       $uploadOk = 0;
     }
   }
 
 // Check if file already exists
 if (file_exists($target_file)) {
     $msg = "file already exists";
     $type = "warning";
     $uploadOk = 0;
 }
 
 // Check file size
 if ($_FILES["profile_image"]["size"] > 500000) {
     $msg = "Sorry your file is too large";
     $type = "warning";
     $uploadOk = 0;
 }
 
 // Allow certain file formats
 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
 && $imageFileType != "gif" ) {
   $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
   $type = "warning";
   $uploadOk = 0;
 }
  else {
   if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
    $sql = "UPDATE `users` SET `user_picture`='$profile_image' WHERE `id`='$uid' ";
    $result=mysqli_query($con,$sql);
    if($result){ 
  
      $msg="Profile Image Updated Successfully";
      $type = "success";
      }else{
      $msg="something went wrong,please try again";
      $type = "warning";
      }     
     
   } else {
     $msg = "Sorry, there was an error uploading your file";
     $type="warning";
   
   }  
 

}
}

?>

<!-- Page Sidebar Ends-->
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12">
                  <h4>Change Profile Picture</h4>
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

                        
                    <div class="card border-0">
                    <div class="card-body pt-3">
								<form action="#" class="invest-form" method="post" enctype="multipart/form-data">
                                   
									<div class="row g-3">
                      <div class="col-12"> 
                          <label class="form-label">Image</label>
													  <input type="file" name="profile_image" id="profile_image" class="form-control " >
                      </div>
                      <div class="col-12"> 
				                <button type="submit" name="submit" class="btn btn-primary w-100">Upload</button>
					            </div>
											
											
										</div>
										
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

<?php include 'includes/footer.php' ?>
