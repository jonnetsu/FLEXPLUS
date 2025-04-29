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

$activity_balance=$row['earnings'];
$referral_balance=$row['ref_bonus'];
$lastSpin=$row['lastSpin'];

?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <h4>Withdrawal History</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
                  <!-- Container-fluid starts-->
                  <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Recent Withdrawals</h4>
                  </div>
                  <div class="table-responsive custom-scrollbar">
                    <?php
                    $query="SELECT * FROM `transactions` WHERE `user_id`='$uid' AND `type`='Withdrawal' ORDER BY `id` DESC LIMIT 20";
                      $result=mysqli_query($con,$query);
                      $cnt=1;
                      if(mysqli_num_rows($result)>0){
                    ?>
                    <table class="table">
                      <thead>
                        <tr class="border-bottom-primary">
                          <th scope="col">SN</th>
                          <th scope="col">Amount</th>
                          <th scope="col">Status</th>
                          <th scope="col">Date</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                while($row=mysqli_fetch_array($result)){
                $amount=number_format($row['amount']);
                $status=$row['status'];
                $date_string=$row['created_at'];// date retrieved from database
                $timestamp = strtotime($date_string); // convert date string to Unix timestamp
                $date = date(" l, jS \of F Y", $timestamp);// format timestamp into words                
                ?>
                    <tr class="border-bottom-primary">
                        <th scope="row"><?php echo $cnt++;?></th>
                        <th>&#8358;<?php echo $amount;?></th>
                        <th>
                             <?php
                        if ($status == "Confirmed") {
                        ?>
                        <div class="nk-block-actions flex-shrink-0">
                            <a href="#" class="btn  btn-success">Paid Out</a>
                        </div>
                        <?php
                        } elseif ($status == "Cancelled") {
                        ?>
                        <div class="nk-block-actions flex-shrink-0">
                            <a href="#" class="btn  btn-danger">Cancelled</a>
                        </div>
                        <?php
                        } else {
                        ?>
                        <div class="nk-block-actions flex-shrink-0">
                            <a href="#" class="btn  btn-warning">Pending</a>
                        </div>
                        <?php
                        }
                        ?>
                        </th>
                        <th><?php echo htmlentities($date);?></th>

                    </tr>
                        <?php } 
                    }else{

                      echo"
                      <div class='nk-block-des' style='text-align:center;margin-top:20px;margin-bottom:50px;'>
                      <h4>Oops!</h4>
                      <p>You don't have any withdrawal history</p>
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



<?php include 'includes/footer.php' ?>
