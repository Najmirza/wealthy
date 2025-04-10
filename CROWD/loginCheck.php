<?php
error_reporting(0);
include("../conection.php");
$user_id=mysqli_real_escape_string($con,$_SESSION['admin_user_id']);
$password=mysqli_real_escape_string($con,$_SESSION['admin_password']);
$result = mysqli_query($con,"SELECT * FROM meddolic_user_details WHERE user_id='$user_id' AND password='$password' AND user_type=1");
$count=mysqli_num_rows($result);
if($count==0) { ?>
	<script>
	 window.top.location.href="index";
	</script>
	<?php
	exit;
} ?>
