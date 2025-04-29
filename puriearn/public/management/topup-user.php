<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
include('include/functions.php');

$title="Add Farmer";
$current_date = date("Y-m-d");

$uid=($_GET['uid']);

$sql = "SELECT * FROM users WHERE id=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);


if(isset($_POST['submit']))
{
    $account=$_POST['account'];
    $amount=$_POST['amount'];

      //Check for the old balance
    
      $oldbal = $row[$account];
      $newbal = $oldbal + $amount;

      
      $sql1="UPDATE `users` SET `$account`='$newbal' WHERE `id`='$uid' ";
      $result1=mysqli_query($con,$sql1);
        if($result1){ 

        $msg="Account Topped-up Successfully.Redirecting you...";
        $type = "success";
        ?>
        <script>
          setTimeout(function () {
          window.location ='users.php';
          }, 3000);
          </script>;
         <?php
        }else{
        $msg="something went wrong,please try again";
        $type = "warning";
        }  
}


?>

  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User/</span> Update Balance</h4>
 
 <div class="card mb-4">
                    <h5 class="card-header">Top-up Account - <?php echo $row['fullname'] ?></h5>
                    <!-- Account -->
                    <hr class="my-0" />
                    <div class="card-body">
                    <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
                    <form  method="post" action="" >
                        <div class="row">
                        <div class="mb-3 col-md-12">
                        <label class="form-label" for="basic-default-fullname">Account</label>
                        <select name="account"  class="form-control form-control-white" required>    
                        <option value="ref_bonus">Affilate -- ₦<?php echo $row['ref_bonus'] ?></option>
                        <option value="indirect_ref_bonus">Indirect AFfiliate -- ₦<?php echo $row['indirect_ref_bonus'] ?></option>
                        <option value="earnings">Activity -- <?php echo $row['earnings'] ?>EIX</option>
                        </select>
                      </div>
                      <div class="mb-3 col-md-12">
                        <label class="form-label" for="basic-default-fullname">Amount</label>
                        <input type="text" name="amount" class="form-control form-control-white"  
                        placeholder="0" required>
                      </div> 
                      
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
            <!-- / Content -->



                  
<?php include('include/footer.php');?>
