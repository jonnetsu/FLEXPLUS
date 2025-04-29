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
    $description = sanitize_input($_POST['description']);

    // Validate and process the form data
    if (empty($description)) {
        $msg = "Notification content cannot be empty";
        $type = "warning";
        // Clear the form data after processing
        $description = '';
    } else {
        $sql = "SELECT `id` FROM `users`";
        $result = mysqli_query($con, $sql);
        $userIds = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $userIds[] = $row['id'];
            }

            // Create notification for each user
           
           
            foreach ($userIds as $userId) {
                $sql = "INSERT INTO `notifications` (receiver_id, action_type, body, is_read)
                        VALUES ('$userId', 'Admin', '$description', '0')";
    
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $msg = "Notification sent successfully";
                    $type = "success";
                } else {
                    $msg = "Something went wrong, please try again";
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
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">New/</span> Add Notification</h4>
 
 <div class="card mb-4">
                    <h5 class="card-header">Send Notification</h5>
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
