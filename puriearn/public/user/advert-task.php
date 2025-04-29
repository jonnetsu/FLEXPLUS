<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('includes/checklogin.php');
check_login();
$title = "Dashboard";
$uip = $_SERVER['REMOTE_ADDR'];
include 'includes/header.php';
include 'includes/functions.php';

$today = date("Y-m-d");

$uid = $_SESSION['id'];
$sql = "SELECT * FROM `users` WHERE `id`=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$uplan = $row['plan_id'];
$username = $row['username'];
$referral_code = $row['referral_code'];

$activity_balance = number_format($row['earnings']);
$referral_balance = number_format($row['ref_bonus']);
$indirect_referral_balance = number_format($row['indirect_ref_bonus']);
$cashback_balance = number_format($row['cashback']);
$job_balance = $row['job_balance'];

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
.job-container {
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 15px;
}
.job-title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
    color:#06b32a;
}
.job-description {
    margin-bottom: 10px;
}
.job-info {
    display:flex;
    flex-direction:column;
    margin-bottom: 10px;
}
.job-info span{
    margin-bottom:10px;
}
.job-action {
    text-align: right;
}
</style>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <h4>Advert Tasks</h4>
                    <p style="padding-top:5px;">Perform simple tasks and earn</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
    <div class="col-xxl-6 box-col-12"> 
        <?php
        $jobs_sql = "SELECT * FROM job_adverts ORDER BY `id` DESC";
        $jobs_res = mysqli_query($con, $jobs_sql);
        if (mysqli_num_rows($jobs_res) == 0) {
            ?>
              <div class="container-fluid">
                <div class="col-xxl-6 box-col-12"> 
                    <p>No tasks available at the moment.</p>
                </div>
              </div>
            <?php
        } else {
            while($job = mysqli_fetch_assoc($jobs_res)) {
                $job_id = $job['id'];
                $title = htmlspecialchars($job['title']);
                $description = htmlspecialchars($job['description']);
                $amount_per_task = number_format($job['amount_per_task'], 2);
                $remaining_tasks = $job['remaining_tasks'];
                $total_tasks = $job['num_tasks'];
                $num_completed = $job['num_completed']; // Calculate number of completed tasks
                $screenshots_required = $job['screenshots_required'] ? 'Yes' : 'No';
        ?>
        <div class="job-container">
            <div class="job-title"><?php echo $title; ?></div>
           
            <div class="job-info">
                <span><strong>Amount per Task:</strong> <?php echo $amount_per_task; ?> NGN</span>
                <span><strong>Remaining Tasks:</strong> <?php echo $num_completed; ?> / <?php echo $total_tasks; ?></span>
                <span><strong>Screenshots Required:</strong> <?php echo $screenshots_required; ?></span>
            </div>
            <div class="job-action"><a href="task_details.php?job_id=<?php echo $job_id; ?>" class="btn btn-primary">View Task</a></div>
        </div>
        <?php 
            } 
        }
        ?>
    </div>
</div>


</div>

<?php include 'includes/footer.php' ?>
