<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('includes/checklogin.php');
include 'includes/functions.php';

check_login();
$title = "Dashboard";
include 'includes/header.php'; 
$today = date("Y-m-d");

$uid= $_SESSION['id'];
$sql = "SELECT * FROM `users` WHERE `id`='$uid' ";
$res = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($res);
$fullname=$user['fullname'];
$username=$user['username'];
$profile_pic=$user['user_picture'];

$initials = substr($fullname, 0, 2);

$is_vendor=$user['is_vendor'];
$is_publisher=$user['is_publisher'];
$cashback_status=$user['cashback_status'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $draft_id = $_POST['draft_id'];
    $video_link = mysqli_real_escape_string($con, $_POST['video_link']); // Make sure to escape the input
  
    // Update draft to submitted
    $updateQuery = "UPDATE tiktok_user_drafts SET video_link = '$video_link', status = 'submitted' WHERE id = $draft_id";
    if (mysqli_query($con, $updateQuery)) {
      $msg = "Video submitted successfully!";
      $type = "success";
    
    } else {
      $msg = "Failed to submit video!";
      $type = "danger";
    }
  }

  

?>

<style>
.mb-3 {
    margin-bottom: 10px !important;
}
.mt-3 {
    margin-top: 10px !important;
}
.mt-5 {
    margin-top: 30px !important;
}
</style>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <h4>Tiktok Pay</h4>
                    <p style="padding-top:5px;"></p>
                </div>
            </div>
        </div>
    </div>

           <div class="container-fluid">
						
                        <div class="col-sm-12">
                          <?php if(isset($msg)){ ?>
                                <div class="alert alert-<?php echo $type?>">
                                <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                                <p class="mb-0"><?php echo $msg?></p>
                                </div>
                            <?php }?>


                   <p>We will review your video and get back to you.</p>         
        </div>

        <!-- Submitted Videos -->
  <div class="card container-fluid py-3" >
    <h2 class="mb-2">Submitted Videos</h2>
    <?php
    // Fetch submitted videos
    $submittedQuery = "SELECT tiktok_user_drafts.id as draft_id, tiktok_tasks.title, tiktok_tasks.instructions, tiktok_tasks.video_type, tiktok_tasks.tag, tiktok_user_drafts.video_link, tiktok_user_drafts.admin_approval 
                       FROM tiktok_user_drafts 
                       JOIN tiktok_tasks ON tiktok_user_drafts.task_id = tiktok_tasks.id 
                       WHERE tiktok_user_drafts.user_id = $uid AND tiktok_user_drafts.status = 'submitted'";
    $submittedResult = mysqli_query($con, $submittedQuery);

    if(mysqli_num_rows($submittedResult) > 0) {
      echo '<div class="row">';
      while($submittedRow = mysqli_fetch_assoc($submittedResult)) {
        echo '<div class="col-md-4">';
        echo '<div class="card mb-4">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $submittedRow['title'] . '</h5>';
        echo '<p class="card-text">' . $submittedRow['instructions'] . '</p>';
        echo '<p class="card-text"><strong>Video Type:</strong> ' . $submittedRow['video_type'] . '</p>';
        echo '<p class="card-text"><strong>Tag Us:</strong> ' . $submittedRow['tag'] . '</p>';
        echo '<p class="card-text"><strong>Video Link:</strong> <a href="' . $submittedRow['video_link'] . '" target="_blank">' . $submittedRow['video_link'] . '</a></p>';
         echo '<p class="card-text"><strong>Admin Approval Status:</strong>'; 
         ?>
        <?php 
        if ($submittedRow['admin_approval'] == 'Approved') {
          echo '<span class="badge bg-success">Approved</span>';
        } elseif ($submittedRow['admin_approval'] == 'Pending') {
          echo '<span class="badge bg-warning">Pending</span>';
        } else {
          echo '<span class="badge bg-danger">Rejected</span>';
        }
        ?>
      </p>
      </div>
      </div>
      </div>
      <?php
      }
      echo '</div>';
      } else {
      echo '<p>No submitted videos found.</p>';
      }
      ?>
      </div>
      </div>
  

    </div>
</div>

<?php include 'includes/footer.php'; ?>
