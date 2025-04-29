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

        $sql = "UPDATE `tiktok_user_drafts` set `admin_approval`='Rejected'
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

    $sql = "UPDATE `tiktok_user_drafts` set `admin_approval`='Approved'
    WHERE `id`='$task_id' ";	
    $res = mysqli_query($con, $sql);
    if($res){
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
                    <h5 class="card-header">Pending Tiktok Tasks Review</h5>  
                 <div>
                 <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
         
                <div class="table-responsive table-wrapper-top text-nowrap" >
                  <table class="table table-bordered" id="dataTables-example" >
                    <thead>
                      <tr class="text-nowrap">
                        <th>SN</th>
                        <th>Username</th>
                        <th>Video Link</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>    
                  <tbody>
                  <?php 
                  $query="SELECT * FROM `tiktok_user_drafts` WHERE `admin_approval` = 'Pending'  AND `status`= 'submitted' ";
                  $result=mysqli_query($con,$query);
                  $cnt=1;
                  if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                        $url=$row['video_link'];
                        $userId=$row['user_id'];
                      ?>
                    <tr>
                      <td><?php echo $cnt++;?></td>
                      <td>
                      <?php $query2=mysqli_query($con,"SELECT * FROM users WHERE id='$userId' ");
                        while($r=mysqli_fetch_array($query2))
                        {?>
                           <?php echo $r['username']; ?>
                        <?php } ?>
                     </td>
                      <td><a href="<?php echo $url;?>">Watch Video</a></td>
                      <td>
                      <?php 
                        if($row['admin_approval']== 'Pending'){ ?>
                            <button class="btn btn-warning"><?php echo $row['admin_approval'];?></button>
                        <?php }elseif($row['admin_approval']== 'Rejected'){ ?>
                            <button class="btn btn-danger"><?php echo $row['admin_approval'];?></button>
                        <?php }else{ ?>
                            <button class="btn btn-success"><?php echo $row['admin_approval'];?></button>
                        <?php } ?>
                        </td>
                      <td><?php echo htmlentities($row['created_at']);?>  </td>
                      <td class="align-middle">
                      <a href="edit-tiktok-task.php?id=<?php echo $row['id'];?>" class="btn btn-primary me-1 add-to-cart-button" >Task Details</a> 
                      <a href="user-details.php?uid=<?php echo $row['user_id'];?>" class="btn btn-warning me-1 add-to-cart-button" >User Details</a> 
                      <?php $query2=mysqli_query($con,"SELECT * FROM users WHERE id='$userId' ");
                        while($r=mysqli_fetch_array($query2))
                        {?>
                      <a href="tiktok-reward?uid=<?php echo $userId?>&username=<?php echo $r['username']; ?>" 
                                class="btn btn-primary" style="background:blue;">
                               Reward
                            </a>
                        <?php } ?>
                      <a href="?approve=true&&tid=<?php echo $row['id'];?>" 
                      onClick="return confirm('Are you sure you want to Approve this task?')" class="btn btn-success me-1 add-to-cart-button" >Approve</a> 
                      <a href="?cancel=true&&tid=<?php echo $row['id'];?>" 
                      onClick="return confirm('Are you sure you want to reject this task?')" class="btn btn-danger me-1 add-to-cart-button" >Reject</a> 

                    </td>
                      
                    </tr>
                    
                    <?php } 
                    }else{

                      echo"No Record Found!";
                    }
                    ?>
                               
                  </tbody>
                </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>


                </div>
                </div>



<?php include('include/footer.php');?>