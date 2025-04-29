<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
$title="Add Category";

if(isset($_POST['submit']))
{
  $ctitle=$_POST['title'];

  $sql1 =mysqli_query($con,"SELECT name FROM categories WHERE name='$ctitle'");
	$count=mysqli_num_rows($sql1);

	if($count>0)
{
	$msg="Category already exists";
  $type="warning";

} else{

  $sql=mysqli_query($con,"INSERT INTO categories(name) values ('$ctitle')");
if($sql)
{
$msg="New Category Added Successfully !!";
$type="success";

}

}
}
?>

<?php include('include/header.php');?>
		
<?php include('include/sidebar.php');?>

<div class="container-fluid py-4">

           

                  <div class="card" style="padding:30px;">
                  <h5 class="card-header">Add Category</h5>
                  <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
                  <div class="table-responsive table-wrapper-top text-nowrap" >


              <div class="table-responsive p-0" >
			  <form role="form" name="" method="post">
        <div class="mb-3 col-md-12">
        <label class="form-label" for="basic-default-fullname">Name</label>

          <input type="text" placeholder="Enter category Name"  name="title" class="form-control" required>

          </div>


      <button type="submit" name="submit" id="submit" class="btn  btn-primary" > Add </button>
</form>


              </div>
            </div>
          </div>
        </div>
      </div>

                  </div>

<?php include('include/footer.php');?>
