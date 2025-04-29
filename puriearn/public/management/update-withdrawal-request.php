<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
$title="Update Order";
$currentTime = date( 'd-m-Y h:i:s A', time () );

$uid=intval($_GET['uid']);// users's id
$amount=$_GET['amount'];


$sql = "SELECT * FROM `users` WHERE `id`=$uid";
$res = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($res);
$username=$user['username'];
$fullname=$user['fullname'];
$bank_name=$user['bank_name'];
$account_name=$user['account_name'];
$account_number=$user['account_number'];
$status=$user['status'];

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"DELETE FROM `transactions` WHERE `id` = '".$_GET['id']."'");
                  echo "<script>window.location.href='pending-withdrawals.php';</script>";

		  }

if(isset($_GET) & !empty($_GET)){
	$wid=intval($_GET['wid']);// farmer's id
}else{
		echo "<script>window.location.href='pending-mechanization-requests.php';</script>";
	}

	if(isset($_POST) & !empty($_POST)){
        $status = mysqli_real_escape_string($con, $_POST['status']);
		
			
		$sql = "UPDATE `transactions` set `status`='$status',updationDate='$currentTime'
         WHERE `id`='$wid' ";	
			$res = mysqli_query($con, $sql);
            if($res){
                $msg="Withdrawal Status Updated Successfully!";
                $type = "success";
            }else{
                $msg="Failed to Update Request Status";
                $type = "warning";
            }
}
	?>
<?php include('include/header.php');?>
		
<?php include('include/sidebar.php');?>

<style>
  .v-badge{
		width:20px;
	}
</style>
  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Payout/</span> Pending Requests</h4>

<?php 
          $query="SELECT * FROM `transactions` WHERE `id`='$wid' ";
          $result=mysqli_query($con,$query);
          while($row=mysqli_fetch_array($result))
          {
        $updation_date = $row['updationDate'];
        $updation_date = date('l jS F Y \a\t g:ia');
    ?>
 
               <div class="card mb-4">
                    <h5 class="card-header">Update Request</h5>
                   
                    <!-- Account -->
                    <div class="card-body">
                    <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                     
                      <div class="button-wrapper">
                       <?php 
                if(isset($row['updationDate'])) {
                ?>
             <p class="text-muted mb-0">Last Updated On <?php echo $updation_date;?></p>
                <?php   }?>     
                      </div>   
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                    <form  method="post" enctype="multipart/form-data">
                        <div class="row">
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Status </label>        
                        <select  name="status" class="select2 form-select">
                       <?php 
                        $query2="SELECT * FROM `transactions` WHERE id='$wid' ";
                        $result2=mysqli_query($con,$query2);
                        while($row2=mysqli_fetch_array($result2))
                        {?>
<option value="<?php echo $row2['status']; ?>" <?php if( $row['status'] == $data['status']){ echo "selected"; } ?>><?php echo $row2['status']; ?></option>
<?php } ?>
                              <option value="Pending">Pending</option>
                              <option value="Confirmed">Confirmed</option>
                            </select>
                      </div> 
                        </div>
                        <div class="mt-2">
                          <input type="submit" class="btn btn-primary me-2" type="submit" name="submit" value="Save changes">
                        </div>
                      </form>
                    </div>

                    <h5 class="card-header">Payment Details for - <?php 
													 if($status == 1){
														echo "<img src='assets/img/badge.png' class='v-badge'>";
													 }
													 ?> <?php echo $username;?></h5>
                    <hr class="my-0" />

                    <div class="payment-details-wrapper mt-3" style="margin-left:2%">
  <h6>Amount: &#8358;<?php echo $amount;?> </h6>
  <h6>Bank: <?php echo $bank_name;?> </h6>
  <h6>Account Holder Name: <?php echo $account_name;?> </h6>

  <div class="mb-5" style="width:300px;">
    <h6>Account Number: <span id="accountNumber"><?php echo $account_number;?></span></h6>
    <button onclick="copyToClipboardTwo('accountNumber')" class="badge bg-label-success me-1 add-to-cart-button">Copy<i class="fa fa-copy"></i></button>
  
    <a href="withdrawal-history-user.php?uid=<?php echo $uid;?>" 
                        class="btn btn-primary deactivate-account">Withdrawal History</a>
  </div>
</div>


                    <!-- /Account -->
                  </div>
                  <div class="card">
                    <h5 class="card-header">Delete Request</h5>
                    <div class="card-body">
                      <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                          <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete request?</h6>
                          <p class="mb-0">Once you delete this request, there is no going back. Please be certain.</p>
                        </div>
                      </div>
                       
                        <a href="?id=<?php echo $row['id'];?>&del=delete" 
                        onClick="return confirm('Are you sure you want to delete this withdrawal request?')" class="btn btn-danger deactivate-account">
                        Delete Request</a>
                    </div>
                  </div>
                </div>

</div></div>

                <?php }?>
              </div>
            </div>
            <!-- / Content -->

            <script>
             function copyToClipboardTwo(elementId) {
  /* Get the text content of the element */
  const text = document.getElementById(elementId).innerText;

  /* Format the copied details */
  const formattedText = "Amount: ₦<?php echo number_format($amount); ?>\n" +
    "Bank: <?php echo $bank_name; ?>\n" +
    "Account Holder Name: <?php echo $account_name; ?>\n" +
    "Account Number: " + text;

  /* Create a temporary textarea element */
  const textareaElement = document.createElement('textarea');
  textareaElement.value = formattedText;
  document.body.appendChild(textareaElement);

  /* Select the text content of the textarea element */
  textareaElement.select();
  textareaElement.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text to the clipboard */
  document.execCommand('copy');

  /* Remove the temporary textarea element */
  document.body.removeChild(textareaElement);

  /* Show a notification or perform any other action */
  alert('Copied to clipboard:\n' + formattedText);
}

</script>



            <script>
  function copyToClipboard(button) {
    /* Get the text from the account number element */
    var accountNumber = document.getElementById("accountNumber");
    var text = accountNumber.innerText;

    /* Create a temporary input element and set its value to the text */
    var tempInput = document.createElement("input");
    tempInput.setAttribute("value", text);
    document.body.appendChild(tempInput);

    /* Select the text within the input element */
    tempInput.select();
    tempInput.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text to the clipboard */
    document.execCommand("copy");

    /* Remove the temporary input element */
    document.body.removeChild(tempInput);

    /* Add the "copied" highlight to the clicked button */
    button.classList.add("copied");
    button.innerText = "Copied!";

    /* Remove the "copied" highlight from other buttons */
    var allButtons = document.querySelectorAll("button");
    for (var i = 0; i < allButtons.length; i++) {
      if (allButtons[i] !== button) {
        allButtons[i].classList.remove("copied");
        allButtons[i].innerText = "Copy";
      }
    }
  }
</script>

<style>
  .copied {
    background-color: yellow;
    color: black;
  }
</style>


<?php include('include/footer.php');?>
