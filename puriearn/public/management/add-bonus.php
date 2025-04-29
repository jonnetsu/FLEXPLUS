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

if (isset($_POST['submit'])) {
    $amount = sanitize_input($_POST['amount']);
    $description = sanitize_input($_POST['description']);

    // Validate and process the form data
    if (empty($description)) {
        $msg = "Notification content cannot be empty";
        $type = "warning";
        // Clear the form data after processing
        $description = '';
    } else {
        $sql = "SELECT `id`, `earnings` FROM `users`";
        $result = mysqli_query($con, $sql);
        $userIds = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $userId = $row['id'];
                $earnings = $row['earnings'];
                $newEarnings = $earnings + $amount;

                // Update user's earnings
                $updateSql = "UPDATE `users` SET `earnings` = '$newEarnings' WHERE `id` = '$userId'";
                $updateResult = mysqli_query($con, $updateSql);

                // Create notification for each user
                if ($updateResult) {
                    $notificationSql = "INSERT INTO `notifications` (receiver_id, action_type, body, is_read, created_at)
                                        VALUES ('$userId', 'Admin', '$description', '0', '$createdAt')";
                    $notificationResult = mysqli_query($con, $notificationSql);

                    if ($notificationResult) {
                        $msg = "Notifications sent and earnings updated successfully";
                        $type = "success";
                    } else {
                        $msg = "Failed to create notifications";
                        $type = "warning";
                    }
                } else {
                    $msg = "Failed to update earnings";
                    $type = "warning";
                }
            }
        } else {
            // Handle the error condition here
            // For example, display an error message or log the error
        }
    }
}


?>

  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">New/</span> Add Bonus</h4>
 
 <div class="card mb-4">
                    <h5 class="card-header">Add Activities Bonus</h5>
                    <!-- Account -->
                    <hr class="my-0" />
                    <div class="card-body">
                    <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
                    <form  method="post" action="" >
                        <div class="row">
                        <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Amount</label>
                        <input type="text" class="form-control" name="amount" 
                         value="<?php if(isset($_POST['amount'])) echo $_POST['amount']; ?>" required />
                      </div>
                      <div class="mb-3 col-md-12">
                        <label class="form-label" for="basic-default-fullname">Description</label>
                        <textarea class="form-control" name="description"> </textarea>
                      </div> 
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2" type="submit" name="submit" >Send</button>
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
