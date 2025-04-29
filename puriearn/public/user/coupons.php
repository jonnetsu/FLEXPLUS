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
$username=$_SESSION['username'];
$sql = "SELECT * FROM `users` WHERE `id`=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);

$is_vendor=$user['is_vendor'];
$is_publisher=$user['is_publisher'];
$coupon_account=$user['coupon_account_bal'];
 
if($is_vendor == '0'){
    echo "<script>window.location.href='index.php';</script>";
}
?>

<style>
    .popup{
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
    .popup-wrapper {
        position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            z-index: 10000;
            width: 60%; /* Default width */
          max-width: 90%; /* Maximum width for mobile view */
    }
    .popup-logo{
		width:80px;
        margin-bottom:20px;

	}
    .popup h3{
        font-weight:600;
        font-size:25px;
    }
     /* Media query for mobile view */
	 @media (max-width: 767px) {
    .popup-wrapper {
      width: 90%;
    }
}
  </style>

<!-- Page Sidebar Ends-->
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12">
                  <h4>Coupons</h4>
                </div>
              
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
          <div class="container-fluid">

<div class="col-xl-12 col-sm-6 ">
                <div class="card height-equal" style="height:150px;">
                  <div class="card-body bg-primary" 
                      style="display:flex;flex-direction:column;align-items:center;justify-content:center;border-radius:5px;"> 
                    
                            <span class="f-w-500 f-16 mb-2 text-center" >Coupon Balance</span>
                          <h1 class="text-center text-white mb-2" style="font-size:30px;">
                        
                            &#8358;<?php echo number_format($coupon_account); ?>
                        </h1>
                   
                        <form id="plan-form" onsubmit="generateCouponCode(event)">
                        
                        <select id="plan-select" name="plan" style="display:none">
                        </select>
                        <button type="submit" class="btn btn-warning">
                            Generate Code  <i class="icon fa fa-spinner d-none d-sm-inline-block"></i>
                        </button>
                    </form>

                    <div id="popup" class="popup">
                    <div class="popup-wrapper">
                        <img src="images/logo_2.png" alt="PURIEARN" class="popup-logo" style="width:150px;">
                        <h5>Coupon Code:</h5>
                        <input type="text" id="coupon-code-input" readonly class="form-control mt-3">
                        <button onclick="copyToClipboard()" class="btn btn-primary mt-3">Copy to Clipboard</button>
                        <div id="error-container" class="error-container" style="color:red;"></div> <!-- Error container -->

                        <div class="mt-3" style="display:flex;flex-direction:column;align-items:center;justify-content:center;">
                        <button class="close-button btn btn-danger" onclick="closePopup()">Close</button> 
                        <div>
                    </div>
                 </div>



                  </div>
                </div>
              </div>
           </div>
              <br>
              <div class="col-xl-6 col-sm-6 mb-3" 
                    style="display:flex;flex-direction:column;align-items:center;justify-content:center;border-radius:5px;margin-top:-20px;"> 
                    <h6>Total Codes Generated:  <?php 
                                                $query="SELECT * FROM `coupons` WHERE `vendor_id`='$uid' ";
                                                $result=mysqli_query($con,$query);
                                                $num_rows = mysqli_num_rows($result);
                                                {
                                                    echo htmlentities($num_rows); 
                                                } 
                                                if($num_rows >1){
                                                    echo ' Codes';
                                                }else{
                                                echo ' Code';
                                                }
                                                ?> 	</h6>
              </div>


              <!-- Container-fluid starts-->
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h4>Generated Codes</h4>
              </div>
              <div class="table-responsive custom-scrollbar">
              <?php 
                    $query="SELECT * FROM `coupons` WHERE `vendor_id`='$uid' ORDER BY `id` DESC ";
                    $result=mysqli_query($con,$query);
                    $cnt=1;
                    if(mysqli_num_rows($result)>0){                
             ?>
                <table class="table">
                  <thead>
                    <tr class="border-bottom-primary">
                      <th scope="col">SN</th>
                      <th scope="col">Code</th>
                      <th scope="col">Amount</th>
                      <th scope="col">Status</th>
                      <th scope="col">Time Generated</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
            while($row=mysqli_fetch_array($result)){
                $ipaddress = $row['userip'];
                $status =$row['status'];

                $date_string=$row['created_at'];// date retrieved from database
                $timestamp = strtotime($date_string); // convert date string to Unix timestamp
                $date = date("jS \of F Y,g:ia", $timestamp);// format timestamp into words   
            ?>
                <tr class="border-bottom-primary">
                    <td scope="row"><?php echo $cnt++;?></td>
                    <td><?php echo htmlentities($row['coupon_code']);?></td>
                    <td>&#8358;<?php echo number_format($row['amount']);?></td>
                    <td>  <?php
                    if($status == "0") {
                    ?>
                    <div class="nk-block-actions flex-shrink-0">
                        <a href="#" class="btn btn-success">Active</a>
                    </div>
                    <?php }else{ ?>
                   <div class="nk-block-actions flex-shrink-0">
                        <a href="#" class="btn btn-danger">Used</a>
                    </div>
                    <?php } ?>
                </td>
                <td><?php echo htmlentities($date);?></td>
                </tr>
                    <?php } 
                }else{

                  echo"
                  <div class='nk-block-des' style='text-align:center;margin-top:20px;margin-bottom:50px;'>
                  <h4>Oops!</h4>
                  <p>You have not generated any code yet.
              </div>
                 
                  ";
                }
                ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>




                            

            <div class="modal fade" role="dialog" id="profile-edit">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content"><a href="#" class="close" data-bs-dismiss="modal"><i class="icon fa fa-times"></i></a>
				<div class="modal-body modal-body-lg">
					<h5 class="title">Generate Code</h5>
					
					<div class="tab-content">
						<div class="tab-pane active" id="personal">
							<div class="row gy-4">

								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label" for="full-name"></label>
										<input type="text" class="form-control form-control-lg" id="full-name" value="" placeholder="">
									</div>
								</div>
							
                                <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">Generate Code</button>
                               </div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>


    <script src="js/coupon-script.js"></script>
<?php include 'includes/footer.php' ?>
