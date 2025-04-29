<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
$title="Order Details";
$trx_id=($_GET['id']);

?>

<?php include('include/header.php');?>
		
<?php include('include/sidebar.php');?>
<div class="container-fluid py-4">

           

                  <div class="card" style="padding:30px;">
                <h5 class="card-header">Order Items</h5>
                <div class="table-responsive table-wrapper-top text-nowrap" >
                <p style="padding-left:10vw;color:#cb0c9f;"><?php if($msg) { echo htmlentities($msg);}?> </h5>

                <table class="table align-items-center mb-0" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>Qty</th>
                      <th >Drink</th>
                      <th>Price</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $query="SELECT * FROM customer_order WHERE trx_id='$trx_id'";
                  $result=mysqli_query($con,$query);
                  $cnt=1;
                  if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                      ?>
					<tr>
						<td><?php echo htmlentities($row['p_qty']);?></td>
						<td><?php echo htmlentities($row['p_name']);?> </td>
						<td>&#8358;<?php echo htmlentities($row['p_price']);?></td>
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




<?php include('include/footer.php');?>
