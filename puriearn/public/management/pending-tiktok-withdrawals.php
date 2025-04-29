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
        $uid=$_GET['uid'];
        $account=$_GET['atype'];
        $amount=$_GET['amount'];
        $trans_id=$_GET['wid'];

        if ($account == 'Tiktok') {
          $account_table_name = 'tiktok_balance';
        } elseif($account == 'Job') {
          $account_table_name = 'job_balance';
        }else{
          $account_table_name = 'ref_bonus';
        }
      
        $sql = "UPDATE `transactions` set `status`='Cancelled',updationDate='$currentTime'
        WHERE `id`='$trans_id' ";	
     $res = mysqli_query($con, $sql);
           if($res){

            $updateQuery = "UPDATE `users` SET `$account_table_name`=$account_table_name+$amount WHERE `id`='$uid'";
            $result2 = mysqli_query($con, $updateQuery);

               $msg="Withdrawal Cancelled Successfully!";
               $type = "success";
           }else{
               $msg="Failed to Cancel Withdrawal";
               $type = "warning";
           }


		  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["selectedRows"])) {
    $selectedRows = $_POST["selectedRows"];
    if (isset($_POST["updateButton"])) {
      // Update button was clicked
      foreach ($selectedRows as $rowId) {
        $sql = "UPDATE `transactions` set `status`='Confirmed',updationDate='$currentTime'
        WHERE `id`='$rowId' ";	
           $res = mysqli_query($con, $sql);
           if($res){
               $msg="Withdrawal Status Updated Successfully!";
               $type = "success";
           }else{
               $msg="Failed to Update Request Status";
               $type = "warning";
           }
      }
    } elseif (isset($_POST["deleteButton"])) {
      // Delete button was clicked
      foreach ($selectedRows as $rowId) {
        $sql = "DELETE FROM `transactions` WHERE `id`='$rowId' ";	
           $res = mysqli_query($con, $sql);
           if($res){
            $msg="Withdrawal Requests Deleted Successfully!";
            $type = "success";
        }else{
            $msg="Failed to Delete Items";
            $type = "warning";
        }
      }
    }
  }
}


?>
        <div class="container-fluid py-4">
                  <div class="card" style="padding:30px;">
                    <h5 class="card-header">Pending Tiktok Withdrawals</h5>  
                 <div>
                 <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
            <form method="post" action="">
                <button type="submit" name="updateButton" id="updateButton" class="btn btn-primary mb-3" style="display: none;">Confirm Payment</button>
                <button type="submit" name="deleteButton" id="deleteButton" class="btn btn-danger mb-3" style="display: none;">Delete</button>
            </div>
                <div class="table-responsive table-wrapper-top text-nowrap" >
                  <table class="table table-bordered" id="dataTables-example" >
                    <thead>
                      <tr class="text-nowrap">
                        <th style="width:1px;"></th>
                        <th>SN</th>
                        <th>Username</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>    
                  <tbody>
                  <?php 
                  $query="SELECT * FROM `transactions` WHERE `status`='Pending' AND `type`='Withdrawal' AND `account_type`='Tiktok' ";
                  $result=mysqli_query($con,$query);
                  $cnt=1;
                  if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                        $amount=number_format($row['amount']);
                        $userId=$row['user_id'];
                      ?>
                    <tr>
                    <td class="align-middle">
                      <input type="checkbox" name="selectedRows[]" value="<?php echo $row['id']; ?>">
                    </td>
                      <td><?php echo $cnt++;?></td>
                      <td>
                      <?php $query2=mysqli_query($con,"SELECT * FROM users WHERE id='$userId' ");
                        while($r=mysqli_fetch_array($query2))
                        {?>
                           <?php echo $r['username']; ?>
                        <?php } ?>
                     </td>
                      <td>&#8358;<?php echo $amount;?></td>
                      <td><?php echo htmlentities($row['created_at']);?>  </td>
                      <td class="align-middle">
                      <a href="update-withdrawal-request.php?wid=<?php echo $row['id'];?>&&uid=<?php echo $row['user_id'];?>&&amount=<?php echo $row['amount'];?>" class="btn btn-primary me-1 add-to-cart-button" >Make Payment</a> 
                      <a href="?cancel=true&&wid=<?php echo $row['id'];?>&&uid=<?php echo $row['user_id'];?>&&amount=<?php echo $row['amount'];?>&&atype=<?php echo $row['account_type'];?>" 
                      onClick="return confirm('Are you sure you want cancel this withdrawal?')" class="btn btn-warning me-1 add-to-cart-button" >Cancel</a> 

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
