<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
include('include/functions.php');
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);


$title="Add Farmer";
$current_date = date("Y-m-d");

if(isset($_POST['submit'])) {
  $title = sanitize_input($_POST['title']);
  $tag = sanitize_input($_POST['tag']);
  $type = sanitize_input($_POST['type']);
  $instructions = sanitize_input2($_POST['instructions']);


  // Assuming you have a database connection established, perform the SQL insertion using prepared statements
  $sql = "INSERT INTO `tiktok_tasks` (`title`,`tag`,`video_type`, `instructions`, `created_at`) VALUES (?, ?, ?, ? ,?)";

  $stmt = $con->prepare($sql);
  $stmt->bind_param("sssss", $title,$tag,$type, $instructions, $current_date);

  if ($stmt->execute()) {
      $msg = "New Task Added Successfully";
      $type = "success";
  } else {
      $msg = "Something went wrong, please try again.";
      $type = "warning";
  }


 
}

?>

  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">New/</span> Add Tiktok Task</h4>
 
 <div class="card mb-4">
                    <h5 class="card-header">New Task</h5>
                    <!-- Account -->
                    <hr class="my-0" />
                    <div class="card-body">
                    <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
                    <form  method="post" action="" enctype="multipart/form-data">
                        <div class="row">
                      <div class="mb-3 col-md-12">
                        <label class="form-label" for="basic-default-fullname">Title</label>
                        <input type="text" name="title" class="form-control"  value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>">
                      </div>
                      <div class="mb-3 col-md-12">
                        <label class="form-label" for="basic-default-fullname">Tag</label>
                        <input type="text" name="tag" class="form-control"  value="<?php if(isset($_POST['tag'])) echo $_POST['tag']; ?>" placeholder="@puriearn">
                      </div>
                      <div class="mb-3 col-md-12">
                        <label class="form-label" for="basic-default-fullname">Video Type</label>
                        <input type="text" name="type" class="form-control"  value="<?php if(isset($_POST['type'])) echo $_POST['type']; ?>" placeholder="Dancing">
                      </div>
                      <div class="mb-3 col-md-12">
                        <label class="form-label" for="basic-default-fullname">Instructions</label>
                        <textarea class="form-control" name="instructions" > </textarea>
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