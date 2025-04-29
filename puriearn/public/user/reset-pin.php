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

if(isset($_POST['submit']))
{
 
    $newpin = sanitize_input($_POST['newpin']);
    $confirmpin = sanitize_input($_POST['confirmpin']);


    $newpin = mysqli_real_escape_string($con, $newpin);
    $confirmpin = mysqli_real_escape_string($con, $confirmpin);


    $newpinhash=md5($newpin);

    if(empty($newpin) || empty($confirmpin)){
      $msg="All pin fields must be filled";
      $type = "warning";
    }elseif(strlen($newpin) > 6){ 
        $msg = "Pin must be 6 digits"; 
        $type = "warning";
    }elseif(strlen($newpin) < 6){ 
        $msg = "Pin must be 6 digits"; 
        $type = "warning";
    }elseif($newpin !== $confirmpin){ 
    $msg="Pins do not match!";
    $type = "warning";
  }else{
    $sql1="UPDATE `users` SET `withdrawal_pin`='$newpinhash'
    WHERE `id` = '$uid' ";
    $result1=mysqli_query($con,$sql1);
    if($result1){ 
      $msg="Withdrawal Pin Reset Successful. Redirecting you...";
      $type = "success";
      ?>
            <script>
            setTimeout(function () {
            window.location ='security.php';
            }, 3000);
            </script>;
           <?php
    }else{
    $msg="something went wrong,please try again";
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
										<h5 class="nk-block-title">Reset Withdrawal Pin</h5>
											<div class="nk-block-des">
                                            <p>Please enter a new withdrawal pin</p>
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
													<div class="form-info">New Pin</div>
													<input type="number" name="newpin" class="form-control form-control-amount form-control-lg" 
                                                    value="" required>
												</div>
											</div>
                                           
                                            <div class="invest-field form-group">
												<div class="form-control-group">
													<div class="form-info">Confirm Pin</div>
													<input type="number" name="confirmpin" class="form-control form-control-amount form-control-lg" 
                                                    value="" required>
												</div>
											</div>
                                           
                                           
                                            <div class="invest-field form-group">
				                              <button type="submit" name="submit" class="btn btn-lg btn-primary ttu">Reset</button>
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
