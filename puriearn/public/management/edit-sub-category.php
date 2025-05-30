<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
$title="Edit Category";
$currentTime = date( 'd-m-Y h:i:s A', time () );

error_reporting(E_ALL);
ini_set('display_errors', 1);


if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$category=$_POST['category'];

		$id=intval($_GET['id']);
	$sql=mysqli_query($con,"UPDATE subcategories set `name`='$name',`category_id`='$category', updated_at='$currentTime' where id='$id'");
  if ($sql) {
    $msg = "Sub Category Updated Successfully";
    $type = "success";
} else {
    $msg = "Something went wrong, please try again.";
    $type = "warning";
}
}
?>

<?php include('include/header.php');?>
		
<?php include('include/sidebar.php');?>

<div class="container-fluid py-4">

           

                  <div class="card" style="padding:30px;">
                  <h5 class="card-header">Edit Sub-Category</h5>
                  <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
                  <div class="table-responsive table-wrapper-top text-nowrap" >


<?php
			$id=intval($_GET['id']);
			$query=mysqli_query($con,"SELECT * FROM `subcategories` WHERE `id`='$id'");
			while($data=mysqli_fetch_array($query))
			{
			?>

      <div class="form-group text-box" >

      <h4><?php echo htmlentities($data['name']);?>'s Details</h4>
      <p><b>Category Creation Date: </b><?php echo htmlentities($data['created_at']);?></p>
      <?php if($data['updated_at']){?>
      <?php } ?>
      <hr />
      <form role="form"  method="post" action="">
      <div class="mb-3 col-md-6">
            <label class="" for="basicinput">Category</label>
            <div class="">
            <select name="category" class="form-control"  required>
            <?php $query=mysqli_query($con,"select * from categories");
            while($row=mysqli_fetch_array($query))
            {?>
            <option value="<?php echo $row['id']; ?>" <?php if( $row['id'] == $data['category_id']){ echo "selected"; } ?>><?php echo $row['name']; ?></option>

            <?php } ?>
            </select>
            </div>
            </div>
      <div class="mb-3 col-md-6">
      <label class="form-label" for="basic-default-fullname">Sub-Category Name</label>
      <input type="text" name="name" class="form-control" value="<?php echo htmlentities($data['name']);?>" >
      </div>
   
			<?php } ?>

      <button type="submit" name="submit" class="btn btn-o btn-primary">
        Update
      </button>
			</form>
												
              </div>
            </div>
          </div>
        </div>
      </div>

      </div>



<?php include('include/footer.php');?>
