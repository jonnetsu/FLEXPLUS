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

$uid = $_SESSION['id'];
$username = $_SESSION['username'];
$sql = "SELECT * FROM `users` WHERE `id` = $uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$uplan = $row['plan_id'];
$bank = $row['bank_name'];

$tiktok_balance = $row['tiktok_balance'];
$referral_balance = $row['ref_bonus'];
$indirect_referral_balance = number_format($row['indirect_ref_bonus']);
$cashback_balance = $row['cashback'];
$job_balance = $row['job_balance'];
$withdrawal_pin = $row['withdrawal_pin'];

?>

<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12">
          <h4>Tiktok Earning Dashboard</h4>
        </div>
      </div>
    </div>
  </div>

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="col-xl-12 col-sm-6">
      <div class="card height-equal" style="height:150px;">
        <div class="card-body" style="background:url('images/tiktok-bg.jpg');background-size:cover;background-position:center;border-radius:5px;" 
          style="display:flex;flex-direction:column;align-items:center;justify-content:center;border-radius:5px;"> 
          <span class="f-w-500 f-16 mb-3 text-center text-white">Tiktok Earnings</span>
          <h1 class=" text-white" style="font-size:30px;">&#8358;<?php echo number_format($tiktok_balance); ?></h1>
        </div>
      </div>
    </div>


    <?php if(isset($_SESSION['msg'])) { ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?>">
        <h6 class="alert-heading fw-bold mb-1"><?php echo $_SESSION['type']; ?></h6>
        <p class="mb-0"><?php echo $_SESSION['msg']; ?></p>
        </div>
        <?php unset($_SESSION['msg']); unset($_SESSION['type']); ?>
    <?php } ?>

  <div class="border-0 container-fluid py-3">
    <div class="card-body pt-0">
      <h1 class="mb-1">Earn With Puriearn</h1>
      <p>Create TikTok Videos with your smartphone.</p>
      <?php
      // Check if the user has any drafts
      $draftCheckQuery = "SELECT COUNT(*) as draft_count FROM tiktok_user_drafts WHERE user_id = $uid AND status = 'draft'";
      $draftCheckResult = mysqli_query($con, $draftCheckQuery);
      $draftCheckRow = mysqli_fetch_assoc($draftCheckResult);

      if($draftCheckRow['draft_count'] == 0) {
          echo '<button class="btn btn-primary" onclick="document.getElementById(\'taskList\').style.display=\'block\';">Create <i class="fa fa-plus"></i></button>';
      }
      ?>
    </div>

    </div>
  <!-- Task List -->
  <div id="taskList" style="display:none;">
    <?php
    // Fetch tasks from the database
    $taskQuery = "SELECT * FROM tiktok_tasks 
                  WHERE id NOT IN (SELECT task_id FROM tiktok_user_drafts WHERE user_id = $uid AND (status = 'submitted' OR status = 'approved'))";
    $taskResult = mysqli_query($con, $taskQuery);

    if(mysqli_num_rows($taskResult) > 0) {
      echo '<div class="container-fluid py-3">';
      echo '<h2 class="mb-3" style="margin-left:10px;">Available Tasks</h2>';
      echo '<div class="row">';
      while($taskRow = mysqli_fetch_assoc($taskResult)) {
        echo '<div class="col-md-4">';
        echo '<div class="card mb-4">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $taskRow['title'] . '</h5>';
        echo '<p class="card-text">' . $taskRow['instructions'] . '</p>';
        echo '<p class="card-text"><strong>Video Type:</strong> ' . $taskRow['video_type'] . '</p>';
        echo '<p class="card-text"><strong>Tag Us:</strong> ' . $taskRow['tag'] . '</p>';
        echo '<form method="POST" action="create_draft.php">';
        echo '<input type="hidden" name="task_id" value="' . $taskRow['id'] . '">';
        echo '<button type="submit" class="btn btn-primary">I want to create</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
      echo '</div>';
      echo '</div>';
    } else {
      echo '<p>No tasks available at the moment. Please check back later.</p>';
    }
    ?>
  </div>

  <!-- User Drafts -->
  <div class="mt-3">
   
    <?php
    // Fetch user drafts
    $draftQuery = "SELECT tiktok_user_drafts.id as draft_id, tiktok_tasks.title, tiktok_tasks.instructions, tiktok_tasks.video_type, tiktok_tasks.tag, tiktok_user_drafts.admin_approval 
                   FROM tiktok_user_drafts 
                   JOIN tiktok_tasks ON tiktok_user_drafts.task_id = tiktok_tasks.id 
                   WHERE tiktok_user_drafts.user_id = $uid AND tiktok_user_drafts.status = 'draft'";
    $draftResult = mysqli_query($con, $draftQuery);

    if(mysqli_num_rows($draftResult) > 0) {
        echo '<h2 class="mb-3" style="text-align:left;margin-left:10px;">Your Draft</h2>';
      echo '<div class="row">';
      while($draftRow = mysqli_fetch_assoc($draftResult)) {
        echo '<div class="col-md-4">';
        echo '<div class="card mb-4">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $draftRow['title'] . '</h5>';
        echo '<p class="card-text">' . $draftRow['instructions'] . '</p>';
        echo '<p class="card-text"><strong>Video Type:</strong> ' . $draftRow['video_type'] . '</p>';
        echo '<p class="card-text"><strong>Tag Us:</strong> ' . $draftRow['tag'] . '</p>';
        echo '<form method="POST" action="submit_video.php">';
        echo '<div class="form-group">';
        echo '<label for="videoLink">Video Link:</label>';
        echo '<input type="url" class="form-control" id="videoLink" name="video_link" required>';
        echo '</div>';
        echo '<input type="hidden" name="draft_id" value="' . $draftRow['draft_id'] . '">';
        echo '<button type="submit" class="btn btn-success mt-3">Submit for Review</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
      echo '</div>';
    } else {
      echo '<p>Your drafts will appear here.</p>';
    }
    ?>
  </div>
      <!-- Container-fluid Ends-->
      </div>
      <!-- Page Body Ends-->
      
      <?php include 'includes/footer.php'; ?>      
