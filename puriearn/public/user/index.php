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
$sql = "SELECT * FROM `users` WHERE `id`=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$uplan=$row['plan_id'];
$username=$row['username'];
$referral_code=$row['referral_code'];

$activity_balance=number_format($row['earnings']);
$referral_balance=number_format($row['ref_bonus']);
$indirect_referral_balance=number_format($row['indirect_ref_bonus']);
$cashback_balance=number_format($row['cashback']);
$job_balance=$row['job_balance'];

?>
<style>
  /* Overlay style */
  .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    /* Popup style */
	.popup {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
    width: 60%; /* Default width */
    max-width: 90%; /* Maximum width for mobile view */
    }

    .popup-logo{
		width:80px;

	}
	.main-div h1{
		color:#062257;
		font-weight:'600';
		font-size:25px;
		margin-top:20px;
		margin-bottom:10px;
	}
    .success {
      color: green;
    }

    .warning {
      color: red;
    }
	.close-button {
    top: 10px;
    right: 10px;
    padding: 5px;
    background-color: #ccc;
    border-radius: ;
    cursor: pointer;
  }

	 /* Media query for mobile view */
	 @media (max-width: 767px) {
    .popup {
      width: 90%;
    }
	.custom-gift-popup {
		width: 90% !important;
		margin-left:5% !important;

	}
}

</style>


