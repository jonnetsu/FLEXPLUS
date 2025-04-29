

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
		echo "<script>window.location.href='all-posts.php';</script>";
	}

	$pid=intval($_GET['id']);

	if (isset($_POST['submit'])) {
		$title = sanitize_input($_POST['title']);
		$description = $_POST['description'];
	
		// Assuming you have a database connection established, perform the SQL update using prepared statements
		$sql = "UPDATE `tasks` SET `title` = ?, `description` = ? WHERE `id` = ?";
		$stmt = $con->prepare($sql);
		$stmt->bind_param("ssi", $title, $description, $pid);
	
		if ($stmt->execute()) {
			$msg = "Post Updated Successfully";
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
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tasks/</span> Edit Sponsored Posts</h4>

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
                                              $query="SELECT * FROM `tasks` WHERE `id`='$pid' ";
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
				<label class="form-label" for="basicinput"> Description</label>
				<div class="controls">
				<textarea name="description"  class="form-control" ><?php echo $row['description']; ?></textarea>   
				</div>
				</div>



			<div class="mb-3 col-md-12">
			    <label for="productimage">Image</label>
			    <?php if(isset($row['image']) & !empty($row['image'])){ ?>
			    <br>
			    	<img src="uploads/<?php echo $row['image'] ?>" width="100px" height="100px">
			    	<a href="delpostimg.php?id=<?php echo $row['id']; ?>">Delete Image</a> <br>
					<a href="update-post-image.php?id=<?php echo $row['id']; ?>" 
					style="margin-left:70px;">Update Image</a>

			    <?php }else{ ?>
			    
					<a href="updateproductimg.php?id=<?php echo $r['product_id']; ?>">Add Image</a>

			    <?php  }?>
			  </div>

			 
	<div class="">
											<div class="form-group">
												<button type="submit" name="submit" class="btn btn-o btn-primary" >Update Post</button>
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
