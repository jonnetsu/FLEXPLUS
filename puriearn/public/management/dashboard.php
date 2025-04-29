<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
$title="Dashboard";

$aid=$_SESSION['id'];


$sql = "SELECT * FROM `admin` WHERE `id`= '$aid' ";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$value=$row['level'];


?>
<?php include('include/header.php');?>		
<?php include('include/sidebar.php');?>
			
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Users 
                      <span style="color:#fff;">Activities </span></p>
                    <h5 class="font-weight-bolder mb-0 mt-2" style="font-weight:700">

                    <?php 
                      $query="SELECT * FROM `users` ";
                      $result=mysqli_query($con,$query);			
                      $num_rows = mysqli_num_rows($result);
                      {
                    ?>
										<?php echo $num_rows;  } ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers" style="width:150% !important;">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Affiliate Withdrawal Requests</p>
				        	<h5 class="font-weight-bolder mb-0 mt-2" style="font-weight:700">
                    <?php 
                      $query="SELECT * FROM `transactions` WHERE `status`='Pending' AND `type`='Withdrawal' AND `account_type`='Referral' ";
                      $result=mysqli_query($con,$query);
                    
                      $sum = 0;
                      while($row=mysqli_fetch_array($result)){
                            
                      $amount = $row['amount'];
                      $sum += (int)$amount;
                      }
                    ?>    
                      &#8358;<?php echo number_format($sum) ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers" style="width:150% !important;">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Tiktok Withdrawal Requests</p>
				        	<h5 class="font-weight-bolder mb-0 mt-2" style="font-weight:700">
                    <?php 
                      $query="SELECT * FROM `transactions` WHERE `status`='Pending' AND `type`='Withdrawal' AND `account_type`='Tiktok' ";
                      $result=mysqli_query($con,$query);
                    
                      $sum = 0;
                      while($row=mysqli_fetch_array($result)){
                            
                      $amount = $row['amount'];
                      $sum += (int)$amount;
                      }
                    ?>    
                      &#8358;<?php echo number_format($sum) ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers" style="width:150% !important;">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Ads Job Withdrawal Requests</p>
				        	<h5 class="font-weight-bolder mb-0 mt-2" style="font-weight:700">
                    <?php 
                      $query="SELECT * FROM `transactions` WHERE `status`='Pending' AND `type`='Withdrawal' AND `account_type`='Job' ";
                      $result=mysqli_query($con,$query);
                    
                      $sum = 0;
                      while($row=mysqli_fetch_array($result)){
                            
                      $amount = $row['amount'];
                      $sum += (int)$amount;
                      }
                    ?>    
                      &#8358;<?php echo number_format($sum) ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-xl-3 col-sm-6 mb-xl-0 mt-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Affiliate Payouts</p>
                    <h5 class="font-weight-bolder mb-0 mt-2" style="font-weight:700">
                    <?php 
            $query="SELECT * FROM `transactions` WHERE `status`='Confirmed' AND `type`='Withdrawal' AND `account_type`='Referral' ";
            $result=mysqli_query($con,$query);
          
            $sum = 0;
            while($row=mysqli_fetch_array($result)){
                  
            $amount = $row['amount'];
            $sum += (int)$amount;
            }
    ?>    
                      &#8358;<?php echo number_format($sum) ?>

                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mt-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Tiktok Payouts</p>
                    <h5 class="font-weight-bolder mb-0 mt-2" style="font-weight:700">
                    <?php 
            $query="SELECT * FROM `transactions` WHERE `status`='Confirmed' AND `type`='Withdrawal' AND `account_type`='Tiktok' ";
            $result=mysqli_query($con,$query);
          
            $sum = 0;
            while($row=mysqli_fetch_array($result)){
                  
            $amount = $row['amount'];
            $sum += (int)$amount;
            }
    ?>    
                      &#8358;<?php echo number_format($sum) ?>

                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mt-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Ads Job Payouts</p>
                    <h5 class="font-weight-bolder mb-0 mt-2" style="font-weight:700">
                    <?php 
                      $query="SELECT * FROM `transactions` WHERE `status`='Confirmed' AND `type`='Withdrawal' AND `account_type`='Job' ";
                      $result=mysqli_query($con,$query);
                    
                      $sum = 0;
                      while($row=mysqli_fetch_array($result)){
                            
                      $amount = $row['amount'];
                      $sum += (int)$amount;
                      }
                    ?>    
                      &#8358;<?php echo number_format($sum) ?>

                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 mt-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers" style="width:150% !important;">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Pending Affiliate Withdrawals</p>
                    <h5 class="font-weight-bolder mb-0 mt-2" style="font-weight:700">
                  	<?php 
                      $query="SELECT * FROM `transactions` WHERE `status`='Pending' AND `type`='Withdrawal' AND `account_type`='Referral' ";
                      $result=mysqli_query($con,$query);			
                      $num_rows = mysqli_num_rows($result);
                      {
                    ?>
										<?php echo htmlentities($num_rows);  } ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mt-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers" style="width:150% !important;">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Pending Tiktok Withdrawals</p>
                    <h5 class="font-weight-bolder mb-0 mt-2" style="font-weight:700">
                  	<?php 
                      $query="SELECT * FROM `transactions` WHERE `status`='Pending' AND `type`='Withdrawal' AND `account_type`='Tiktok' ";
                      $result=mysqli_query($con,$query);			
                      $num_rows = mysqli_num_rows($result);
                      {
                    ?>
										<?php echo htmlentities($num_rows);  } ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mt-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers" style="width:150% !important;">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Pending Ads Job Withdrawal</p>
                    <h5 class="font-weight-bolder mb-0 mt-2" style="font-weight:700">
                  	<?php 
                      $query="SELECT * FROM `transactions` WHERE `status`='Pending' AND `type`='Withdrawal' AND `account_type`='Job' ";
                      $result=mysqli_query($con,$query);
                    
                      $sum = 0;
                      while($row=mysqli_fetch_array($result)){
                            
                      $amount = $row['amount'];
                      $sum += (int)$amount;
                      }
                    ?>    
                      &#8358;<?php echo number_format($sum) ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-lg-12">
                  <div class="d-flex flex-column h-100">
                    <p class="mb-1 pt-2 text-bold">Top Referrals</p>
                    <?php 
              // Query to retrieve the top referrers
              $query = "SELECT referred_by, COUNT(*) AS referral_count 
                        FROM users 
                        WHERE referred_by IS NOT NULL AND referred_by != 'majorp'
                        GROUP BY referred_by 
                        ORDER BY referral_count DESC 
                        LIMIT 40";

              // Execute the query
              $result=mysqli_query($con,$query);		

              // Check if the query execution was successful
              if ($result) {
                  // Print the top referrers and their referral counts
                  if ($result->num_rows > 0) {
                      $cnt = 1;
       
                    ?>
                    <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th>SN</th>
                      <th>Username</th>
                      <th>Referrals</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                       while ($row = $result->fetch_assoc()) {
                        $referredBy = $row['referred_by'];
                        $referralCount = $row['referral_count'];
                              
                      ?>
                    <tr>
                    <td><?php echo $cnt++;?></td>

                      <td>
                        <div class="d-flex px-2 py-1">
                         
                          <div class="d-flex flex-column justify-content-center">
                          <p class="text-xs font-weight-bold mb-0"><?php echo $referredBy;?></p>
                     
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $referralCount;?></p>
                      </td>
                     
                    </tr>
                    
                    <?php
                    } 
                 
                    ?>
 
                  </tbody>
                </table>
                <?php
               
              } else {
                  echo "No referrers found.";
              }

            }
                ?>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
        

      <div style="margin-left:10vw;height:30vh;"></div>


			<?php include('include/footer.php');?>


