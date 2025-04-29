<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('includes/checklogin.php');
check_login();
$title="Dashboard";
$uip=$_SERVER['REMOTE_ADDR'];
include 'includes/header.php'; 

$uid= $_SESSION['id'];
$sql = "SELECT * FROM `users` WHERE `id`=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$username=$row['username'];

$uplan=$row['plan_id'];
$activity_balance=$row['earnings'];
$referral_balance=$row['ref_bonus'];

?>
 <!-- Main Wrapper-->
 <main class="main-wrapper">
            <div class="container-fluid">
                    <div class="col-xxl-9 col-lg-8">
                        <div class="inner-contents">
                            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                                <div class="left-part">
                                    <h2 class="text-dark">Referrals</h2>
                                    <p class="text-gray mb-0">Hi there, your referrals would appear below.Refer and earn.</p>
                                </div>  
								<div class="right-part">
									<button id="copyButton" class="btn btn-primary rounded-2 ff-heading fs-18 fw-bold py-4">
									<i class="bi bi-pie-chart-fill me-1"></i> Copy Affiliate Link
									</button>
								</div>   
                            </div>
							
		<script type="text/javascript">
	atOptions = {
		'key' : '704054eaa141a74a3bff128905210a64',
		'format' : 'iframe',
		'height' : 50,
		'width' : 320,
		'params' : {}
	};
	document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://www.profitabledisplaynetwork.com/704054eaa141a74a3bff128905210a64/invoke.js"></scr' + 'ipt>');
</script>

							<div class="card border-0">
								<div class="dropdown-widget p-5">
                                                    <div class="dropdown-wrapper">
                                                        <ul class="notification-board list-unstyled">
																					<?php 
											$query="SELECT * FROM `users` WHERE `referred_by`='$username' ORDER BY `id` DESC";
											$result=mysqli_query($con,$query);
											$cnt=1;
											if(mysqli_num_rows($result)>0){
												while($row=mysqli_fetch_array($result)){
												$uplan = $row['plan_id'];

												
										$date_string=$row['created_at'];// date retrieved from database
										$timestamp = strtotime($date_string); // convert date string to Unix timestamp
										$date = date("jS \ F, Y ", $timestamp);// format timestamp into words
										$profile_pic=$row['user_picture'];
										?>
										<li class="author-online has-new-message">
											<a  href="#" class=" d-flex gap-3">
												<div class="media  d-sm-block">
													<img src="../admin/profilepics/<?php echo $profile_pic; ?>" alt="img" width="60" class="rounded-2">
												</div>
												<div class="user-message" style="">
													<h6 class="message mb-1"><?php echo htmlentities($row['username']);?> <span class="fs-12 fw-normal text-gray float-end"> <?php echo htmlentities($date);?></span></h6>
												
														<p class="message-footer d-flex align-items-center justify-content-between" style="color:green;">+&#8358;3,000</p>
												  
												</div>
								
											</a>
										</li>
								<?php } 
								}else{

								echo"
								<div class='nk-block-des' style='text-align:center;margin-top:20vh;'>
								<h4>Oops!</h4>
								<p>You don't have any referral.<br>Please refer and earn referral bonuses</p>
							</div>
                     
                      ";
                    }
                    ?>
						</ul>	
							</div>

								
								</div>
							</div>
				       </div>
					</div>
			</div>
</main>

<script>
  // Get the referral link dynamically from PHP
  const referralLink = 'https://promiqtechnology.online/user/signup.php?ref=<?php echo $username; ?>';

  const copyButton = document.getElementById('copyButton');

  // Add a click event listener to the button
  copyButton.addEventListener('click', function () {
    // Create a new textarea element
    const textarea = document.createElement('textarea');
    textarea.value = referralLink;

    // Append the textarea to the document
    document.body.appendChild(textarea);

    // Select the textarea's content and copy it to the clipboard
    textarea.select();
    document.execCommand('copy');

    // Remove the textarea
    document.body.removeChild(textarea);

    // Change the button text and color to indicate success
    copyButton.textContent = 'Link copied to clipboard!';
    copyButton.classList.remove('btn-primary');
    copyButton.classList.add('btn-success');

    // Reset the button text and color after a brief delay
    setTimeout(() => {
      copyButton.textContent = 'Copy Affiliate Link';
      copyButton.classList.remove('btn-success');
      copyButton.classList.add('btn-primary');
    }, 2000); // Adjust the delay duration (in milliseconds) as needed
  });
</script>
<?php include 'bottom-tabs.php' ?>
<?php include 'includes/footer.php' ?>
