<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
$title="Posts";

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"DELETE FROM `tasks` WHERE `id` = '".$_GET['id']."'");
                  echo "<script>window.location.href='all-posts.php';</script>";

		  }

?>

<div class="container-fluid py-4">

           

                  <div class="card" style="padding:30px;">
                  <h5 class="card-header">Notifications</h5>
                  <div class="table-responsive table-wrapper-top text-nowrap" >
                  <p style="padding-left:10vw;color:#cb0c9f;"><?php if($msg) { echo htmlentities($msg);}?> </h5>

                  <table class="table table-bordered" id="dataTables-example" >
                    <thead>
                      <tr class="text-nowrap">
                        <th>SN</th>
                        <th>Description</th>
                        <th>Date</th>
                      
                      </tr>
                    </thead>    
                    <tbody>
                    <?php 
                  $query="SELECT * FROM `notifications` WHERE `action_type`='Admin' ";
                  $result=mysqli_query($con,$query);
                  $cnt=1;
                  if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                        $date_string=$row['created_at'];// date retrieved from database
                        $timestamp = strtotime($date_string); // convert date string to Unix timestamp
                        $date = date(" l, jS \of F Y", $timestamp);// format timestamp into words
                      ?>
                    <tr>
                    <td><?php echo $cnt++;?></td>
                    <td><?php echo htmlentities($row['body']);?></td>
                    <td><?php echo $date;?></td>                      
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
