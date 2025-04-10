<?php 
include("conection.php"); 
$userId=$_GET['userId'];
$result=mysqli_query($con,"SELECT name from meddolic_user_details where user_id='$userId' AND account_status=1");
if($val=mysqli_fetch_array($result)){
	echo $val['name'];
} include("close-connection.php"); ?>