<?php 
session_start();
// Database connection
include('../config/puri-conn.php');
include "includes/header.php"; 

if(isset($_POST['submit'])) {
// Retrieve the submitted coupon code
$couponCode = $_POST['coupon_code'];

// Perform the database query
$sql = "SELECT coupon_code, status, used_by
        FROM coupons
        WHERE coupon_code = '$couponCode'";

// Execute the query and retrieve the result
$result = mysqli_query($con, $sql);

// Check if the query was successful
if ($result) {
  // Check if a matching coupon code was found
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Retrieve the coupon code details
    $couponCode = $row['coupon_code'];
    $status = $row['status'];
    $usedBy = $row['used_by'];

    // Prepare the message to display
    $message = "Coupon Code: $couponCode\n";
    $message .= "Status: $status\n";

    if ($status== '1') {
        $msg = "Coupon code already used by $usedBy";
        $type = "warning";
    } else {
        $msg = "Coupon code still active";
        $type = "success";
    }
  } else {
    $msg = "Coupon code does not exist.";
    $type = "warning";
  }
} else {
    $msg = "Something went wrong, please try again.";
    $type = "warning";
}

}

?>
    <!-- breadcrumb -->
    <section class="w3l-about-breadcrumb">
        <div class="breadcrumb-bg breadcrumb-bg-about">
            <div class="container py-lg-5 py-sm-4">
                <div class="w3breadcrumb-gids text-center">
                    <div class="w3breadcrumb-info mt-5">
                        <h2 class="w3ltop-title pt-4">Coupon Tracker</h2>
                        <ul class="breadcrumbs-custom-path">
                            <li><a href="index.php">Home</a></li>
                            <li class="active"><span class="fas fa-angle-double-right mx-2"></span> Track Coupon Codes </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--//breadcrumb--> 
 <!-- feature with photo1 -->
 <section class="w3l-feature-with-photo-1">
        <div class="feature-with-photo-hny py-5">
            <div class="container py-lg-5">

                <p>Track coupon codes to know the status or who used it.</p>
       
        <div class="container wall mt-4 mb-16">
            <div class="row">
            <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>

        <form method="POST" action="#">
        <label for="coupon_code">Coupon Code:</label>
        <input type="text" id="coupon_code" name="coupon_code" required
        class="form-control">
      <div class="form-group mt-3">
      <button type="submit" class="btn btn-primary" name="submit">Track Code</button>
     </div>
        </form>


        </div>
    </div>

    <div style="margin-bottom:50px;height:100px;"></div>
</section>
<!-- Terms-area end -->

<script>
//function goToLink(url) {
//  window.location = url;
//}
</script>
<?php include "includes/footer.php" ?>
