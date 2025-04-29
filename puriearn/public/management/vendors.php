<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
$title="Admins";

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"DELETE FROM `users` WHERE `id` = '".$_GET['id']."'");
                  echo "<script>window.location.href='users.php';</script>";

		  }
      //Make user a vendor
      if(isset($_GET['make']))
		  {
        $sql1="UPDATE `users` SET `is_vendor`='1' WHERE `id`='".$_GET['id']."' ";
        $result1=mysqli_query($con,$sql1);
		  }
       //Remove user's a vendor status
       if(isset($_GET['remove']))
       {
         $sql1="UPDATE `users` SET `is_vendor`='0' WHERE `id`='".$_GET['id']."' ";
         $result1=mysqli_query($con,$sql1);
       }

        //Make user a publisher
      if(isset($_GET['makep']))
		  {
        $sql1="UPDATE `users` SET `is_publisher`='1' WHERE `id`='".$_GET['id']."' ";
        $result1=mysqli_query($con,$sql1);
		  }
       //Remove user's a vendor status
       if(isset($_GET['removep']))
       {
         $sql1="UPDATE `users` SET `is_publisher`='0' WHERE `id`='".$_GET['id']."' ";
         $result1=mysqli_query($con,$sql1);
       }

?>
<div class="container-fluid py-4">

           

                  <div class="card" style="padding:30px;">
                  <h5 class="card-header">All Users</h5>
                  <div class="table-responsive table-wrapper-top text-nowrap" >
                  <p style="padding-left:10vw;color:#cb0c9f;"><?php if($msg) { echo htmlentities($msg);}?> </h5>

                  <table class="table table-bordered" id="dataTables-example" >
                    <thead>
                      <tr class="text-nowrap">
                        <th>SN</th>
                        <th>Username</th>
                        <th>Fullname</th>
                        <th>Coupon Account Balance</th>
                        <th>Vendor</th>
                        <th>Fund</th>
                        <th>Action</th>

                      </tr>
                    </thead>    
                    <tbody>
                    <?php 
                    $query="SELECT * FROM `users` WHERE `is_vendor`= '1' ";
                    $result=mysqli_query($con,$query);
                    $cnt=1;
                    if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                    ?>
                    <tr>
                    <td><?php echo $cnt++;?></td>
                    <td><?php echo htmlentities($row['username']);?> </td>
                    <td><?php echo htmlentities($row['fullname']);?></td>
                    <td> ₦<?php echo htmlentities($row['coupon_account_bal']);?></td>
                     <td>
                     <?php 
                        if($row['is_vendor']== '1'){ ?>
                            <a href="?id=<?php echo $row['id'];?>&remove=vendor" 
                               onClick="return confirm('Are you sure you want to remove this user from your vendors?')" class="btn btn-danger ">
                              <i class="fa fa-remove"></i>
                            </a>
                        <?php }else{ ?>
                          <a href="?id=<?php echo $row['id'];?>&make=vendor" 
                               onClick="return confirm('Are you sure you want to make this user a vendor?')" class="btn btn-primary deactivate-account">
                             <i class="fa fa-plus"></i></a>
                        <?php } ?>
                        </td>                       
                        <td>
                        <a class="btn btn-primary deactivate-account" href="fund-vendor.php?uid=<?php echo $row['id']; ?>"><i class="fa fa-add"></i>Fund</a> 
                        </td>
                         <td>  
                         <a class="btn btn-primary deactivate-account" href="user-details.php?uid=<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></a> 
                        <a href="?id=<?php echo $row['id'];?>&del=delete" 
                        onClick="return confirm('Are you sure you want to delete user?')" class="btn btn-danger deactivate-account">
                        <i class="fa fa-trash"></i></a>
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