<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('includes/checklogin.php');
check_login();


error_reporting(E_ALL);
ini_set('display_errors', 1);

$title = "Job Details";
$uip = $_SERVER['REMOTE_ADDR'];
include 'includes/header.php';
include 'includes/functions.php';

// Assuming job_id is passed as a GET parameter
if(!isset($_GET['job_id'])) {
    header("Location: advert-task.php");
}   
    $job_id = $_GET['job_id'];

    // Fetch job details from the database
    $job_sql = "SELECT * FROM job_adverts WHERE id = $job_id";
    $job_result = mysqli_query($con, $job_sql);
    $job = mysqli_fetch_assoc($job_result);


    $title = $job['title'];
    $description = $job['description'];
    $amount_per_task = $job['amount_per_task'];
    $num_tasks = $job['num_tasks'];
    $num_completed = $job['num_completed'];
    $screenshots_required = $job['screenshots_required'];
    $sample_screenshots = $job['sample_screenshots'];
    $banner = $job['banner'];

    // Check if the user has already performed the task
$user_id = $_SESSION['id'];
$task_completed = false;
$check_task_sql = "SELECT * FROM user_job_tasks WHERE user_id = '$user_id' AND job_id = '$job_id'";
$check_task_result = mysqli_query($con, $check_task_sql);
if (mysqli_num_rows($check_task_result) > 0) {
    $task_completed = true;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['job_id'])) {
        $job_id = mysqli_real_escape_string($con, $_POST['job_id']);
        $user_id = $_SESSION['id'];

        // Function to compress image
        function compressImage($source, $destination, $quality) {
            $info = getimagesize($source);
            // Check if the required GD functions are available
            if (function_exists('imagecreatefromjpeg') && function_exists('imagejpeg')) {
                if ($info['mime'] == 'image/jpeg') {
                    $image = imagecreatefromjpeg($source);
                    imagejpeg($image, $destination, $quality);
                }
            } elseif (function_exists('imagecreatefrompng') && function_exists('imagepng')) {
                if ($info['mime'] == 'image/png') {
                    $image = imagecreatefrompng($source);
                    imagepng($image, $destination, $quality / 10);
                }
            }
            // If the required functions are not found, simply move the file without compression
            move_uploaded_file($source, $destination);
        }

        // Handle file upload if screenshot is required
        if (!empty($_FILES['screenshot']['name'][0])) {
            $screenshot_names = [];
            foreach ($_FILES['screenshot']['name'] as $key => $name) {
                $target_dir = "../admin/screenshots/";
                $unique_name = uniqid() . '.' . pathinfo($name, PATHINFO_EXTENSION);
                $target_file = $target_dir . $unique_name;
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if file is an actual image
                $check = getimagesize($_FILES['screenshot']['tmp_name'][$key]);
                if ($check === false) {
                    $msg = "File is not an image";
                    $type = "warning";
                    $uploadOk = 0;
                }

                // Check file size
                if ($_FILES['screenshot']['size'][$key] > 500000) {
                    $msg = "Sorry, your file is too large";
                    $type = "warning";
                    $uploadOk = 0;
                }

                // Allow only certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $type = "warning";
                    $uploadOk = 0;
                }

                // Upload the file if everything is ok
                if ($uploadOk) {
                    // Compress and move the uploaded file
                    compressImage($_FILES['screenshot']['tmp_name'][$key], $target_file, 75);

                    // Check if file is successfully uploaded
                    if (file_exists($target_file)) {
                        $screenshot_names[] = $unique_name;
                        // Insert the screenshot record into the job_advert_screenshots table
                        $insert_screenshot_sql = "INSERT INTO job_advert_screenshots (job_id, user_id, url, created_at) VALUES ('$job_id', '$user_id', '$unique_name', NOW())";            
                        mysqli_query($con, $insert_screenshot_sql);
                    } else {
                        $msg = "Sorry, there was an error uploading your file.";
                        $type = "warning";
                    }
                }
            }
            $screenshot_files = implode(',', $screenshot_names);
        }

        // Insert into user_job_tasks table
        $insert_sql = "INSERT INTO user_job_tasks (user_id, job_id,completed, completed_at) VALUES ('$user_id', '$job_id','1', NOW())";
        if (mysqli_query($con, $insert_sql)) {
            // Update job_adverts table
            $update_sql = "UPDATE job_adverts SET num_completed = num_completed + 1 WHERE id = $job_id";
            if (mysqli_query($con, $update_sql)) {
                // Check if num_tasks is equal to num_completed after update
                $check_sql = "SELECT num_tasks, num_completed FROM job_adverts WHERE id = $job_id";
                $result = mysqli_query($con, $check_sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row['num_tasks'] == $row['num_completed']) {
                        // Update completed column to 1
                        $complete_sql = "UPDATE job_adverts SET completed = 1 WHERE id = $job_id";
                        mysqli_query($con, $complete_sql);
                    }
                }
        
                $msg = "Task successfully submitted. Wait for review";
                $type = "success";
                // Redirect to job list page
                ?>
                <script>
                setTimeout(function () {
                    window.location = 'advert-task.php';
                }, 3000);
                </script>
                <?php
            } else {
                $msg = "Error updating num_completed: " . mysqli_error($con);
                $type = "warning";
            }
        } else {
            $msg = "Error inserting task: " . mysqli_error($con);
            $type = "warning";
        }
                
    }
}
?>
   <div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <h4>Task Details</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
                         <?php if(isset($msg)){ ?>
                                <div class="alert alert-<?php echo $type?>">
                                <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                                <p class="mb-0"><?php echo $msg?></p>
                                </div>
                        <?php }?>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3 text-success"><?php echo $title; ?></h4>
  
                    <?php if ($banner) { ?>
                    <div class="col-xl-4 col-sm-4 mb-3">
                        <img src="../admin/adverts/<?php echo $banner; ?>" alt="Banner" class="img-fluid mb-3" style="width:100%;">
                    </div>

                    <h5>Description:</h5>
                    <?php } ?>
                                        <?php
                    function makeLinksClickable($text) {
                        $urlPattern = '/(https?:\/\/[^\s]+)/';
                        $clickableText = preg_replace($urlPattern, '<a href="$1" target="_blank">$1</a>', $text);
                        return $clickableText;
                    }

                    $descriptionWithLinks = makeLinksClickable($description);
                    ?>
                    <p><?php echo $descriptionWithLinks; ?></p>
                    <h5>Amount per Task:</h5>
                    <p><?php echo $amount_per_task; ?> NGN</p>
                    <h5>Number of Employees:</h5>
                    <p><?php echo $num_tasks; ?></p>
                    <h5>Number of Tasks Completed:</h5>
                    <p><?php echo $num_completed; ?></p>
                    <h5>Screenshots Required:</h5>
                    <p><?php if($screenshots_required == 1){
                        echo "Yes";}else{
                            echo "No";
                        }; ?>
                    </p>
                   
