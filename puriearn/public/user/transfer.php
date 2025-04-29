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
$referral_balance=$row['ref_bonus'];
$indirect_referral_balance=$row['indirect_ref_bonus'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $limit=100;
  $amount = sanitize_input($_POST['amount']);
  $amount=mysqli_real_escape_string($con,$amount);

    if($amount < $limit){
        $msg = "Your account balance is lower than the transfer limit"; 
        $type = "warning";
    }elseif($amount > $indirect_referral_balance){ 
            $msg = "Your account balance is lower than the entered amount"; 
            $type = "warning";   
    }elseif($amount == ''){ 
        $msg = "Amount cannot be less empty"; 
        $type = "warning";
    }else{

        $new_ref_balance=$referral_balance + $amount;
        $new_in_ref_balance=$indirect_referral_balance - $amount;

        $sql="UPDATE `users` SET `ref_bonus`='$new_ref_balance' WHERE `id`='$uid' ";
        $result=mysqli_query($con,$sql);
        if($result){ 
            $sql1="UPDATE `users` SET `indirect_ref_bonus`='$new_in_ref_balance' WHERE `id`='$uid' ";
        $result1=mysqli_query($con,$sql1);
            $msg="Transfer Successful";
            $type = "success";
            }else{
            $msg="something went wrong,please try again";
            $type = "warning";
            }  
            
    }

}

?>
<!-- Page Sidebar Ends-->
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12">
                  <h4>Transfer Indirect Balance</h4>
                </div>
              
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
                            <div class="container-fluid">
                            <?php if(isset($msg)){ ?>
                                <div class="alert alert-<?php echo $type?>">
                                <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                                <p class="mb-0"><?php echo $msg?></p>
                                </div>
                            <?php }?>

                        
                    <div class="card border-0">
                         <div class="card-body pt-3 pb-5">
                            <h4 style="margin-bottom:20px;"> Current Balance:₦<?php echo $indirect_referral_balance;?></h4>
								<form action="#" class="invest-form" method="post">
                                     <div class="row g-3">
                                        <div class="col-12"> 
                                            <label class="form-label">Amount</label>
                                                <input type="text" name="amount" class="form-control" 
                                                placeholder="100" value="">
                                        </div>
                                         <div class="form-note"><strong>Note:</strong> Enter the amount you want to transfer to your affilate balance </div>

                                         <div class="col-12"> 
												<button type="submit" class="btn btn-primary w-100">Transfer</button>
											</div>
										</div>
										
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

<?php include 'includes/footer.php' ?>
