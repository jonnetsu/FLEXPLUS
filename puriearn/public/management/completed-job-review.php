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

if(isset($_GET['cancel'])){
        $task_id=$_GET['tid'];

        $sql = "UPDATE `user_job_tasks` set `status`='Rejected'
        WHERE `id`='$task_id' ";	
        $res = mysqli_query($con, $sql);
        if($res){
            $msg="Task Rejected Successfully!";
            $type = "success";
        }else{
            $msg="Failed to Cancel Withdrawal";
            $type = "warning";
        }

}

if(isset($_GET['approve'])){
    $task_id=$_GET['tid'];
    $uid=$_GET['uid'];
    $pay=$_GET['pay'];

    $account_table_name ='tiktok_balance';
    
    $sql = "UPDATE `user_job_tasks` set `status`='Confirmed'
    WHERE `id`='$task_id' ";	
    $res = mysqli_query($con, $sql);
    if($res){
        $updateQuery = "UPDATE `users` SET `tiktok_balance`=$account_table_name + $pay WHERE `id`='$uid'";
        $result2 = mysqli_query($con, $updateQuery);
        $msg="Task Approved Successfully!";
        $type = "success";
    }else{
        $msg="Failed to Cancel Withdrawal";
        $type = "warning";
    }

}

?>
        <div class="container-fluid py-4">
                  <div class="card" style="padding:30px;">
                    <h5 class="card-header">Pending Job Review</h5>  
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
            <th>Username</th>
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
        $query = "
            SELECT 
                ujt.id,
                ujt.user_id,
                ujt.job_id,
                ujt.completed,
                ujt.completed_at,
                ujt.status,
                ja.title AS job_title,
                ja.amount_per_task AS pay_amount,
                ja.description AS job_description,
                ja.screenshots_required,
                ja.sample_screenshots,
                ja.banner,
                u.username,
                u.fullname AS user_fullname,
                u.email AS user_email
            FROM 
                user_job_tasks ujt
            JOIN 
                job_adverts ja ON ujt.job_id = ja.id
            JOIN 
                users u ON ujt.user_id = u.id
            WHERE 
                ujt.completed = 1 AND 
                ujt.status = 'Confirmed'
        ";

        $result = mysqli_query($con, $query);
        $cnt = 1;

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $userId = $row['user_id'];
                $jobTitle = $row['job_title'];
                $jobDescription = $row['job_description'];
                $screenshotsRequired = $row['screenshots_required'];
                $sampleScreenshots = $row['sample_screenshots'];
                $banner = $row['banner'];
                $username = $row['username'];
                $userFullname = $row['user_fullname'];
                $userEmail = $row['user_email'];
                $completedAt = $row['completed_at'];
                $status = $row['status'];
                $payAmount = $row['pay_amount'];
                ?>
                <tr>
                    <td><?php echo $cnt++; ?></td>
                    <td><?php echo $username; ?></td>
                    <td><?php echo $jobTitle; ?></td>
                    <td>
                        <?php 
                        if ($status == 'Pending') { ?>
                            <button class="btn btn-warning"><?php echo $status; ?></button>
                        <?php } elseif ($status == 'Rejected') { ?>
                            <button class="btn btn-danger"><?php echo $status; ?></button>
                        <?php } else { ?>
                            <button class="btn btn-success"><?php echo $status; ?></button>
                        <?php } ?>
                    </td>
                    <td><img src="../admin/adverts/<?php echo $banner;?>" style="width:100px;"></td>
                    <td><img src="../admin/screenshots/<?php echo $sampleScreenshots;?>" style="width:100px;"></td>
                    <td><?php echo htmlentities($completedAt); ?></td>
                    <td class="align-middle">
                        <a href="user-details.php?uid=<?php echo $row['user_id']; ?>" class="btn btn-warning me-1 add-to-cart-button">User Details</a>
                        <a href="?approve=true&&tid=<?php echo $row['id']; ?>&&uid=<?php echo $row['user_id']; ?>&&pay=<?php echo $payAmount;?>" onClick="return confirm('Are you sure you want to Approve this task?')" class="btn btn-success me-1 add-to-cart-button">Approve</a> 
                        <a href="?cancel=true&&tid=<?php echo $row['id']; ?>&&uid=<?php echo $row['user_id']; ?>" onClick="return confirm('Are you sure you want to reject this task?')" class="btn btn-danger me-1 add-to-cart-button">Reject</a>
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