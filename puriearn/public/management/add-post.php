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
  $post_image = $_FILES["post_image"]["name"];
  $title = sanitize_input($_POST['title']);
  $description = sanitize_input2($_POST['description']);


  $target_dir = "../admin/uploads/";
  $filename = $_FILES['post_image']['name'];
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
  
  // Rename the file to avoid conflicts
  $newFilename = uniqid() . '.' . $imageFileType;
  $target_file = $target_dir . $newFilename;

  // Check file size (maximum 2MB)
  $maxFileSize = 2 * 1024 * 1024; // 2MB in bytes
  if ($_FILES["post_image"]["size"] > $maxFileSize) {
      $msg = "Sorry, your file is too large. Maximum file size is 2MB.";
      $type = "warning";
      $uploadOk = 0;
  }

  // Allow certain file formats based on MIME type
  $allowedMimeTypes = array("image/jpeg", "image/png", "image/gif");
  $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
  $mime = finfo_file($fileInfo, $_FILES["post_image"]["tmp_name"]);
  finfo_close($fileInfo);
  if(!in_array($mime, $allowedMimeTypes)) {
      $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $type = "warning";
      $uploadOk = 0;
  }

  if ($uploadOk == 1) {
      if (move_uploaded_file($_FILES["post_image"]["tmp_name"], $target_file)) {
          $msg = "Post image has been uploaded.";
          $type = "success";

           // Assuming you have a database connection established, perform the SQL insertion using prepared statements
    $sql = "INSERT INTO `tasks` (`title`, `description`, `image`, `created_at`) VALUES (?, ?, ?, ?)";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssss", $title, $description, $newFilename, $current_date);

    if ($stmt->execute()) {
        $msg = "New Post Added Successfully";
        $type = "success";
    } else {
        $msg = "Something went wrong, please try again.";
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
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">New/</span> Add Sponsored Post</h4>
 
 <div class="card mb-4">
                    <h5 class="card-header">New Post</h5>
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
                        <label class="form-label" for="basic-default-fullname">Caption</label>
                        <input type="text" name="title" class="form-control"  value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>">
                      </div>
                      <div class="mb-3 col-md-12">
                        <label class="form-label" for="basic-default-fullname">Description</label>
                        <textarea class="form-control" name="description" > </textarea>
                      </div> 
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
<?php include('include/footer.php');?>=p