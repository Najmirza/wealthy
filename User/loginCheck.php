<?php   
error_reporting(0);
include("../conection.php");
include("../PHPMailer/EncrptyModel.php");
$userId=mysqli_real_escape_string($con,$_SESSION['member_user_id']);
$passKey=mysqli_real_escape_string($con,$_SESSION['member_password']);

$result = mysqli_query($con,"SELECT * FROM meddolic_user_details WHERE user_id='$userId' AND password='$passKey' AND user_type=2 AND account_status=1");
$count=mysqli_num_rows($result);
if($count==0) { ?>
	<script>
		window.top.location.href="LoginAuth";
	</script>
	<?php
	exit;
} ?>

