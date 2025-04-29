<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
$title="Admins";

      //Make user a vendor
      if(isset($_GET['activate']))
		  {
        $sql1="UPDATE `users` SET `is_salary_earner`='1' WHERE `id`='".$_GET['id']."' ";
        $result1=mysqli_query($con,$sql1);
		  }
       

?>
<div class="container-fluid py-4">

           

                  <div class="card" style="padding:30px;">
                  <h5 class="card-header">All Pending Salary Earners</h5>
                  <div class="table-responsive table-wrapper-top text-nowrap" >
                  <p style="padding-left:10vw;color:#cb0c9f;"><?php if($msg) { echo htmlentities($msg);}?> </h5>

                  <table class="table table-bordered" id="dataTables-example" >
                    <thead>
                      <tr class="text-nowrap">
                        <th>SN</th>
                        <th>Username</th>
                        <th>Fullname</th>
                        <th>Phone Number</th>
                        <th>Action</th>

                      </tr>
                    </thead>    
                    <tbody>
                    <?php 
                $query = "SELECT u.id, u.username, u.fullname, u.phone, 
                        (SELECT COUNT(*) FROM users WHERE referred_by = u.username) AS referral_count
                FROM users u
                WHERE u.is_salary_earner = '0'
                HAVING referral_count >= 100
                ORDER BY referral_count DESC
                LIMIT 20";
                    $result=mysqli_query($con,$query);
                    $cnt=1;
                    if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                    ?>
                    <tr>
                    <td><?php echo $cnt++;?></td>
                    <td><?php echo htmlentities($row['username']);?> </td>
                    <td><?php echo htmlentities($row['fullname']);?></td>
                    <td><?php echo htmlentities($row['phone']);?></td>
                     <td>
                     <a href="?id=<?php echo $row['id'];?>&activate=salary" 
                               onClick="return confirm('Are you sure you want to make this user a salary earner?')" class="btn btn-success ">
                               Activate
                            </a>
                        </td>
                     
                        
                         
                      </tr>
                    <?php } 
                    }else{
                      echo"No Record Found!";
                  }
                  ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div style="margin-left:10vw;height:30vh;"></div>



<?php include('include/footer.php');?>