<?php 
include("conection.php"); 
$sponserId=$_GET['sponserId'];
$result=mysqli_query($con,"SELECT name from meddolic_user_details where user_id='$sponserId' AND account_status=1 AND topup_flag=1");
if($val=mysqli_fetch_array($result)){
	echo $val['name'];
} include("close-connection.php"); ?>