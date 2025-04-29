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

?>
        <div class="container-fluid py-4">
                  <div class="card" style="padding:30px;">
                    <h5 class="card-header">Pending Ads</h5>  
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
        $query = " SELECT * FROM `job_adverts` WHERE `approved`= '0'
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
                $completedAt = $row['completed_at'];
                $approved = $row['approved'];
                $completed = $row['completed'];
                $payAmount = $row['amount_per_task'];
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
                    <td><?php echo htmlentities($completedAt); ?></td>
                    <td class="align-middle">
                        <a href="user-details.php?uid=<?php echo $row['user_id']; ?>" class="btn btn-warning me-1 add-to-cart-button">User Details</a>
                        <a href="?approve=true&&tid=<?php echo $row['id']; ?>" onClick="return confirm('Are you sure you want to Approve this task?')" class="btn btn-success me-1 add-to-cart-button">Approve</a> 
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