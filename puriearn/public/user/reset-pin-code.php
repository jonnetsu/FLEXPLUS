<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('includes/checklogin.php');
include 'includes/functions.php';

error_reporting(E_ALL);
check_login();
$title="Dashboard";
$uip=$_SERVER['REMOTE_ADDR'];
include 'includes/header.php'; 

$currentTime = date( 'd-m-Y h:i:s A', time () );


$uid = $_SESSION['id'];
$sql = "SELECT * FROM `users` WHERE `id` = $uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$user_email = $row['email'];

if (isset($_POST['submit'])) {
    $code = sanitize_input($_POST['digits']);

    $sql = "SELECT * FROM users WHERE email = '$user_email'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);

    $uid = $row['id'];
    $uemail = $row['email'];
    $dcode = $row['code'];

    if ($code != $dcode) {
        $msg = "Invalid Verification Code";
        $type = "warning";
    } elseif (strlen($code) !== 6) {
        $msg = "Verification Code must be 6 digits";
        $type = "warning";
    } else {
        // Delete the used code from the user account
        $updateQuery = "UPDATE `users` SET `code` = '' WHERE `id` = '$uid' ";
        mysqli_query($con, $updateQuery);
         if($updateQuery){
            $msg="Verification successful. Redirecting you...";
            $type = "success";
            ?>
            <script>
            setTimeout(function () {
            window.location ='reset-pin.php';
            }, 3000);
            </script>;
           <?php
         }else{
            $msg="An error occured. Please try again";
            $type = "warning";
         }        
    }
}
?>


<div class="nk-content nk-content-lg nk-content-fluid">
				<div class="container-xl wide-lg">
					<div class="nk-content-inner">
						<div class="nk-content-body">
							
                           
                        <div class="nk-block-head">
								<div class="nk-block-head-content">
									<div class="nk-block-between-md g-4">
										<div class="nk-block-head-content">
										<h5 class="nk-block-title">Verification Code</h5>
											<div class="nk-block-des">
                                            <p>Please enter the 6-digits code that was sent to your email to proceed.</p>
                                            <p 
                            style="font-size:12px;color:red;">If you didn't receive the email, please check your spam box</p>
											</div>
										</div>
										
									</div>
								</div>
							</div>
							<div class="nk-block">
								
                                <div class="col-lg-7 mb-3">
                            <?php if(isset($msg)){ ?>
                                <div class="alert alert-<?php echo $type?>">
                                <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                                <p class="mb-0"><?php echo $msg?></p>
                                </div>
                            <?php }?>
                            </div>

									<form action="" class="invest-form" method="post">
									<div class="row g-gs">

									<div class="col-lg-7">	
                                            <div class="invest-field form-group">
												<div class="form-control-group">
													<div class="form-info">Code</div>
													<input type="numbers" name="digits" class="form-control form-control-amount form-control-lg" 
                                                    value="" required>
												</div>
											</div>
                                           
                                           
                                            <div class="invest-field form-group">
				                              <button type="submit" name="submit" class="btn btn-lg btn-primary ttu">Verify</button>
				                        	</div>
                                </form>

                                
                                </div>

                             

                        </div> 
							

                      
							
							</div>
						</div>
     

					</div>
				</div>
			</div>
			
		</div>
	</div>
    <?php include 'bottom-tabs.php' ?>
<?php include 'includes/footer.php' ?>
