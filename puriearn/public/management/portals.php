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
      if(isset($_GET['open']))
		  {
        $sql1="UPDATE `withdrawal_portals` SET `status`='1' WHERE `id`='".$_GET['id']."' ";
        $result1=mysqli_query($con,$sql1);
		  }
       //Remove user's a vendor status
       if(isset($_GET['close']))
       {
         $sql1="UPDATE `withdrawal_portals` SET `status`='0' WHERE `id`='".$_GET['id']."' ";
         $result1=mysqli_query($con,$sql1);
       }

?>
<div class="container-fluid py-4">

           

                  <div class="card" style="padding:30px;">
                  <h5 class="card-header">Portals</h5>
                  <div class="table-responsive table-wrapper-top text-nowrap" >
                  <p style="padding-left:10vw;color:#cb0c9f;"><?php if($msg) { echo htmlentities($msg);}?> </h5>

                  <table class="table table-bordered" id="dataTables-example" >
                    <thead>
                      <tr class="text-nowrap">
                        <th>SN</th>
                        <th>Portal</th>
                        <th>Action</th>
                      </tr>
                    </thead>    
                    <tbody>
                    <?php 
                    $query="SELECT * FROM `withdrawal_portals` ";
                    $result=mysqli_query($con,$query);
                    $cnt=1;
                    if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                    ?>
                    <tr>
                    <td><?php echo $cnt++;?></td>
                    <td><?php echo htmlentities($row['portal_name']);?> </td>
                
                     
                      <td class="align-middle">
                        <?php 
                        if($row['status']== '1'){ ?>
                            <a href="?id=<?php echo $row['id'];?>&close=portal" 
                               onClick="return confirm('Are you sure you want to close Portal?')" class="btn btn-danger ">
                             Close Portal
                            </a>
                        <?php }else{ ?>
                          <a href="?id=<?php echo $row['id'];?>&open=portal" 
                               onClick="return confirm('Are you sure you want to open portal?')" class="btn btn-primary deactivate-account">
                            Open Portal</a>
                        <?php } ?>
                       
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