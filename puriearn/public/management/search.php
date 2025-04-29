<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
$title="Search Orders";


if(isset($_POST['submit']))
{
	$tid=$_POST['trx_id'];


$sql=mysqli_query($con,"UPDATE received_payment set
status='Payed' WHERE trx_id='$tid' ");

if($sql)
{
$msg="Payment Confirmed";
}else{

  $msg="Sorry, an error occured!";
 
}

}
?>

<?php include('include/header.php');?>
		
<?php include('include/sidebar.php');?>



<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Search Orders
              </h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
		<p style="padding-left:10vw;color:#cb0c9f;">	<?php if($msg) { echo htmlentities($msg);}?></p> 

              <div class="table-responsive p-0" >
			  <form role="form" name="search" method="post">
			  <div class="form-group text-box" >

			 <div class="form-group">
<label for="orderid">
Search Order by ID
</label>
<input type="text" name="searchdata" id="searchdata" class="form-control" value="" required='true'>
</div>

<button type="submit" name="search" id="submit" class="btn btn-o btn-primary">
Search
</button>

</form>

<?php
if(isset($_POST['search']))
{

$sdata=$_POST['searchdata'];
  ?>
<h4 align="center">Result for Order "<?php echo $sdata;?>"  </h4>


<table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Amount</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                      <th class="text-secondary opacity-7">Order Details</th>
                      <th class="text-secondary opacity-7"></th>

                    </tr>
                  </thead>
<tbody>
<?php
$sql=mysqli_query($con,"select * from received_payment where trx_id like'%$sdata%'");
$num=mysqli_num_rows($sql);
if($num>0){
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
 <tr>
                      <td>
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
                      <a href="order-details.php?id=<?php echo $row['trx_id'];?>" class="btn btn-transparent btn-xs" >View Details</a>

                      
                      </td>
                      <td class="align-middle">
                      <form role="form" name="" method="post">
                      <input type="hidden" name="trx_id" class="form-control" value="<?php echo $row['trx_id'];?>" >

                        <button type="submit" class="badge badge-sm bg-gradient-secondary" name="submit">
                        Mark as payed
                        </button>
                        </form>
                      </td>
                    </tr>
<?php
$cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="8"> No record found against this search</td>

  </tr>

<?php }} ?></tbody>
</table

</div
<div style="margin-left:10vw;height:5vh;"></div>  
              </div>
            </div>
          </div>
        </div>
      </div>

	  <div style="margin-left:10vw;height:30vh;"></div>


<?php include('include/footer.php');?>
