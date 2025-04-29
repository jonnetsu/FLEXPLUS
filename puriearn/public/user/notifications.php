<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('includes/checklogin.php');
include 'includes/functions.php';

check_login();
$title="Dashboard";
include 'includes/header.php'; 
$today = date("Y-m-d");

$uid= $_SESSION['id'];
$username=$_SESSION['username'];
$sql = "SELECT * FROM `users` WHERE `id`=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$uplan=$row['plan_id'];
$bank=$row['bank_name'];


$sql = "UPDATE `notifications` set `is_read`='1'
WHERE `receiver_id`='$userid' ";	
   $res = mysqli_query($con, $sql);
?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <h4>Notifications</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
                  <!-- Container-fluid starts-->
                  <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  </div>
                  <?php 
                    $query="SELECT * FROM `notifications` WHERE `receiver_id`='$userid' ORDER BY `notification_id` DESC LIMIT 20";
                    $result=mysqli_query($con,$query);
                    $cnt=1;
                    if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                        $type=$row['action_type'];
							
                        $date_string=$row['created_at'];// date retrieved from database
                        $timestamp = strtotime($date_string); // convert date string to Unix timestamp
                        $date = date(" l, jS \of F Y", $timestamp);// format timestamp into words                
             ?>

                    <div class="card  col-lg-12 mb-3">
                         <div class="card-body">
                             <div class="user-message row"> 
                                   
                                    <div class="user-name">                                      
                                                <span class="f-light f-w-500 f-12"><?php echo htmlentities($row['body']);?></span>
                                    </div>
                                    <span class="nk-iv-scheme-value date"><?php echo htmlentities($date);?></span>
                               </div> 
                         </div>
                    </div>

		
                                    <?php } 
                    }else{

                      echo"
                      <div class='nk-block-des' style='text-align:center;margin-top:20vh;'>
                      <h4>Oops!</h4>
                      <p>You don't have any login history</p>
                  </div>
                     
                      ";
                    }
                    ?>
                </div>
              </div>
            </div>
          </div>
        </div>

								
               
</div>



<?php include 'includes/footer.php' ?>
