<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
$title="Banerns";

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"DELETE FROM `images` WHERE `id` = '".$_GET['id']."'");
                  echo "<script>window.location.href='banners.php';</script>";

		  }
      //Make user a vendor
      if(isset($_GET['make']))
		  {
        $sql1="UPDATE `images` SET `status`='1' WHERE `id`='".$_GET['id']."' ";
        $result1=mysqli_query($con,$sql1);
		  }
       //Remove user's a vendor status
       if(isset($_GET['remove']))
       {
         $sql1="UPDATE `images` SET `status`='0' WHERE `id`='".$_GET['id']."' ";
         $result1=mysqli_query($con,$sql1);
       }
?>

<div class="container-fluid py-4">

           

                  <div class="card" style="padding:30px;">
                  <h5 class="card-header">Banner Images</h5>
                  <div class="table-responsive table-wrapper-top text-nowrap" >
                  <p style="padding-left:10vw;color:#cb0c9f;"><?php if($msg) { echo htmlentities($msg);}?> </h5>

                  <table class="table table-bordered" id="dataTables-example" >
                    <thead>
                      <tr class="text-nowrap">
                        <th>SN</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>    
                    <tbody>
                    <?php 
                  $query="SELECT * FROM `images` ";
                  $result=mysqli_query($con,$query);
                  $cnt=1;
                  if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                      ?>
                    <tr>
                    <td><?php echo $cnt++;?></td>
                    <td><img src="banners/<?php echo htmlentities($row['image_url']);?>" width="100"> </td>
                     
                      <td class="align-middle">
                        <?php 
                        if($row['status']== '1'){ ?>
                          <span class="btn btn-success ">Active</span>
                        <?php }else{ ?>
                          <span class="btn btn-warning">Inactive</span>
                        <?php } ?>
                        </td>
                        <td class="align-middle">
                        <?php 
                        if($row['status']== '1'){ ?>
                            <a href="?id=<?php echo $row['id'];?>&remove=vendor" 
                               onClick="return confirm('Are you sure you want to remove this banner inactive?')" class="btn btn-warning ">
                             Make Inactive
                            </a>
                        <?php }else{ ?>
                          <a href="?id=<?php echo $row['id'];?>&make=vendor" 
                               onClick="return confirm('Are you sure you want to make this banner active?')" class="btn btn-primary deactivate-account">
                             Make Active</a>
                        <?php } ?>
                        
                        <a href="?id=<?php echo $row['id'];?>&del=delete" 
                        onClick="return confirm('Are you sure you want to delete banner?')" class="btn btn-danger deactivate-account">
                        Delete Banner</a>
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
                     
<?php include('include/footer.php');?>
