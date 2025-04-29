<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
$title="Pending Payments";
?>

<?php include('include/header.php');?>
		
<?php include('include/sidebar.php');?>

<div class="container-fluid py-4">

<div class="card" style="padding:30px;">
                <h5 class="card-header">Pending Orders</h5>
                <div class="table-responsive table-wrapper-top text-nowrap" >
                <p style="padding-left:10vw;color:#cb0c9f;"><?php if($msg) { echo htmlentities($msg);}?> </h5>
              <table class="table table-bordered" id="dataTables-example" >
                  <thead>
                    <tr>
                      <th>SN</th>
                      <th>Order ID</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Order Details</th>
                      <th></th>

                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                        $query="SELECT * FROM  `received_payment` WHERE status!='Delivered' ";
                        $result=mysqli_query($con,$query);
                        $cnt=1;
                        if(mysqli_num_rows($result)>0){
                          while($row=mysqli_fetch_array($result)){
                  ?>    
                    <tr>
                      <td>
                      <td><?php echo $cnt++;?></td>
                        <div class="d-flex px-2 py-1">
                         
                          <div class="d-flex flex-column justify-content-center">
                          <p class="text-xs font-weight-bold mb-0"><?php echo htmlentities($row['trx_id']);?></p>
                     
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">&#8358;<?php echo htmlentities($row['amount']);?></p>
                      </td>
                      <td>
                      <p class="badge badge-sm bg-gradient-danger"><?php echo htmlentities($row['status']);?></p>
                      </td>
                    <td>
           <p class="text-xs font-weight-bold mb-0"><?php echo htmlentities($row['date']);?></p>
                      </td>
                      <td class="align-middle">
                      <a href="order-details.php?id=<?php echo $row['trx_id'];?>" 
                      class="badge bg-label-primary me-1 add-to-cart-button" >View Details</a>

                      
                      </td>
                      <td class="align-middle">
                      <a href="update-order.php?id=<?php echo $row['trx_id'];?>" 
                      class="badge bg-label-success me-1 add-to-cart-button" >Update Progress</a>
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
