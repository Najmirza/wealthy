<?php 

ob_start();

error_reporting(E_ALL ^ E_NOTICE);
include("loginCheck.php");
require('../PHPMailer/EncrptyModel.php');
if(isset($_POST['loginPassword'])){
	$member_id=$_POST['login_member_id'];
	$password=$_POST['password'];
	$password1=$_POST['password1'];
	$password2=$_POST['password2'];

	if($password2!=$password1){ ?>
		<script>
			alert("New Login Passwords do not match!!!");
			window.top.location.href='changePassword';
		</script>
		<?php
		exit();
	}
	$newCalObj= new passEncrypt;
    $encPass= $newCalObj -> twoPassEncrypt($password);
	$queryCheck=mysqli_query($con,"SELECT COUNT(*) FROM meddolic_user_details where member_id='$member_id' AND password='$encPass' AND user_type=1");
	$valCheck=mysqli_fetch_array($queryCheck);
	if($valCheck[0]==0) { ?>
		<script>
	     	alert("Incorrect Current Login Password!!!");
		 	window.top.location.href='changePassword';
		</script>
		<?php
		exit;
	}
	$newCalObj= new passEncrypt;
    $newEncPass= $newCalObj -> twoPassEncrypt($password1);
	$queryUpdate=mysqli_query($con,"UPDATE meddolic_user_details SET password='$newEncPass' where member_id='$member_id' AND user_type=1");
	if($queryUpdate) { ?>
	    <script>
	     alert("Login Password Updated Successfully!!!\nNow please login again with new password. ");
	     window.top.location.href='changePassword';
	    </script>
	     <?php
	}
}
if(isset($_POST['trnPassword'])){
	$member_id=$_POST['login_member_id'];
	$password=$_POST['password'];
	$password1=$_POST['password1'];
	$password2=$_POST['password2'];

	if($password2!=$password1){ ?>

		<script>
		alert("New Pin Passwords do not match!!!");
		window.top.location.href='changePassword';
		</script>
		<?php
		exit();
	}
	$newCalObj1= new passEncrypt;
	$encTrnPass= $newCalObj1 -> twoPassEncrypt($password);
	$queryCheck=mysqli_query($con,"SELECT count(*) from meddolic_user_details WHERE member_id='$member_id' and trnPassword='$encTrnPass' AND user_type=1");
	$valCheck=mysqli_fetch_array($queryCheck);
	if($valCheck[0]==0) {  ?>
		<script>
	     	alert("Incorrect Current Transaction Password!!!");
		 	window.top.location.href='changePassword';
		</script>
		<?php
		exit;
	}
	$newCalObj1= new passEncrypt;
	$newencTrnPass= $newCalObj1 -> twoPassEncrypt($password1);
	$result1=mysqli_query($con,"UPDATE meddolic_user_details SET trnPassword='$newencTrnPass' WHERE member_id='$member_id' AND user_type=1");
	if($result1) { ?>
	    <script>
	     alert("Transaction Password Updated Successfully!!!");
	     window.top.location.href='changePassword';
	    </script>
	     <?php
	}
} ?>
<?php include("../close-connection.php"); ?>