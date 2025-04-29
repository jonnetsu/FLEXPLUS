

<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
include('include/functions.php');

check_login();
$title="Edit Item";



if(isset($_GET) & !empty($_GET)){
	$pid=intval($_GET['id']);// get post id
}else{
		echo "<script>window.location.href='all-tasks.php';</script>";
	}

	$pid=intval($_GET['id']);

	if (isset($_POST['submit'])) {
		$title = sanitize_input($_POST['title']);
		$description = $_POST['description'];
        $url = sanitize_input($_POST['url']);

	
		// Assuming you have a database connection established, perform the SQL update using prepared statements
		$sql = "UPDATE `daily_task` SET `title` = ?, `description` = ?,`url` = ? WHERE `id` = ?";
		$stmt = $con->prepare($sql);
		$stmt->bind_param("sssi", $title, $description,$url, $pid);
	
		if ($stmt->execute()) {
			$msg = "Task Updated Successfully";
			$type = "success";
		} else {
			$msg = "Something went wrong, please try again.";
			$type = "warning";
		}
	}
	
	
	?>
<?php include('include/header.php');?>
		
<?php include('include/sidebar.php');?>


 <!-- Content wrapper -->
 <div class="content-wrapper">
            <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tasks/</span>Daily Task</h4>

<div class="card mb-4">
                    <!-- Account -->
                    <div class="card-body">
					<?php if(isset($msg)){ ?>
                    <div class="alert alert-<?php echo $type?>">
                          <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                          <p class="mb-0"><?php echo $msg?></p>
                        </div>
                        <?php }?>
         
						<?php 
                                              $query="SELECT * FROM `daily_task` WHERE `id`='$pid' ";
                                              $result=mysqli_query($con,$query);
                                         
                                            while($row=mysqli_fetch_array($result))
                                            {?>

			 <div class="text-box">									<br />
			<form class="" method="post" action="">			
				<div class="row">				
				<div class="mb-3 col-md-12">
				<label class="form-label" for="basicinput">Title</label>
				<div class="">
				<input type="text" name="title" class="form-control"  value="<?php echo htmlentities($row['title']);?>">
				</div>
				</div>
                <div class="mb-3 col-md-12">
				<label class="form-label" for="basicinput">Url</label>
				<div class="">
				<input type="text" name="url" class="form-control"  value="<?php echo htmlentities($row['url']);?>">
				</div>
				</div>

				<div class="mb-3 col-md-12">
				<label class="form-label" for="basicinput"> Description</label>
				<div class="controls">
				<textarea name="description"  class="form-control" ><?php echo $row['description']; ?></textarea>   
				</div>
				</div>



			

			 
	<div class="">
											<div class="form-group">
												<button type="submit" name="submit" class="btn btn-o btn-primary" >Update Task</button>
											</div>
										</div>
									</form>
							</div>
						</div>


						

	<?php }?>
						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->
	</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->




<?php include('include/footer.php');?>
