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
$referred_by=$user['referred_by'];
$initials = substr($fullname, 0, 2);

$is_vendor=$user['is_vendor'];
$is_publisher=$user['is_publisher'];
$cashback_status=$user['cashback_status'];

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
</style>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <h4>Affiliate</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">

    <div class="col-xl-12 col-sm-6">
                    <div class="card height-equal" style="height:130px;">
                      <div class="card-body bg-primary" 
                          style="display:flex;flex-direction:column;align-items:center;justify-content:center;border-radius:5px;"> 
                        
                                <span class="f-w-500 f-16 mb-3 text-center" >Total  Affiliate Earnings</span>
                              <h1 class="text-center text-white" style="font-size:30px;">
                              <?php 
                      // Prepare the query to fetch today's records
                      $query = "SELECT * FROM `earning_history` WHERE `user_id`='$uid' ";

                      $result=mysqli_query($con,$query);
                    
                      $sum = 0;
                      while($row=mysqli_fetch_array($result)){
                            
                      $amount = $row['amount'];
                      $sum += (int)$amount;
                      }
                    ?>    
                      &#8358;<?php echo number_format($sum) ?>
                            </h1>
                       
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-xl-6 col-sm-6 mb-3" 
                        style="display:flex;flex-direction:column;align-items:center;justify-content:center;border-radius:5px;"> 
                        <h2>Upline: <?php echo $referred_by; ?></h2>
                  </div>


                  <!-- Container-fluid starts-->
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Referrals</h4>
                  </div>
                  <div class="table-responsive custom-scrollbar">
                    <?php
                      $query="SELECT * FROM `users` WHERE `referred_by`='$username' ";
                      $result=mysqli_query($con,$query);
                      $cnt=1;
                      if(mysqli_num_rows($result)>0){
                    ?>
                    <table class="table">
                      <thead>
                        <tr class="border-bottom-primary">
                          <th scope="col">SN</th>
                          <th scope="col">Username</th>
                          <th scope="col">Earning</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                while($row=mysqli_fetch_array($result)){
                $uplan = $row['plan_id'];

                $date_string=$row['created_at'];// date retrieved from database
                $timestamp = strtotime($date_string); // convert date string to Unix timestamp
                $date = date("l,jS \of F Y ", $timestamp);// format timestamp into words
                ?>
                    <tr class="border-bottom-primary">
                        <th scope="row"><?php echo $cnt++;?></th>
                        <th><?php echo htmlentities($row['username']);?></th>
                        <th>&#8358;1,700</th>
                        
                    </tr>
                        <?php } 
                    }else{

                      echo"
                      <div class='nk-block-des' style='text-align:center;margin-top:20px;margin-bottom:50px;'>
                      <h4>Oops!</h4>
                      <p>You don't have any referral.<br>Please refer and earn referral bonuses</p>
                  </div>
                     
                      ";
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
</div>



<?php include 'includes/footer.php'; ?>
