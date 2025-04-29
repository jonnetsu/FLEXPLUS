<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
$title="Products";


if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from products where product_id = '".$_GET['id']."'");
                  $_SESSION['msg']="Item Deleted !!";
		  }
?>

<?php include('include/header.php');?>
		
<?php include('include/sidebar.php');?>

<div class="container-fluid py-4">

                  <div class="card" style="padding:30px;">
                <h5 class="card-header">Products</h5>
                <div class="card-header pb-0">
              <h6><a href="add-product.php" class="btn btn-o btn-primary">
              Add Product</a>
              </h6>
            </div>
                <div class="table-responsive table-wrapper-top text-nowrap" >
                <p style="padding-left:10vw;color:#cb0c9f;"><?php if($msg) { echo htmlentities($msg);}?> </h5>



                
                <table class="table table-bordered" id="dataTables-example" >
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>Price</th>
                      <th>Qty in Stock</th>
                      <th>Keywords</th>
                      <th>Created On</th>
                      <th>Last Updated</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $query=mysqli_query($con,"select * from products");
                      $cnt=+1;
                      while($row=mysqli_fetch_array($query))
                      {
                      ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                         
                          <div class="d-flex flex-column justify-content-center">
                           <image src="../admin/uploads/<?php echo $row['product_image'];?>" width="30">
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo htmlentities($row['product_title']);?></p>
                      </td>
                      <td>
                      <?php
                      $catid=$row['product_cat_id'];
                      $query1=mysqli_query($con,"select * from categories WHERE cat_id='$catid' ");
while($row1=mysqli_fetch_array($query1))
{?>
 <p class="text-xs font-weight-bold mb-0">
<?php echo $row1['cat_title'];?>
</p>
<?php } ?>
                      
                      </td>
                       <td>

  <?php
                      $brandid=$row['product_brand_id'];
                      $query2=mysqli_query($con,"select * from brands WHERE brand_id='$brandid' ");
while($row2=mysqli_fetch_array($query2))
{?>
 <p class="text-xs font-weight-bold mb-0">
<?php echo $row2['brand_title'];?>
</p>
<?php } ?>                      </td> <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo htmlentities($row['product_price']);?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0" style="text-align:center;"><?php echo htmlentities($row['stock']);?></p>
                      </td>
                      <td class="align-middle text-center ">
                        <span class="mb-0 text-sm"><?php echo htmlentities($row['product_keywords']);?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo htmlentities($row['creationDate']);?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo htmlentities($row['updationDate']);?></span>
                      </td>
                      <td class="align-middle">
        
                        <a href="edit-product.php?id=<?php echo $row['product_id'];?>" 
                        class="btn bg-label-success me-1 add-to-cart-button"
                         data-toggle="tooltip" data-original-title="Edit Category">
                          Edit
                        </a>
                        <a href="products.php?id=<?php echo $row['product_id'];?>&del=delete" 
                        onClick="return confirm('Are you sure you want to delete?')" 
                        class="btn bg-label-danger me-1 add-to-cart-button">
                      Delete</a>

                      </td>
                    </tr>
                    <?php }?>
                   
                   
                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>




<?php include('include/footer.php');?>
