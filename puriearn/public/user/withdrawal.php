<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('includes/checklogin.php');
include('includes/functions.php');

check_login();
$title="Dashboard";
$uip=$_SERVER['REMOTE_ADDR'];
include 'includes/header.php'; 

$uid= $_SESSION['id'];
$sql = "SELECT * FROM `users` WHERE `id`= $uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$uplan=$row['plan_id'];
$username=$row['username'];
$referral_code=$row['referral_code'];

$tiktok_balance=$row['tiktok_balance'];
$referral_balance=$row['ref_bonus'];
$indirect_referral_balance=number_format($row['indirect_ref_bonus']);
$cashback_balance=$row['cashback'];
$job_balance=$row['job_balance'];
$withdrawal_pin=$row['withdrawal_pin'];

$bank=$row['bank_name'];
// Fetch the portal statuses from the database
$query = "SELECT portal_name, status FROM withdrawal_portals";
$result = mysqli_query($con, $query);

// Initialize variables for portal statuses
$tiktokPortalStatus = 0;
$referralPortalStatus = 0;
$cashbackPortalStatus = 0;
$jobPortalStatus      = 0;

// Check if there are any results
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['portal_name'] === 'Tiktok') {
            $tiktokPortalStatus = $row['status'];
        } elseif ($row['portal_name'] === 'Affiliate') {
            $referralPortalStatus = $row['status'];
        } elseif ($row['portal_name'] === 'Job') {
            $jobPortalStatus = $row['status'];
        }elseif ($row['portal_name'] === 'Cashback') {
            $cashbackPortalStatus = $row['status'];
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //$pin = $_POST['pin'];
    //$pin = mysqli_real_escape_string($con, $pin);
    $account = sanitize_input($_POST['account']);
    $amount = sanitize_input($_POST['amount']);

    // Check if the user has a pending transaction
    $checkQuery = "SELECT * FROM `transactions` WHERE `user_id` = '$uid' AND `status` = 'Pending' LIMIT 1";
    $checkResult = mysqli_query($con, $checkQuery);
    $hasPendingTransaction = mysqli_num_rows($checkResult) > 0;


    if ($account == 'job') {
        $balance = $activity_balance;
        $limit = 15000;
        $type = 'Job';
        $account_table_name = 'job_balance';
        $newbal = $activity_balance - $amount;

    }elseif ($account == 'cashback'){
        $balance = $activity_balance;
        $limit = 15000;
        $type = 'Cashback';
        $account_table_name = 'cashback';
        $newbal = $activity_balance - $amount;

    }elseif ($account == 'tiktok'){
        $balance = $activity_balance;
        $limit = 5000;
        $type = 'Tiktok';
        $account_table_name = 'tiktok_balance';
        $newbal = $activity_balance - $amount;

    } else {
        $limit = 5000;
        $balance = $referral_balance;
        $type = 'Referral';
        $account_table_name = 'ref_bonus';
        $newbal = $referral_balance - $amount;
    }
   
   if ($hasPendingTransaction) {
        $msg = "You already have a pending withdrawal request. Please wait for it to be processed.";
        $type = "warning";
    } elseif ($balance < $limit) {
        $msg = "Your account balance is lower than the withdrawal limit";
        $type = "warning";
    } elseif ($amount > $balance) {
        $msg = "Your account balance is lower than the entered amount";
        $type = "warning";
    } elseif ($amount < $limit) {
        $msg = "The entered amount is lower than the withdrawal limit";
        $type = "warning";
    } elseif ($bank == '') {
        $msg = "Please complete your bank account information before placing a withdrawal";
        $type = "warning";
    } elseif ($account == '') {
        $msg = "The withdrawal portal is closed. Please wait until withdrawal date";
        $type = "warning";
    }else {
    $sql1 = "INSERT INTO `transactions` (`user_id`,`account_type`,`type`,`amount`)
                                VALUES  ('$uid','$type','Withdrawal','$amount')";
    $result1 = mysqli_query($con, $sql1);
    if ($result1) {
        $updateQuery = "UPDATE `users` SET `$account_table_name`='$newbal' WHERE `id`='$uid'";
        $result2 = mysqli_query($con, $updateQuery);
        $msg = "Withdrawal placed successfully.";
        $type = "success";
        echo '<script>
        setTimeout(function () {
            window.location ="history.php";
        }, 3000);</script>';
    } else {
        $msg = "something went wrong,please try again";
        $type = "warning";
    }
    }
}

?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <h4>Withdraw</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">


                        <?php if(isset($msg)){ ?>
                                <div class="alert alert-<?php echo $type?>">
                                <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                                <p class="mb-0"><?php echo $msg?></p>
                                </div>
                        <?php }?>
                    </div>
                
                    <div class="card border-0">
                       
                        <div class="card-body pt-3">
                            <form class="" method="post" action="">
                                <div class="row g-3">
                                   <div class="col-12"> 
                                        <label class="form-label">Balance</label>
                                            <select name="account" class="form-control" required>
                                            <option value="referral" <?php echo ($referralPortalStatus == 1) ? '' : 'disabled'; ?>>
                                                AFFILIATE EARNINGS - &#8358;<?php echo number_format($referral_balance);?>
                                            </option>
                                            <option value="tiktok" <?php echo ($tiktokPortalStatus == 1) ? '' : 'disabled'; ?>>
                                               TIKTOK EARNINGS - &#8358;<?php echo number_format( $tiktok_balance);?> 
                                            </option> 
                                            <option value="job" <?php echo ($jobPortalStatus == 1) ? '' : 'disabled'; ?>>
                                                ADS TASK EARNINGS - &#8358;<?php echo number_format($job_balance);?>
                                            </option>
                                            </select>	
                                    </div>
                                <div class="col-12"> 
                                        <label class="form-label">amount</label>
                                        <input type="number" name="amount" class="form-control" 
                                                    placeholder="5000" value="" required>
                                </div> 
                                <!--
                                <div class="col-12"> 
                                        <label class="form-label">Pin</label>
                                        <input type="password" name="pin" class="form-control" 
                                                    placeholder="Withdrawal Pin" value="" required>
                                </div>
                                -->
                                <div class="col-12">     
                                    <small class="">
                                        <strong>Note:</strong>
                                        <li>Minimum withdrawal for affiliate is ₦5,000. </li>
                                        <li>Minimum Ads Task Earning is ₦15,000. </li>
                                        <li>Minimum Tiktok Withdrawal is ₦5,000</li>
                                    </small>       
                            </div>

                                    </div>
                                    <br>
                                    <?php
                    if($bank == "") {
                    ?>
                     <div class="col-12"> 
                        <p class="alert alert-warning"> Your bank account details has not been set. Please set details before placing a withdrawal</p>
                    <a href='withdraw-settings.php' class='btn btn-success'> Set Withdrawal Details </a>
                    </div>
                    <?php }else{
                        ?>
                    <div class="col-12"> 
                        <button type="submit" class="btn btn-primary w-100">Place Withdrawal</button>
                    </div>
                        <?php
                         }
                    
                    ?>
                                               
        </form>
                        </div>
                    </div>


                   

<?php include 'includes/footer.php' ?>
