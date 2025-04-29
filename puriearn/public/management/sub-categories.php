<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
$title="Categories";

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from subcategories where id = '".$_GET['id']."'");
                  $_SESSION['msg']="SubCategory  Deleted !!";
		  }
?>

<?php include('include/header.php');?>
		
<?php include('include/sidebar.php');?>
<div class="container-fluid py-4">

           

                  <div class="card" style="padding:30px;">
                  <h5 class="card-header">Ad Sub Categories</h5>
                  <div class="table-responsive table-wrapper-top text-nowrap" >
                  <p style="padding-left:10vw;color:#cb0c9f;"><?php if($msg) { echo htmlentities($msg);}?> </h5>

                  <table class="table table-bordered" id="dataTables-example" >
                  <thead>
                    <tr>
                      <th class="">SN</th>
                      <th class="">Name</th>
                      <th>Category</th>
                      <th class="">Created On</th>
                      <th class=""></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                 $query="SELECT * FROM `subcategories` ";
                 $result=mysqli_query($con,$query);
                 $cnt=1;
                 if(mysqli_num_rows($result)>0){
                   while($row=mysqli_fetch_array($result)){
                    $category_id=$row['category_id'];
                      ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                         
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo htmlentities($cnt);?></h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo htmlentities($row['name']);?></p>
                      </td>
                      <td>
                      <?php $query2=mysqli_query($con,"SELECT * FROM `categories` WHERE `id`= '$category_id' ");
                    while($row2=mysqli_fetch_array($query2))
                    {?>

                       <?php echo $row2['name'];?></option>
                    <?php } ?>
                      </td>
                      <td class="align-middle text-center ">
                        <span class="mb-0 text-sm"><?php echo htmlentities($row['created_at']);?></span>
                      </td>
                   
                      <td class="align-middle">
        
                        <a href="edit-sub-category.php?id=<?php echo $row['id'];?>" class="btn btn-primary" data-toggle="tooltip" data-original-title="Edit Category">
                          Edit
                        </a>
                        <a href="sub-categories.php?id=<?php echo $row['id'];?>&del=delete" 
                        onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">
                      Delete</a>
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




<?php include('include/footer.php');?>
