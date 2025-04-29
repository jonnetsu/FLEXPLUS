<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('includes/checklogin.php');
include 'includes/functions.php';

//ini_set('display_errors', 1); error_reporting(E_ALL);


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

if(isset($_POST['submit'])) {
 
    $pin = $_POST['pin'];
    $repin = $_POST['repin'];

    // Validate and sanitize input
    $pin = htmlspecialchars(strip_tags($pin));
    $repin = htmlspecialchars(strip_tags($repin));

    if(strlen($pin) !== 6) {
        $msg = "Pin must be exactly 6 digits";
        $type = "warning";
    } elseif(!ctype_digit($pin)) {
        $msg = "Pin must contain only digits";
        $type = "warning";
    } elseif($pin !== $repin) {
        $msg = "Pin does not match";
        $type = "warning";
    } else {
        // Use a more secure hashing algorithm
        $hashed_pin = password_hash($pin, PASSWORD_DEFAULT);

        // Use a prepared statement to avoid SQL injection
        $sql1 = "UPDATE `users` SET `withdrawal_pin` = ? WHERE `id` = ?";
        $stmt = $con->prepare($sql1);
        $stmt->bind_param('si', $hashed_pin, $uid);

        if($stmt->execute()) {
            $msg = "Withdrawal Pin Set Successfully. Redirecting you...";
            $type = "success";
            echo '<script>
                    setTimeout(function () {
                        window.location = "withdrawal.php";
                    }, 3000);
                  </script>';
        } else {
            $msg = "Something went wrong, please try again";
            $type = "warning";
        }

        $stmt->close();
    }

}

?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <h4>Set Withdrawal Pin</h4>
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

								<form action="#" class="invest-form" method="post">
                                   
									<div class="row g-3">
                                          <div class="col-12"> 
                                              <label class="form-label">Pin</label>
                                                    <input type="number" name="pin" class="form-control " 
                                                    placeholder="Enter 6 digits pin" value="" required>											
                                                <div class="form-note pt-2">  Set 6-Digits Transfer Pin</div>
											</div>
											
                                            <div class="col-12"> 
                                                 <label class="form-label">Confirm Pin</label>
													<input type="number" name="repin" class="form-control " 
                                                    placeholder="Confirm 6 digits pin" value="" required>
											</div>
                                            <div class="col-12"> 
				                               <button type="submit" name="submit" class="btn btn-primary w-100">Set Pin</button>
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
