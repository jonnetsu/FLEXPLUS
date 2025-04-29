<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
$title="Categories";


if(isset($_GET['del']))
		  {
		          mysqli_query($con,"DELETE FROM `digital_courses` WHERE `id` = '".$_GET['id']."'");
                  $_SESSION['msg']="E-Book Deleted !!";
		  }
?>

<?php include('include/header.php');?>
		
<?php include('include/sidebar.php');?>

<style>
    .break-words {
        overflow-wrap: break-word;
        word-wrap: break-word;
        hyphens: auto;
    }
</style>

<div class="container-fluid py-4">

          
                  <div class="card" style="padding:30px;">
                <h5 class="card-header">All Courses</h5>
                <div class="table-responsive table-wrapper-top text-nowrap" >
<?php echo htmlentities($_SESSION['msg']);?>
								<?php echo htmlentities($_SESSION['msg']="");?></p>

                <table class="table align-items-center mb-0" id="dataTables-example" >
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SN</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Amount</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $query=mysqli_query($con,"SELECT * FROM `digital_courses` ");
                      $cnt=1;
                      while($row=mysqli_fetch_array($query))
                      {
                      ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                         
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo htmlentities($cnt++);?></h6>
                          </div>
                        </div>
                      </td>
                      <td> 
                      <div class="d-flex px-2 py-1">
                        <p class="text-xs font-weight-bold mb-0">
                        <?php
            $bookName = htmlentities($row['book_name']);
            $words = explode(' ', $bookName);
            echo implode(' ', array_slice($words, 0, 4)) . '<br>';
            if (count($words) > 4) echo implode(' ', array_slice($words, 4));
            ?>
                          
                        </p>
                      </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                         
                          <div class="d-flex flex-column justify-content-center">
                           <image src="../admin/<?php echo $row['image_filepath'];?>" width="80">
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                      &#8358;<?php echo htmlentities($row['amount']);?>
                      </td>
                      <td class="align-middle">
                      <?php 
                        if($row['type'] =="1"){
                            ?>
                            <span class="badge bg-warning ">Basic</span> 
                            <?php
                        }else{
                        
                            ?>
                            <span class="badge bg-success">Advanced</span>
                                
                                <?php
                                    }
                                ?>        
                      </td>
                    
                      <td class="align-middle">
                      <a class="btn btn-primary deactivate-account" href="course-details.php?cid=<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></a> 
                        <a href="?id=<?php echo $row['id'];?>&del=delete" 
                        onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger ">
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
