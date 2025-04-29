<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
$title="Update Image";
$currentTime = date( 'd-m-Y h:i:s A', time () );

$id=intval($_GET['id']);// product id

if(isset($_POST['submit']))
{
	$productname=$_POST['product_title'];

  //$dir="productimages";
  //unlink($dir.'/'.$pimage);
$target_dir = "../admin/productimages/";
$target_file = $target_dir . ($_FILES["product_image"]["name"]);
$filename = $_FILES['product_image']['name'];
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {

$sql = "UPDATE `products` set `product_image`='$filename',updationDate='$currentTime'
         WHERE `product_id`='$id' ";	
			$res = mysqli_query($con, $sql);
		if($res){
			$smsg = "Product Image Updated Successfully !!";
            $_SESSION['msg']="Product Image Updated Successfully !!";
		}else{
			$fmsg = "Failed to Update Image";
            $_SESSION['msg']="Failed to Update Image";

		}

}else {
  $fmsg = "Failed to upload image";

}

}

	?>
<?php include('include/header.php');?>
		
<?php include('include/sidebar.php');?>


   <!-- Content wrapper -->
   <div class="content-wrapper">
            <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product/</span> Update Image</h4>

<p style="color:#33ac39;text-align:center">
<?php if(isset($fmsg)){ ?><?php echo $fmsg; ?> <?php } ?>
<?php if(isset($smsg)){ ?> <?php echo $smsg; ?><?php } ?>
</p>
<?php 
          $query="SELECT * FROM products WHERE product_id='$id' ";
          $result=mysqli_query($con,$query);
          while($row=mysqli_fetch_array($result))
{
    $updation_date = $row['updationDate'];
    $updation_date = date('l jS F Y \a\t g:ia');
    ?>
 
 <div class="card mb-4">
                    <h5 class="card-header">Current Image for <?php echo $row['product_name']; ?></h5>
                    <!-- Account -->
                    <div class="card-body">
                    <form  method="post" enctype="multipart/form-data">

                    
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                      <?php if(isset($row['product_image']) & !empty($row['product_image'])){ ?>
                <img
                          src="../admin/uploads/<?php echo $row['product_image'] ?>"
                          alt="product-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                        />
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-outline-secondary account-image-reset mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Change Image</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              name="product_image"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                            />
                          </label>
                          <p class="text-muted mb-0">Only JPG and PNG are allowed.</p>
                      </div>
			    <?php }else {?>
			
            <label for="upload" class="btn btn-outline-secondary account-image-reset mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Add Image</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              name="product_image"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                            />
                          </label>
                          <p class="text-muted mb-0">Only JPG and PNG are allowed.</p>
                      </div>    
            


            <?php }?>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                       
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2" type="submit" name="submit" >Upload</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  

</div></div>

                <?php }?>
              </div>
            </div>
            <!-- / Content -->




<?php include('include/footer.php');?>
