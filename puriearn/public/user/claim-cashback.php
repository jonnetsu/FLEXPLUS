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
$youtube=$user['youtube'];
$tiktok=$user['tiktok'];
$twitter=$user['twitter'];
$telegram=$user['telegram'];

$initials = substr($fullname, 0, 2);

$is_vendor=$user['is_vendor'];
$is_publisher=$user['is_publisher'];
$cashback_status=$user['cashback_status'];

if ($cashback_status == '1') {
    echo "<script>window.location.href='index.php';</script>";
}

// Get the tasks completed by the user
$completed_tasks = [];
$task_query = "SELECT task_id FROM claim_task WHERE user_id='$uid'";
$task_res = mysqli_query($con, $task_query);
while ($task_row = mysqli_fetch_assoc($task_res)) {
    $completed_tasks[] = $task_row['task_id'];
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
.step {
    margin-bottom: 50px;
}
.task-link {
    color: #000000;
}
.img-fluid {
    border-radius: 5px;
}
.progress {
    width: 100%;
    margin-bottom: 20px;
}
.progress-bar {
    text-align: center;
    line-height: 30px;
    color: white;
}
</style>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <h4>Claim Cashback</h4>
                    <p style="padding-top:5px;">Complete these tasks below to claim your cashback</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="progress" style="height: 30px;">
            <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: <?php echo (count($completed_tasks) / 4) * 100; ?>%;" aria-valuenow="<?php echo (count($completed_tasks) / 4) * 100; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo (count($completed_tasks) / 4) * 100; ?>%</div>
        </div>
        <div id="cashback-steps">
            <?php if (!in_array(1, $completed_tasks)) : ?>
            <div class="step col-xl-4 col-sm-6" id="step-1">
                <p><strong>Step 1:</strong> Subscribe to our Youtube channel</p>
                <a href="https://youtube.com/@puriearnofficial" target="_blank" class="task-link">
                    <img src="images/youtube-follow.jpg" class="img-fluid mb-3">
                    Click on the image or this link to subscribe to our Youtube channel.
                </a>
                <button onclick="markAsDone(1)" class="btn btn-primary mt-5 w-100"><i class="fa fa-check"></i> Mark as Done</button>
            </div>
            <?php endif; ?>
            <?php if (!in_array(2, $completed_tasks)) : ?>
            <div class="step col-xl-4 col-sm-6" id="step-2" <?php echo in_array(1, $completed_tasks) ? '' : 'style="display:none;"'; ?>>
                <p><strong>Step 2:</strong> Subscribe to our Telegram Channel</p>
                <a href="https://t.me/puriearn_hq" target="_blank" class="task-link">
                    <img src="images/telegram-follow.jpg" class="img-fluid mb-3">
                    Click on the image or this link to subscribe to our Telegram Channel.
                </a>
                <button onclick="markAsDone(2)" class="btn btn-primary mt-5 w-100"><i class="fa fa-check"></i> Mark as Done</button>
                <button onclick="goBack(2)" class="btn btn-secondary mt-3 w-100"><i class="fa fa-arrow-left"></i> Previous</button>
            </div>
            <?php endif; ?>
            <?php if (!in_array(3, $completed_tasks)) : ?>
            <div class="step col-xl-4 col-sm-6" id="step-3" <?php echo in_array(2, $completed_tasks) ? '' : 'style="display:none;"'; ?>>
                <p><strong>Step 3:</strong> Follow us on Tiktok</p>
                <a href="https://www.tiktok.com/@puriearn.official" target="_blank" class="task-link">
                    <img src="images/tiktok-follow.jpg" class="img-fluid mb-3">
                    Click on the image or this link to Follow us on Tiktok.
                </a>
                <button onclick="markAsDone(3)" class="btn btn-primary mt-5 w-100"><i class="fa fa-check"></i> Mark as Done</button>
                <button onclick="goBack(3)" class="btn btn-secondary mt-3 w-100"><i class="fa fa-arrow-left"></i> Previous</button>
            </div>
            <?php endif; ?>
            <?php if (!in_array(4, $completed_tasks)) : ?>
            <div class="step col-xl-4 col-sm-6" id="step-4" <?php echo in_array(3, $completed_tasks) ? '' : 'style="display:none;"'; ?>>
                <p><strong>Step 4:</strong> Follow us on X</p>
                <a href="https://x.com/puriearn_hq" target="_blank" class="task-link">
                    <img src="images/x-follow.jpg" class="img-fluid mb-3">
                    Click on the image or this link to Follow us on X.
                </a>
                <button onclick="markAsDone(4)" class="btn btn-primary mt-5 w-100"><i class="fa fa-check"></i> Mark as Done</button>
                <button onclick="goBack(4)" class="btn btn-secondary mt-3 w-100"><i class="fa fa-arrow-left"></i> Previous</button>
            </div>
            <?php endif; ?>
        </div>
        <div id="completion-message" style="display:<?php echo count($completed_tasks) == 4 ? 'block' : 'none'; ?>;">
            <p>Thank you for following us! Kindly wait for review.</p>
        </div>
    </div>
</div>

<script>
function markAsDone(step) {
    if (step === 4) {
        if (!confirm("Are you sure you have completed the task?")) {
            return;
        }
    }

    // AJAX call to complete the task
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "complete_task.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
            if (xhr.responseText.includes("successfully")) {
                // Hide the current step
                document.getElementById('step-' + step).style.display = 'none';

                // Update progress bar
                var progress = (step / 4) * 100;
                document.getElementById('progress-bar').style.width = progress + '%';
                document.getElementById('progress-bar').setAttribute('aria-valuenow', progress);
                document.getElementById('progress-bar').innerText = progress + '%';

                // Show the next step or completion message
                if (step < 4) {
                    document.getElementById('step-' + (step + 1)).style.display = 'block';
                } else {
                    document.getElementById('completion-message').style.display = 'block';
                    // Optionally, update points
                    var pointsXhr = new XMLHttpRequest();
                    pointsXhr.open("POST", "update_points.php", true);
                    pointsXhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    pointsXhr.onreadystatechange = function() {
                        if (pointsXhr.readyState === 4 && pointsXhr.status === 200) {
                            console.log(pointsXhr.responseText);
                        }
                    };
                    pointsXhr.send("uid=<?php echo $uid; ?>&points=10");
                }
            } else {
                alert("You have already completed this task.");
            }
        }
    };
    xhr.send("task_id=" + step);
}

function goBack(step) {
    // Hide the current step
    document.getElementById('step-' + step).style.display = 'none';

    // Show the previous step
    document.getElementById('step-' + (step - 1)).style.display = 'block';

    // Update progress bar
    var progress = ((step - 1) / 4) * 100;
    document.getElementById('progress-bar').style.width = progress + '%';
    document.getElementById('progress-bar').setAttribute('aria-valuenow', progress);
    document.getElementById('progress-bar').innerText = progress + '%';
    }

    // Close the modal when clicking outside of it
    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>

<?php include 'includes/footer.php'; ?>
