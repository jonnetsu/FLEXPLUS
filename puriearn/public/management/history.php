<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
$title="Admins";


if(isset($_GET) & !empty($_GET)){
	$uid=intval($_GET['uid']);// get post id
}else{
		echo "<script>window.location.href='dashboard.php';</script>";
	}

	$uid=intval($_GET['uid']);


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
                        <th>Amount</th>
                        <th>Status</th>
                      </tr>
                    </thead>    
                    <tbody>
                    <?php 
                    $query="SELECT * FROM `transactions` WHERE `user_id` = '$uid' ";
                    $result=mysqli_query($con,$query);
                    $cnt=1;
                    if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                    ?>
                    <tr>
                    <td><?php echo $cnt++;?></td>
                    <td>₦<?php echo htmlentities($row['amount']);?> </td>
                
                     
                      <td class="align-middle">
                        <?php 
                        if($row['status']== 'Pending'){ ?>
                            <span class="btn btn-warning">
                            Pending
                            </a>
                        <?php }elseif($row['status']== 'Confirmed'){ ?>
                            <span class="btn btn-success">
                            Confirmed</a>
                        <?php }else{ ?>
                            <span class="btn btn-danger">
                            Cancelled</a>

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