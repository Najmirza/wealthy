<?php
	require_once('../conection.php');
	require('../PHPMailer/EncrptyModel.php');
	$d=date("Y-m-d H:i:s");
	$userId=mysqli_real_escape_string($con,$_POST['userId']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$passObj= new passEncrypt();
    $encPass= $passObj -> twoPassEncrypt($password);
	$querySql=mysqli_query($con,"SELECT name,member_id,user_id,user_type,password FROM meddolic_user_details WHERE user_id='$userId' AND password='$encPass' AND user_type=2 AND account_status=1");
	$num_rows=mysqli_num_rows($querySql);
	$valDetails=mysqli_fetch_assoc($querySql);
	if($num_rows) {
		switch ($valDetails['user_type']){
          case '2':
          	if($valDetails){
          		session_start();
          		unset($_SESSION['user_member_id']);
				unset($_SESSION['member_user_id']);
				unset($_SESSION['member_password']);
				unset($_COOKIE['memberUserId']);
				
    			setcookie('memberUserId', null, -1, '/');
    			
				$_SESSION['user_member_id']=$valDetails['member_id'];
				$_SESSION['member_user_id']=$valDetails['user_id'];
				$_SESSION['member_password']=$valDetails['password'];
				setcookie ("memberUserId",$valDetails["user_id"],time()+ 3600);
			
				echo "/Dashboard";
			} else {
				return false ;
			}
			break;
	    }
	} else {
		return false;
	} ?>