<div class="page-body"> 
          <div class="container-fluid">            
            <div class="page-title"> 
                <div class="col-12" style="margin-bottom:0px;">
                    <h4>
                        Hello <?php echo $username; ?> <img class="mt-0" src="images/hand.gif" alt="hand-gif" style="width:30px;"> </h4>
                        <p>Welcome To Your Dashboard</p>
                </div>
               
            </div>
          </div>
          <!-- Container-fluid starts -->

          <div class="overlay">
    <div class="popup">
      <div class="main-div">
        <img src="images/logo_2.png" alt="PURIEARN" class="popup-logo"
        style="width:130px;margin-bottom:10px;">
        <h1 id="messageOne"></h1>
        <p id="messageTwo"></p>
		<span class="btn btn-primary" onclick="hidePopup()">Close</span>

      </div>
    </div>
  </div>



          <div class="container-fluid">
            <div class="row"> 
             
              <div class="col-xxl-6 box-col-12"> 
                <div class="row">
                  <div class="col-xl-6 col-sm-6 mb-3">
                    <div class="card height-equal">
                      <div class="card-body"> 
                        <ul class="product-costing">
                          <li class="product-cost">
                            <div class="product-icon bg-primary-light">
                                <img src="images/icons/sales.png" class="b-icon">
                            </div>
                            <div><span class="f-w-500 f-14 mb-0 d-text">Total Sales</span>
                              <h2 class="f-w-600">
                              <?php 
                                $query3 = "SELECT * FROM `users` WHERE `referred_by`='$referral_code'";
                                $result3 = mysqli_query($con, $query3);
                                $num_rows3 = mysqli_num_rows($result3);
                                echo htmlentities($num_rows3); 

                                ?>
                              </h2>
                            </div>
                          </li>
                           <li> <span class="f-light f-14 f-w-500"></span></li>
                        </ul> 
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-sm-6 mb-3">
                    <div class="card height-equal">
                      <div class="card-body"> 
                        <ul class="product-costing">
                          <li class="product-cost">
                            <div class="product-icon bg-primary-light">
                              <img src="images/icons/earning.png" class="b-icon">
                            </div>
                            <div><span class="f-w-500 f-14 mb-0 d-text">Affiliate Earnings</span>
                              <h2 class="f-w-600">&#8358;<?php echo $referral_balance; ?></h2>
                            </div>
                          </li>
                           <li> <span class="f-light f-14 f-w-500"></span></li>
                        </ul> 
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-sm-6 mb-3">
                    <div class="card height-equal">
                      <div class="card-body"> 
                        <ul class="product-costing">
                          <li class="product-cost">
                            <div class="product-icon bg-primary-light">
                            <img src="images/icons/team.png" class="b-icon">
                            </div>
                            <div><span class="f-w-500 f-14 mb-0 d-text">Indirect Earnings</span>
                              <h2 class="f-w-600">&#8358;<?php echo $indirect_referral_balance; ?></h2>
                            
                            </div>
                          </li>
                          <a href="transfer.php" 
                                 class="btn btn-primary" 
                                 style="font-size:13px;padding:5px;margin-bottom:-15px;width:80px;font-weight:600;">Transfer</a>
                        </ul> 
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-sm-6">
                    <div class="card height-equal">
                      <div class="card-body"> 
                        <ul class="product-costing">
                          <li class="product-cost">
                             <div class="product-icon bg-primary-light">
                             <img src="images/icons/jobs.png" class="b-icon">
                            </div>
                            <div><span class="f-w-500 f-14 mb-0 d-text">Total Ads Job Earnings</span>
                              <h2 class="f-w-600">&#8358;<?php echo $row['job_balance']+$row['cashback']; ?></h2>
                            </div>
                          </li>
                           <li> <span class="f-light f-14 f-w-500"></span></li>
                        </ul> 
                      </div>
                    </div>
                  </div>
                  <div class="col-xxl-12 col-xl-12 box-col-12 mb-3">
                    <div class="card">
                        <div class="card-header b-bottom"> 
                            <div class="todo-list-header"> 
                                <div class="new-task-wrapper input-group">
                                    <input class="form-control" readonly
                                    id="refUrl" value="https://puriearn.com/user/signup.php?ref=<?php echo $referral_code;?>">
                                    <span class="btn btn-primary add-new-task-btn" id="copy" onclick="copyToClipboard()">Copy Link</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                  <div class="col-xl-6 col-sm-6 mb-3">
                    <div class="card height-equal">
                      <div class="card-body"> 
                        <ul class="product-costing">
                          <li class="product-cost">
                             <div class="product-icon bg-primary-light">
                             <img src="images/icons/jobs.png" class="b-icon">
                             </div>
                            <div><span class="f-w-500 f-14 mb-0">Total Ads Job</span>
                              <h2 class="f-w-600">
                              <?php 
                                $query="SELECT * FROM `user_job_tasks` WHERE `user_id`='$uid' AND `status`= 'Confirmed' ";
                                $result=mysqli_query($con,$query);			
                                $num_rows = mysqli_num_rows($result);
                                {
                              ?>
                              <?php echo $num_rows;  } ?>
                              </h2>
                            </div>
                          </li>
                          <button onclick="addReward()" 
                                 class="btn btn-primary" 
                                 style="font-size:13px;padding:5px;margin-bottom:-15px;width:100px;font-weight:600;">
                                 Daily Task</button>
                        </ul> 
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-sm-6 mb-3">
                    <div class="card height-equal">
                      <div class="card-body"> 
                        <ul class="product-costing">
                          <li class="product-cost">
                             <div class="product-icon bg-primary-light">
                               <img src="images/icons/earning.png" class="b-icon">
                             </div>
                            <div><span class="f-w-500 f-14 mb-0">Overall Total Earnings</span>
                              <h2 class="f-w-600">
                              <?php 
                      // Prepare the query to fetch today's records
                      $query = "SELECT * FROM `earning_history` WHERE `user_id`='$uid' ";

                      $result=mysqli_query($con,$query);
                    
                      $sum = 0;
                      while($row=mysqli_fetch_array($result)){
                            
                      $amount = $row['amount'];
                      $sum += (int)$amount;
                      }
                    ?>    
                      &#8358;<?php echo number_format($sum) ?>
                            </h2>
                            </div>
                          </li>
                           <li> <span class="f-light f-14 f-w-500"></span></li>
                        </ul> 
                      </div>
                    </div>
                  </div>
                  <div class="col-xxl-12 col-md-12 box-col-12 mb-3">
                    
                       <?php include 'banners.php'; ?>
                  </div>

                  <div class="col-xl-6 col-sm-6 mb-3">
                    <div class="card height-equal">
                      <div class="card-body"> 
                        <ul class="product-costing">
                          <li class="product-cost">
                             <div class="product-icon bg-primary-light">
                             <img src="images/icons/earning.png" class="b-icon">
                             </div>
                            <div><span class="f-w-500 f-14 mb-0">Overall Sales Earnings</span>
                              <h2 class="f-w-600">
                              <?php 
                      // Prepare the query to fetch today's records
                      $query = "SELECT * FROM `earning_history` WHERE `type`='Affiliate' AND  `user_id`='$uid' ";

                      $result=mysqli_query($con,$query);
                    
                      $sum = 0;
                      while($row=mysqli_fetch_array($result)){
                            
                      $amount = $row['amount'];
                      $sum += (int)$amount;
                      }
                    ?>    
                      &#8358;<?php echo number_format($sum) ?>
                              </h2>
                            </div>
                          </li>
                           <li> <span class="f-light f-14 f-w-500"></span></li>
                        </ul> 
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-sm-6 mb-3">
                    <div class="card height-equal">
                      <div class="card-body"> 
                        <ul class="product-costing">
                          <li class="product-cost">
                             <div class="product-icon bg-primary-light">
                             <img src="images/icons/withdrawal.png" class="b-icon">
                             </div>
                            <div><span class="f-w-500 f-14 mb-0">Total Affiliate Withdrawal</span>
                              <h2 class="f-w-600">
                              <?php 
                      // Prepare the query to fetch today's records
                      $query = "SELECT * FROM `transactions` WHERE `type`='Withdrawal' AND `status`='Confirmed' AND `user_id`='$uid' ";

                      $result=mysqli_query($con,$query);
                    
                      $sum = 0;
                      while($row=mysqli_fetch_array($result)){
                            
                      $amount = $row['amount'];
                      $sum += (int)$amount;
                      }
                    ?>    
                      &#8358;<?php echo number_format($sum) ?>
                              </h2>
                            </div>
                          </li>
                           <li> <span class="f-light f-14 f-w-500"></span></li>
                        </ul> 
                      </div>
                    </div>
                  </div>
                 
              

          </div>
          <!-- Container-fluid Ends -->
        </div>
       
        <script>
  function addReward() {
  var overlay = document.querySelector('.overlay');
  var popup = document.querySelector('.popup');
  var messageOneElement = document.getElementById('messageOne');
  var messageTwoElement = document.getElementById('messageTwo');

  // Show loading overlay
  overlay.style.display = 'flex';

  // Perform AJAX request
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'add-reward.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      // Hide loading overlay
      overlay.style.display = 'none';

      // Process response
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);

        if (response.success) {
          // Show success message
          messageOneElement.textContent = response.messageOne;
          messageTwoElement.textContent = response.messageTwo;
          messageOneElement.style.display = 'block'; // Show the element
          messageTwoElement.style.display = 'block'; // Show the element
          popup.classList.add('success');
        } else {
          // Show error message
          messageOneElement.textContent = response.messageOne;
          messageTwoElement.textContent = response.messageTwo;
          messageOneElement.style.display = 'block'; // Show the element
          messageTwoElement.style.display = 'block'; // Show the element
          popup.classList.add('warning');
        }

        // Show popup
        overlay.style.display = 'flex';
      }
    }
  };
  xhr.send();
}
function hidePopup() {
      var overlay = document.querySelector('.overlay');
      overlay.style.display = 'none';
    }
</script>


<script>
    var myDate = new Date();
    var hrs = myDate.getHours();

    var greet;

    if (hrs < 12)
        greet = 'Good Morning';
    else if (hrs >= 12 && hrs <= 16)
        greet = 'Good Afternoon';
    else if (hrs >= 16 && hrs <= 24)
        greet = 'Good Evening';

    document.getElementById('lblGreetings').innerHTML =
        '' + greet + ' ';
</script>


<script>
        function copyToClipboard() {
            // Get the input field
            var copyText = document.getElementById("refUrl");
            
            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            document.execCommand("copy");

            // Change the text of the button
            var copyButton = document.getElementById("copy");
            copyButton.innerText = "Copied";
        }
    </script>    
<?php include 'includes/footer.php' ?>
