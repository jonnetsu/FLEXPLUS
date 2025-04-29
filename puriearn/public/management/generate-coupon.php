<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
include('include/functions.php');
date_default_timezone_set('Africa/Lagos'); // Set the time zone to Nigeria (West Africa Time)

$title="Generate Coupon";
$current_date = date("Y-m-d");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = 'PURIEARN';
    $count = $_POST["count"];
  
    // Include or require the file containing the generateCouponCodes function
  
    // Call the generateCouponCodes function
    $codes = generateCouponCodes($name, $count, $con);

  
    if (!empty($codes)) {
        $msg="Codes generated successfully !!";
        $type = "success";
      } else {
        $msg="Error generating coupon codes. Please try again.";
        $type = "warning";
      }

  }

?>

  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Coupon/</span> Generate Coupon Codes</h4>
 
 <div class="card mb-4">
                    <h5 class="card-header">New Code</h5>
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
                        <div class="mb-3 col-md-12">
                        <label class="form-label" for="basic-default-fullname">Number of Codes</label>
                        <input type="text" name="count" class="form-control"  value="">
                      </div>
                     
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2" type="submit" name="submit" >Generate</button>
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
