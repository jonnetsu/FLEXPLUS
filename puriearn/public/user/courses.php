<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('includes/checklogin.php');
include 'includes/functions.php';

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

$referral_balance=$row['ref_bonus'];
$lastSpin=$row['lastSpin'];

?>

 <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12">
                  <h4>Courses</h4>
                  <p style="padding-top:5px;">Hi there here are the list of available courses</p>
                </div>
               
              </div>
            </div>
          </div>
                    
          <div class="container-fluid">
                <div class="row"> 
                        <?php 
                        $query="SELECT * FROM `digital_courses` ORDER BY `id` DESC ";
                        $result=mysqli_query($con,$query);
                        $cnt=1;
                        if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_array($result)){
                        $type=$row['type'];

                        $date_string=$row['creationDate'];// date retrieved from database
                        $timestamp = strtotime($date_string); // convert date string to Unix timestamp
                        $date = date("jS \ F, Y ", $timestamp);// format timestamp into words
                        $profile_pic=$row['user_picture'];
                        ?>
                        <div class="col-xl-4 col-sm-6 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                        <div class=" d-sm-block" 
                                            style="display:flex;align-items:center;justify-content:center;">
                                                <img src="../admin/<?php echo $row['image_filepath'];?>" alt="img"  class="img-fluid"
                                                 style="width:100%" 
                                                >
                                                </div>
												<div class="user-message  py-2">
													<h6 class="message mb-1 mt-1" 
                                                    style="overflow: hidden; text-overflow: ellipsis;line-height:20px;font-size:13px;
                                                     display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                                    <?php echo htmlentities($row['book_name']);?> 
                                                    </h6>
													<div class="d-flex align-items-center justify-content-between">
                                                        <p class="message-footer">
                                                            Price:
                                                        </p>
                                                        <p class="message-footer" style="font-weight:600;">
                                                        <?php 
                                            if($type =="1"){
                                                ?>
                                            <span class="color:red !important;">Free</span>
                                                <?php
                                            }else{
                                            
                                                ?>
                                               &#8358;<?php echo number_format($row['amount']);?>
                                                    
                                                    <?php
                                                        }
                                                    ?>    
                                                           
                                                        </p>
                                                    </div>
                                                    <a href="get-course.php?cid=<?php echo $row['id'];?>" 
                                                        class="badge bg-primary" style="width:100%;padding:10px;">
                                                        View Course
                                                    </a>

												</div>

                                                
                                    
                                        </div>
                                    </div>
                                </div>

                    <?php } 
								}else{
								echo"
								<div class='nk-block-des' style='text-align:center;margin-top:20vh;'>
                                    <h4>Oops!</h4>
                                    <p>No course available at the moment. Please check again later</p>
							   </div>";
                    }
                    ?>
                </div>
          </div>


			</div>

<?php include 'includes/footer.php' ?>