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
		          mysqli_query($con,"DELETE FROM `admin` WHERE `id` = '".$_GET['id']."'");
                  echo "<script>window.location.href='admins.php';</script>";

		  }

?>
        <div class="container-fluid py-4">
          <div class="card" style="padding:30px;">
            <div class="table-responsive table-wrapper-top text-nowrap" >
              <div class="button-wrapper">
                <a class="btn btn-primary me-2 mb-4"
                         href="add-admin.php" 
					      > 
                         <span class="d-none d-sm-block">Add New Admin </span>
                            <i class="bx bx-user d-block d-sm-none"></i>
                </a> 
              </div>
                <p style="padding-left:10vw;color:#cb0c9f;"><?php if($msg) { echo htmlentities($msg);}?> </h5>

                  <table class="table table-bordered" id="dataTables-example" >
                    <thead>
                      <tr class="text-nowrap">
                        <th>SN</th>
                        <th>Fullname</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Location</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                      </tr>
                    </thead>    
                  <tbody>
                  <?php 
                    $query="SELECT * FROM `admin` WHERE username !='devp' ";
                    $result=mysqli_query($con,$query);
                    $cnt=1;
                    if(mysqli_num_rows($result)>0){
                      while($row=mysqli_fetch_array($result)){
                      ?>
                    <tr>
                    <td><?php echo $cnt++;?></td>
                    <td><?php echo htmlentities($row['fullname']);?>  </td>
                    <td><?php echo htmlentities($row['username']);?></td>
                      <td><?php echo htmlentities($row['email']);?></td>
                      <td><?php echo htmlentities($row['location']);?></td>
                      <td><?php echo htmlentities($row['phone']);?></td>
                      <td class="align-middle">
                      <a href="?id=<?php echo $row['id'];?>&del=delete" 
                        onClick="return confirm('Are you sure you want to delete admin?')" class="btn btn-danger deactivate-account">
                      Delete</a>
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
