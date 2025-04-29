<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
$title="Pending Services";
?>
<div class="container-fluid py-4">
           
                <div class="card" style="padding:30px;">
                <h5 class="card-header">Pending Services</h5>
                <div class="table-responsive table-wrapper-top text-nowrap" >
                <p style="padding-left:10vw;color:#cb0c9f;"><?php if($msg) { echo htmlentities($msg);}?> </h5>

                  <table class="table table-bordered" id="dataTables-example" >
                    <thead>
                      <tr class="text-nowrap">
                        <th>SN</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>    
                  <tbody>
                  <?php 
                  $query="SELECT * FROM `transactions` WHERE `status`='Confirmed' AND `type`='Withdrawal' ";
                  $result=mysqli_query($con,$query);
                  $cnt=1;
                  if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                        $amount=number_format($row['amount']);
                        $status=$row['status'];
                      ?>
                    <tr>
                      <td><?php echo $cnt++;?></td>
                      <td>&#8358;<?php echo $amount;?></td>
                      <td>
                      <?php if($status == 'Pending'){?> 
                        <span class="badge bg-label-warning me-1 add-to-cart-button"><?php echo $status?></span>
                        <?php }else{?>
                            <span class="badge bg-label-success me-1 add-to-cart-button"><?php echo $status?></span>
                      <?php }?>
                      </td>
                      <td><?php echo htmlentities($row['created_at']);?>  </td>
                      <td class="align-middle">
                      <a href="update-withdrawal-request.php?wid=<?php echo $row['id'];?>&&uid=<?php echo $row['user_id'];?>" class="btn btn-primary me-1 add-to-cart-button" >Update</a> 
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