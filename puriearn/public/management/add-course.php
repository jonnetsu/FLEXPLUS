<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
include('include/functions.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
$title="Add Farmer";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get the book name from the form
    $bookName = sanitize_input($_POST['book_name']);
    $amount = sanitize_input($_POST['amount']);
    $type = sanitize_input($_POST['type']);

  // Perform necessary validations and file handling
  $allowedExtensions = ["pdf", "jpeg", "jpg", "png","webp"];
  $maxFileSize = 5 * 1024 * 1024; // 5MB

  // Handle PDF file upload
  if (!empty($_FILES["pdf_file"]["name"])) {
      $pdfFile = $_FILES["pdf_file"];
      $pdfFileName = sanitizeFileName($pdfFile["name"]);

      // Validate file extension
      $pdfExtension = strtolower(pathinfo($pdfFileName, PATHINFO_EXTENSION));
      if (!in_array($pdfExtension, $allowedExtensions)) {
          $msg="Invalid file extension for PDF file";
          $type = "warning";
          die("");
      }

      // Validate file size
      if ($pdfFile["size"] > $maxFileSize) {
          $msg="PDF file size exceeds the limit";
          $type = "warning";
          die("");
      }

      // Move the uploaded PDF file to the desired location
      $pdfFilePath = "ebooks/pdfs/" . $pdfFileName;
      move_uploaded_file($pdfFile["tmp_name"], $pdfFilePath);

      // Get the image file details
      $imageFile = $_FILES["image_file"];
      $imageFileName = sanitizeFileName($imageFile["name"]);

      // Validate file extension
      $imageExtension = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));
      if (!in_array($imageExtension, $allowedExtensions)) {
        $msg="invalid file extension for image file";
        $type = "warning";
          die("");
      }

      // Validate file size
      if ($imageFile["size"] > $maxFileSize) {
        $msg="Image file size exceeds the limit";
        $type = "warning";
          die("");
      }

      // Move the uploaded image file to the desired location
      $imageFilePath = "../admin/ebooks/images/" . $imageFileName;
      move_uploaded_file($imageFile["tmp_name"], $imageFilePath);

    
      // Prepare the data for database insertion
      $fileName = $pdfFileName;
      $filePath = $pdfFilePath;
      $imageFilePath = $imageFilePath;
      $creationDate = date("Y-m-d H:i:s");

      // Insert the file details into the database
      $sql = "INSERT INTO digital_courses (`filename`, `filepath`, `image_filepath`, `creationDate`, `book_name`,`amount`,`type`)
       VALUES ('$fileName', '$filePath', '$imageFilePath', '$creationDate', '$bookName','$amount','$type')";
      // Execute the SQL query
      $result = $con->query($sql);

      if ($result) {
        $msg="Course Uploaded Successfully";
        $type = "success";
      } else {
        $msg="Error inserting data into the database: $con->error ";
        $type = "warning";
      }
  }
}
?>

  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">New/</span> Add Course</h4>
 
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
                    <form  method="post" action="" enctype="multipart/form-data">
                        <div class="row">
                        <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Book Name</label>
                        <input type="text" class="form-control" name="book_name" 
                         value="<?php if(isset($_POST['book_name'])) echo $_POST['book_name']; ?>"  />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Amount</label>
                        <input type="text" class="form-control" name="amount" 
                         value="<?php if(isset($_POST['amount'])) echo $_POST['amount']; ?>"  />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Category</label>
                        <select name="type" class="form-control" required>
                        <option value="">--SELECT COURSE CATEGORY</option>
                        <option value="1">Basic</option>
                        <option value="2">Advanced</option>
                       </select>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">PDF File</label>
                        <input type="file" name="pdf_file" accept=".pdf" class="form-control" 
                        required/>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Image File</label>
                        <input type="file" name="image_file" accept="image/*" class="form-control" 
                        required/>
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
