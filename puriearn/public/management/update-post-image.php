<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
include('include/functions.php');

$title="Add Farmer";
$current_date = date("Y-m-d");


if(isset($_GET['id']) & !empty($_GET['id'])){
    $id = $_GET['id'];
}else{
    echo "<script>window.location.href='all-posts.php';</script>";
}  

if(isset($_POST['submit']))
{

	$post_image=$_FILES["post_image"]["name"];

	
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["post_image"]["name"]);
  $filename = $_FILES['post_image']['name'];
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["post_image"]["tmp_name"]);
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
if ($_FILES["post_image"]["size"] > 500000) {
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
  if (move_uploaded_file($_FILES["post_image"]["tmp_name"], $target_file)) {
    $msg="Product image has been uploaded.";
	$type="success";

  } else {
    $msg = "Sorry, there was an error uploading yourfile";
    $type="warning";
  
  }

 
  $sql = "UPDATE `tasks` set `image`='$post_image' WHERE `id`='$id' ";
  
  $result=mysqli_query($con,$sql);
  if($result){ 

    $msg="Image Updated Successfully";
    $type = "success";
    }else{
    $msg="something went wrong,please try again";
    $type = "warning";
    }     

}
}
?>
  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">New/</span> Update Post Image</h4>
 
 <div class="card mb-4">
                    <h5 class="card-header">Update Image</h5>
                    <!-- Account -->
                    
                   
                    <hr class="my-0" />
                    <div class="card-body">
                    <?php 
                                            $query="SELECT * FROM `tasks` WHERE `id`='$id' ";
                                            $result=mysqli_query($con,$query);
                                            while($row=mysqli_fetch_array($result))
                                            { 
                                            if(isset($row['image']) & !empty($row['image'])){ ?>
                                  <h4 class="card-title">Current Image</h4>
                                            <img src="uploads/<?php echo $row['image'] ?>" width="200px" height="200px">
                                                    
                                        <?php } }?>
                    <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
                    <form  method="post" action="" enctype="multipart/form-data">
                        <div class="row">
                     
                       <div class="mb-3 col-md-12">
                        <label class="form-label" for="basic-default-fullname">Image</label>
                        <input type="file"  name="post_image" id="post_image" value="" class="form-control" required>
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
