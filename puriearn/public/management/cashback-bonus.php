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

if(isset($_GET['reward']))
		  {
        $uid=$_GET['uid'];
        $tid=$_GET['tid'];
     
      
        $sql = "UPDATE `claim_task` set `status`='1'  WHERE `id`='$tid' ";	
        $res = mysqli_query($con, $sql);
           if($res){
            $updateQuery = "UPDATE `users` SET `cashback`= cashback+2000 WHERE `id`='$uid'";
            $result2 = mysqli_query($con, $updateQuery);

            $bonus_message = "You just received a Cashback bonus of ₦2000";


            $notificationsql = "INSERT INTO `notifications` (`receiver_id`, `action_type`, `body`) 
                                            VALUES ('$ruserid', 'Cashback', '$bonus_message')";
            $result2 = mysqli_query($con, $notificationsql);

            $msg="User Rewarded Successfully!";
            $type = "success";
           }else{
               $msg="Failed to Reward User";
               $type = "warning";
           }


		  }


?>
        <div class="container-fluid py-4">
                  <div class="card" style="padding:30px;">
                    <h5 class="card-header">Pending Cash Back Rewards</h5>  
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
                        <th>User Details</th>
                        <th>Action</th>
                      </tr>
                    </thead>    
                  <tbody>
                  <?php 
                  $query="SELECT * FROM `claim_task` WHERE `task_id`='4' AND `status`='0' ";
                  $result=mysqli_query($con,$query);
                  $cnt=1;
                  if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
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
                   
                      <td><a href="user-details.php?uid=<?php echo $userId;?>" class="btn btn-primary" >User</a> 
</td>
                      <td class="align-middle">
                      <a href="?reward=true&&uid=<?php echo $userId;?>&&tid=<?php echo $row['id'];?>" 
                      onClick="return confirm('Are you sure you want to reward this user?')" class="btn btn-warning">Reward User</a> 

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
