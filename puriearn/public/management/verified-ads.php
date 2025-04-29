<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
$title="Pending Services";
$currentTime = date( 'd-m-Y h:i:s A', time ());

ini_set('display_errors', 1);
error_reporting(E_ALL);

if(isset($_GET['cancel'])){
        $task_id=$_GET['tid'];

        $sql = "UPDATE `job_adverts` SET `approved`='0' WHERE `id`='$task_id' ";	
        $res = mysqli_query($con, $sql);
        if($res){
            $msg="Advert Approved Successfully!";
            $type = "success";
        }else{
            $msg="Failed to Approve Advert";
            $type = "warning";
        }
}

if(isset($_GET['approve'])){
    $task_id=$_GET['tid'];
    
    $sql = "UPDATE `job_adverts` SET `approved`='1' WHERE `id`='$task_id' ";	
    $res = mysqli_query($con, $sql);
    if($res){
        $msg="Advert Approved Successfully!";
        $type = "success";
    }else{
        $msg="Failed to Approve Advert";
        $type = "warning";
    }

}

if(isset($_GET['pay'])){
    $job_id = $_GET['tid'];
    $amount = $_GET['amount'];
    
    // Select all completed tasks that need approval
    $sqlPay = "SELECT `id`,`user_id` FROM `user_job_tasks` WHERE `status`='Pending' AND `completed`='1' AND `job_id`='$job_id' ";
    $result = mysqli_query($con, $sqlPay);
    
    if($result){
        $paidUsersCount = 0;  // Counter to keep track of paid users
        while($row = mysqli_fetch_assoc($result)){
            $user_id = $row['user_id'];
            $task_id = $row['id'];
            
            // Update user balance
            $updateQuery = "UPDATE `users` SET `job_balance` = `job_balance` + $amount WHERE `id`='$user_id'";
            $result2 = mysqli_query($con, $updateQuery);
            
            if($result2){
                // Mark task as confirmed
                $sql = "UPDATE `user_job_tasks` SET `status`='Confirmed' WHERE `id`='$task_id'";	
                $res = mysqli_query($con, $sql);
                
                if($res){
                    $paidUsersCount++;  // Increment the counter
                } else {
                    $msg = "Failed to confirm task for User ID $user_id.";
                    $type = "warning";
                    break;  // Exit the loop if any task confirmation fails
                }
            } else {
                $msg = "Failed to update balance for User ID $user_id.";
                $type = "warning";
                break;  // Exit the loop if any balance update fails
            }
        }
        
        // Final message after processing all users
        if ($paidUsersCount > 0) {
            $msg = "Task Approved Successfully and $paidUsersCount user(s) paid.";
            $type = "success";
        } else {
            $msg = "No users were paid.";
            $type = "warning";
        }
    } else {
        $msg = "Failed to retrieve tasks.";
        $type = "error";
    }

}

?>
        <div class="container-fluid py-4">
                  <div class="card" style="padding:30px;">
                    <h5 class="card-header">Verified Ads</h5>  
                 <div>
                 <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
         
                <div class="table-responsive table-wrapper-top text-nowrap" >
                <table class="table table-bordered" id="dataTables-example">
    <thead>
        <tr class="text-nowrap">
            <th>SN</th>
            <th>Job Title</th>
            <th>Status</th>
            <th>Banner</th>
            <th>Sample</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>    
    <tbody>
        <?php                  
        $query = " SELECT * FROM `job_adverts` WHERE `approved`= '1'
        ";

        $result = mysqli_query($con, $query);
        $cnt = 1;

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $jobTitle = $row['title'];
                $jobDescription = $row['description'];
                $screenshotsRequired = $row['screenshots_required'];
                $sampleScreenshots = $row['sample_screenshots'];
                $banner = $row['banner'];
                $approved = $row['approved'];
                $completed = $row['completed'];
                $payAmount = $row['amount_per_task'];

                        $date_string=$row['created_at'];// date retrieved from database
                        $timestamp = strtotime($date_string); // convert date string to Unix timestamp
                        $date = date("jS F, Y", $timestamp);// format timestamp into words

                ?>
                <tr>
                    <td><?php echo $cnt++; ?></td>
                    <td><?php echo $jobTitle; ?></td>
                    <td>
                        <?php 
                        if ($approved == '0') { ?>
                            <button class="btn btn-warning">Pending</button>
                        <?php } else { ?>
                            <button class="btn btn-success">Approved</button>
                        <?php } ?>
                    </td>
                    <td><img src="../admin/adverts/<?php echo $banner;?>" style="width:100px;"></td>
                    <td><img src="../admin/screenshots/<?php echo $sampleScreenshots;?>" style="width:100px;"></td>
                    <td><?php echo $date; ?></td>

                    <td class="align-middle">
                        <a href="user-details.php?uid=<?php echo $row['user_id']; ?>" class="btn btn-warning me-1 add-to-cart-button">User Details</a>
                        <a href="?approve=true&&tid=<?php echo $row['id']; ?>" onClick="return confirm('Are you sure you want to Approve this task?')" class="btn btn-success me-1 add-to-cart-button">Approve</a> 
                        <a href="?pay=true&&tid=<?php echo $row['id']; ?>&&amount=<?php echo $payAmount; ?>" onClick="return confirm('Are you sure you want to Pay all Pending Users?')" class="btn btn-success me-1 add-to-cart-button">Pay Users</a> 
                        <a href="?cancel=true&&tid=<?php echo $row['id']; ?>" onClick="return confirm('Are you sure you want to reject this task?')" class="btn btn-danger me-1 add-to-cart-button">Reject</a>
                    </td>
                </tr>
                <?php } 
                    }else{

                      echo"No Record Found!";
                    }

                    ?>
    </tbody>
</table>

              </div>
            </div>
          </div>
        </div>
      </div>


                </div>
                </div>



<?php include('include/footer.php');?>