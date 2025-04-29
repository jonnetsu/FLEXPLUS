<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
$title="Add Farmer";

if(isset($_POST['submit']))
{
$platform=$_POST['platform'];
$link=$_POST['link'];


if(empty($platform) || empty($link) ){
    $msg="All fields are required";
    $type = "warning";
}else{
$platform=mysqli_real_escape_string($con,$platform);
$link=mysqli_real_escape_string($con,$link);

   $sql1="INSERT INTO `social_media` (`platform`, `link`)
                VALUES  ('$platform','$link')";

    $result1=mysqli_query($con,$sql1);
    if($result1){ 
        $msg="New Link  Added Successfully !!";
        $type = "success";
    }else{
        $msg="something went wrong,please try again";
        $type = "warning";
    }  
 }

}//end of else (form validation)

?>

  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">New/</span> Add Link</h4>
 
 <div class="card mb-4">
                    <h5 class="card-header">New Social Link</h5>
                    <!-- Account -->
                    <hr class="my-0" />
                    <div class="card-body">
                    <?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
                    <form  method="post" action="">
                        <div class="row">
                        <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Plaftform</label>
                        <input type="text" class="form-control" name="platform" 
                         value="<?php if(isset($_POST['platform'])) echo $_POST['platform']; ?>"  />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Link</label>
                        <input type="text" class="form-control" name="link" 
                         value="<?php if(isset($_POST['link'])) echo $_POST['link']; ?>"  required/>
                      </div>
                     
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2" type="submit" name="submit" >Submit</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                

</div></div>

             
              </div>
            </div>
            <!-- / Content -->



                  
<?php include('include/footer.php');?>
