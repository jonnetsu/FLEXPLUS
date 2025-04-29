<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
$title="Posts";

$gid=intval($_GET['id']);

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"DELETE FROM `withdrawal_portals` WHERE `id` = '".$_GET['id']."'");
                  echo "<script>window.location.href='all-gift-boxes.php';</script>";

		  }
      //Make user a vendor
      if(isset($_GET['make']))
		  {
        $sql1="UPDATE `withdrawal_portals` SET `status`='1' WHERE `id`='".$_GET['id']."' ";
        $result1=mysqli_query($con,$sql1);
		  }
       //Remove user's a vendor status
       if(isset($_GET['remove']))
       {
         $sql1="UPDATE `withdrawal_portals` SET `status`='0' WHERE `id`='".$_GET['id']."' ";
         $result1=mysqli_query($con,$sql1);
       }
?>

<div class="container-fluid py-4">

           

                  <div class="card" style="padding:30px;">
                  <h5 class="card-header">Gift Box Winners</h5>
                  <div class="table-responsive table-wrapper-top text-nowrap" >
                  <p style="padding-left:10vw;color:#cb0c9f;"><?php if($msg) { echo htmlentities($msg);}?> </h5>

                  <table class="table table-bordered" id="dataTables-example" >
                    <thead>
                      <tr class="text-nowrap">
                        <th>SN</th>
                        <th>Username</th>
                        <th>Fullname</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                    </thead>    
                    <tbody>
                    <?php 
                  $query="SELECT winners.id, winners.gift_id, winners.username, winners.status, winners.created_at, users.id, users.fullname, users.phone, users.email
                  FROM winners
                  JOIN users ON winners.username = users.username
                  WHERE winners.gift_id = '$gid' ";
                  $result=mysqli_query($con,$query);
                  $cnt=1;
                  if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                      ?>
                    <tr>
                    <td><?php echo $cnt++;?></td>
                    <td><?php echo htmlentities($row['username']);?> </td>
                    <td><?php echo htmlentities($row['fullname']);?></td>
                    <td><?php echo htmlentities($row['email']);?></td>
                    <td><?php echo htmlentities($row['phone']);?></td>
                    <td class="align-middle">
                        <a href="?id=<?php echo $row['id'];?>&del=delete" 
                        onClick="return confirm('Are you sure you want to delete Gift Box?')" class="btn btn-danger deactivate-account">
                        Delete </a>
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
                     
<?php include('include/footer.php');?>
