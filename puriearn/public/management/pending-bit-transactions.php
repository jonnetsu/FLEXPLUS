<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
$title="Pending Services";
$currentTime = date( 'd-m-Y h:i:s A', time ());

if(isset($_GET['cancel']))
		  {
        $trans_id=$_GET['wid'];
          
        $sql = "UPDATE `bitvortex_transactions` set `status`='Cancelled',updationDate='$currentTime'
        WHERE `id`='$trans_id' ";	
         $res = mysqli_query($con, $sql);
           if($res){

               $msg="Transaction Cancelled Successfully!";
               $type = "success";
               echo "<script>window.location.href='pending-bit-transactions.php';</script>";
           }else{
               $msg="Failed to Cancel Withdrawal";
               $type = "warning";
               echo "<script>window.location.href='pending-bit-transactions.php';</script>";
           }

		  }


          if(isset($_GET['confirm']))
		  {
        $trans_id=$_GET['wid'];
          
        $sql = "UPDATE `bitvortex_transactions` set `status`='Confirmed',updationDate='$currentTime'
        WHERE `id`='$trans_id' ";	
         $res = mysqli_query($con, $sql);
           if($res){

               $msg="Transaction Confirmed Successfully!";
               $type = "success";
               echo "<script>window.location.href='pending-bit-transactions.php';</script>";
           }else{
               $msg="Failed to Cancel Withdrawal";
               $type = "warning";
               echo "<script>window.location.href='pending-bit-transactions.php';</script>";
           }

		  }

?>
        <div class="container-fluid py-4">
                  <div class="card" style="padding:30px;">
                    <h5 class="card-header">Pending Transactions</h5>  
                 <div>
                 <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
            <form method="post" action="">
                <button type="submit" name="updateButton" id="updateButton" class="btn btn-primary mb-3" style="display: none;">Confirm Payment</button>
            </div>
                <div class="table-responsive table-wrapper-top text-nowrap" >
                  <table class="table table-bordered" id="dataTables-example" >
                    <thead>
                      <tr class="text-nowrap">
                        <th>SN</th>
                        <th>BTV Amount</th>
                        <th>BNB Amount</th>
                        <th>User Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>    
                  <tbody>
                  <?php 
                  $query="SELECT * FROM `bitvortex_transactions` WHERE `status`='Pending' ORDER BY id DESC ";
                  $result=mysqli_query($con,$query);
                  $cnt=1;
                  if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                        $btv=number_format($row['btvAmount']);
                        $bnb=$row['bnbAmount'];
                        $address=$row['userAddress'];
                      ?>
                    <tr>
                   
                      <td><?php echo $cnt++;?></td>
                      <td>
                      <?php echo $btv;?>
                     </td>
                      <td>&#8358;<?php echo $bnb;?></td>
                      <td><?php echo $address; ?>  </td>
                      <td class="align-middle">
                      <a href="?confirm=true&&wid=<?php echo $row['id'];?>" class="btn btn-primary me-1 add-to-cart-button" >Confirm</a> 
                      <a href="?cancel=true&&wid=<?php echo $row['id'];?>" 
                      onClick="return confirm('Are you sure you want cancel this transactions?')" class="btn btn-warning me-1 add-to-cart-button" >Cancel</a> 

                    </td>
                      
                    </tr>
                    
                    <?php } 
                    }else{

                      echo"No Record Found!";
                    }
                    ?>
                               
                  </tbody>
                </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div style="margin-left:10vw;height:30vh;"></div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery library -->

<script>
$(document).ready(function() {
  $('input[name="selectedRows[]"]').change(function() {
    if ($('input[name="selectedRows[]"]:checked').length > 0) {
      $('#updateButton, #deleteButton').show(); // Show both buttons when checkboxes are selected
    } else {
      $('#updateButton, #deleteButton').hide(); // Hide both buttons when no checkboxes are selected
    }
  });
});
</script>


<?php include('include/footer.php');?>
