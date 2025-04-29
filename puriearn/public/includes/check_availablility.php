<?php
require_once '../../../config/config.php';
if(!empty($_POST["username"])) {
	$username= $_POST["username"];

	  
	$sql =mysqli_query($con,"SELECT `username` FROM `users` WHERE `username`='$username'");
	$count=mysqli_num_rows($sql);

if($count>0)
{		
	?>

	<span style='color:#ff4e00;;padding-left:10px;'>An account with this username already exits!</span>
	<script>$('#submit1').prop('disabled',true);</script>
<?php

} else{

echo "<span style='color:green;padding-left:10px;'> username Available </span>";
echo "<script>$('#submit1').prop('disabled',false);</script>";
}
}



?>