<?php if ($num_completed < $num_tasks && !$task_completed) { ?>
    <button id="performTaskBtn" class="btn btn-primary">Perform Task</button>
        <?php } elseif ($task_completed) { ?>
    <p class="text-danger">You have already completed this task.</p>
<?php } else { ?>
    <p class="text-danger">This task has been completed.</p>
<?php } ?>


<div class="mt-3">
    <!-- Form for uploading screenshots -->
    <form id="uploadScreenshotForm" action="" method="post" enctype="multipart/form-data" style="display: none;">
        <?php if ($screenshots_required == 1) { ?>
            <!-- Form for uploading screenshots -->
            <div id="uploadScreenshotForm" class="col-12 mb-3">
                <label class="form-label">Upload Screenshot(s):</label>
                <input type="file" name="screenshot[]" class="form-control" id="screenshot" multiple required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="confirmationCheckbox" required>
                <label class="form-check-label" for="confirmationCheckbox">
                    I confirm that I have completed the task.
                </label>
            </div>
            <input type="hidden" name="job_id" value="<?php echo $job_id; ?>" class="form-control">
            <div class="col-12 mb-3">
                <button type="submit" class="btn btn-secondary">Upload Screenshot and Submit</button>
            </div>
        <?php } else { ?>
            <input type="hidden" name="job_id" value="<?php echo $job_id; ?>" class="form-control">
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="confirmationCheckbox" required>
                <label class="form-check-label" for="confirmationCheckbox">
                    I confirm that I have completed the task.
                </label>
            </div>
            <div class="col-12 mb-3">
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        <?php } ?>
    </form>
</div>
 
                </div>
            </div>
        </div>
    </div>
</div>

<script>
        // Toggle visibility of upload screenshot and mark completed forms when the perform task button is clicked
        document.getElementById('performTaskBtn').addEventListener('click', function() {
        var uploadScreenshotForm = document.getElementById('uploadScreenshotForm');
        var markCompletedForm = document.getElementById('markCompletedForm');
        
        // Toggle display of forms
        if (uploadScreenshotForm.style.display === 'none') {
            uploadScreenshotForm.style.display = 'block';
            markCompletedForm.style.display = 'block';
        } else {
            uploadScreenshotForm.style.display = 'none';
            markCompletedForm.style.display = 'none';
        }
    });
</script>

<?php include 'includes/footer.php' ?>
