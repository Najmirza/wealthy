<?php   
error_reporting(0);
session_start();
date_default_timezone_set("Asia/Kolkata");
if($_GET['userId']){
	// echo $_GET['userId'];exit();
	$user_id=base64_decode($_GET['userId']);
	$password=$_GET['mID'];
	$codeGenerate=base64_decode($_GET['codeGenerate']);
	unset($_COOKIE['memberUserId']);
	setcookie('memberUserId', null, -1, '/');
	$_SESSION['user_member_id']=$codeGenerate;
	$_SESSION['member_user_id']=$user_id;
	$_SESSION['member_password']=$password;
	setcookie ("memberUserId",$user_id,time()+ 3600); ?>
	<script>
		window.top.location.href='Dashboard';
	</script>
	<?php } ?>