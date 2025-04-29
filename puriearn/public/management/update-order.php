<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
$title="Update Progress";

$title="Update Progress";
$trx_id=($_GET['id']);


if(isset($_POST['submit']))
{
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);


$sql=mysqli_query($con,"UPDATE received_payment set
status='$status' WHERE trx_id='$trx_id' ");

if($sql)
{

    $msg="Status Updated Successfully !!";
    $type = "success";

}else{

  $msg="Something went wrong,please try again";
  $type ="warning";
 
}

}
?>

<?php include('include/header.php');?>
		
<?php include('include/sidebar.php');?>

<div class="container-fluid py-4">

<div class="card" style="padding:30px;">
                <h5 class="card-header">Pending Orders</h5>
                <div class="table-responsive table-wrapper-top text-nowrap" >
                <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
            <?php 
                 $query="SELECT * FROM `received_payment` WHERE `trx_id`='$trx_id'  ";
                 $result=mysqli_query($con,$query);
                      $cnt=+1;
                      while($row=mysqli_fetch_array($result))
                      {
                      ?>

<p style="text-align:center;font-weight:bold;text-transform:uppercase;">
Current Status: <?php echo htmlentities($row['status']);?></p> 

<?php }?>
<div class="form-group text-box" >
			
<form role="form" name="" method="post">
<select name="status" class="form-control">
    <div class="form-group">
								<option value="">Select Status</option>
								<option value="In Progress">In Progress</option>
								<option value="Dispatched">Dispatched</option>
								<option value="Delivered">Delivered</option>
							</select>
                      </div>
                     
    <div style="margin-left:0vw;margin-top:30px;">
                        <button type="submit" 
                        class="btn bg-label-primary me-1 add-to-cart-button" name="submit" >
                       Update Order Status
                        </button>
                      </div>                
                        </form>

              </div>
            </div>
          </div>
        </div>
      </div>
<div style="height:300px;"></div>



<?php include('include/footer.php');?>
