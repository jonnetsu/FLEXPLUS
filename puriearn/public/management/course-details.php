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

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"DELETE FROM digital_courses WHERE id = '".$_GET['id']."'");
                  echo "<script>window.location.href='courses.php';</script>";

		  }

if(isset($_GET) & !empty($_GET)){
	$cid=intval($_GET['cid']);// farmer's id
}else{
		echo "<script>window.location.href='courses.php';</script>";
	}

$cid=intval($_GET['cid']);// farmer's id

if(isset($_POST) && !empty($_POST)){
  
$name = mysqli_real_escape_string($con, $_POST['name']);
$type = mysqli_real_escape_string($con, $_POST['type']);
$amount = mysqli_real_escape_string($con, $_POST['amount']);
$description = mysqli_real_escape_string($con, $_POST['description']);

$sql = "UPDATE `digital_courses` SET `book_name`='$name', `amount`='$amount', `type`='$type',`description`='$description',
             `updationDate`='$currentTime'
         WHERE `id`='$cid' ";    
$res = mysqli_query($con, $sql);
if($res){
    $msg = "Course Updated Successfully!";
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
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Course/</span> Edit Course</h4>

<?php 
          $query="SELECT * FROM digital_courses WHERE id='$cid' ";
          $result=mysqli_query($con,$query);
          while($row=mysqli_fetch_array($result))
{?>
 
 <div class="card mb-4">
                    <h5 class="card-header">Course Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          src="../admin/<?php echo $row['image_filepath'];?>"
                          alt="Profile Picture"
                          class="d-block rounded"
                        
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
                    <form  method="post">
                        <div class="row">
                        <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Name</label>
                        <input type="text" class="form-control" name="name"  value="<?php echo $row['book_name']; ?>" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Amount</label>
                        <input type="text" class="form-control" name="amount"
                         value="<?php echo $row['amount']; ?>"  />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Type</label>
                        <select name="type" class="form-control" required>
                        <option value="1" <?php echo ($row['type'] == 1) ? 'selected' : ''; ?>>Basic</option>
                        <option value="2" <?php echo ($row['type'] == 2) ? 'selected' : ''; ?>>Advanced</option>
                       </select>

                      </div>
                      <div class="mb-3 col-md-12">
                        <label class="form-label" for="basic-default-fullname">Description</label>
                        <textarea class="form-control" name="description" ><?php echo $row['description']; ?></textarea>
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
                          <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete this course?</h6>
                          <p class="mb-0">Once you delete this course, there is no going back. Please be certain.</p>
                        </div>
                      </div>
                       
                        <a href="?id=<?php echo $row['id'];?>&del=delete" 
                        onClick="return confirm('Are you sure you want to delete this course?')" class="btn btn-danger deactivate-account">
                        Delete Course</a>
                    </div>
                  </div>
                </div>

</div></div>

                <?php }?>
              </div>
            </div>
            <!-- / Content -->




<?php include('include/footer.php');?>
