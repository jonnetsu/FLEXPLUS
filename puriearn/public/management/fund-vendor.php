<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');

ini_set('display_errors', 1); error_reporting(E_ALL);

$uid=($_GET['uid']);

$sql = "SELECT * FROM users WHERE id=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$coupon_bal=$row['coupon_account_bal'];

if(isset($_POST['submit'])) {
  $amount = $_POST['amount'];
 
  $newbal=$coupon_bal + $amount;

  $sql1 = "UPDATE `users` SET `coupon_account_bal` = '$newbal' WHERE `id` = '$uid'";
  $result1 = mysqli_query($con, $sql1);

  if($result1) {
      $msg = "Balance Updated Successfully. Refreshing...";
      $type = "success";
      ?>
      <script>
      setTimeout(function () {
      window.location ='fund-vendor.php?uid=<?php echo $uid; ?>';
      }, 3000);
      </script>
     <?php
  } else {
      $msg = "Something went wrong. Please try again";
      $type = "warning";
  }
}

?>

 <!-- Content wrapper -->
 <div class="content-wrapper">
            <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Fund Vendor/</span> <?php echo $row['fullname'] ?></h4>
 
 <div class="card mb-4">
                    <h5 class="card-header">Balance -  &#8358;<?php echo $row['coupon_account_bal'] ?></h5>
                    <!-- Account -->
                    <hr class="my-0" />
                    <div class="card-body">
                    <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
                    <form  method="post" action="">
                        <div class="row">
                        <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Amount</label>
                        <input type="text" class="form-control" name="amount" 
                         value="<?php if(isset($_POST['amount'])) echo $_POST['amount']; ?>"  />
                      </div>
                      
                     
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2" type="submit" name="submit" >Submit</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                

</div></div>

             
              </div>
            </div>
            </div>
            </div>
            <!-- / Content -->



<?php include 'include/footer.php' ?>
