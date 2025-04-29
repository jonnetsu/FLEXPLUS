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

//Update Bank  accounts
if(isset($_POST['submit']))
{
    $bank = sanitize_input($_POST['bank']);
    $accountname = sanitize_input($_POST['accountname']);
    $accountnumber = mysqli_real_escape_string($con, $_POST['accountnumber']);

    $bank=mysqli_real_escape_string($con,$bank);
    $accountname=mysqli_real_escape_string($con,$accountname);
    $accountnumber=mysqli_real_escape_string($con,$accountnumber);


  $sql = "UPDATE `users` set `bank_name`='$bank',`account_name`='$accountname',`account_number`='$accountnumber',updated_at='$currentTime'
         WHERE `id`='$uid' ";	
			$res = mysqli_query($con, $sql);
      if($res){
        $msg="Bank Account Details Updated Successfully!";
        $type = "success";
}else{
        $msg="Failed to Update Account Details";
        $type = "warning";
}

}

?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <h4>Withdrawal Details</h4>
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
                                              <label class="form-label">Bank Name</label>
                                            <select name="bank" class="form-control" required>
											<?php 
												$query2="SELECT * FROM `users` WHERE `id`=$uid ";
												$result2=mysqli_query($con,$query2);
												while($row2=mysqli_fetch_array($result2))
												{?>
                       							<option value="<?php echo $row2['bank_name']; ?>" <?php if( $row['bank_name'] == $row['bank_name']){ echo "selected"; } ?>><?php echo $row2['bank_name']; ?></option>
                        						<?php } ?>
												<option value="Access Bank">Access Bank</option>
													<option value="United Bank for Africa (UBA)">United Bank for Africa (UBA)</option>
													<option value="Guaranty Trust Bank (GTBank)">Guaranty Trust Bank (GTBank)</option>
													<option value="First Bank of Nigeria">First Bank of Nigeria</option>
													<option value="Zenith Bank">Zenith Bank</option>
													<option value="Fidelity Bank">Fidelity Bank</option>
													<option value="Stanbic IBTC Bank">Stanbic IBTC Bank</option>
													<option value="Union Bank of Nigeria">Union Bank of Nigeria</option>
													<option value="Ecobank Nigeria">Ecobank Nigeria</option>
													<option value="Keystone Bank">Keystone Bank</option>
													<option value="Kuda Microfinance Bank">Kuda Bank</option>
                                                    <option value="Opay">Opay</option>
													<option value="Palmpay">Palmpay</option>
													<option value="Wema Bank">Wema Bank</option>
													<option value="FCMB">FCMB</option>
													<option value="Sterling Bank">Sterling Bank</option>
													<option value="Globus Bank">Globus Bank</option>
													<option value="Raven Bank">Raven Bank</option>
                                            </select>	
											</div>
											
                                            <div class="col-12"> 
                                                 <label class="form-label">Account Name</label>
                                                     <input type="text" name="accountname" class="form-control" 
                                                     value="<?php echo $row['account_name']; ?>" required>
											</div>
                                            <div class="col-12"> 
                                                 <label class="form-label">Account Number</label>
                                                 <input type="text" name="accountnumber" class="form-control" 
                                                    value="<?php echo $row['account_number']; ?>">
											</div>
                                            <div class="col-12"> 
				                               <button type="submit" name="submit" class="btn btn-primary w-100">Update</button>
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
