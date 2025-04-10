<?php 
include("conection.php"); 
$sponser_id=$_GET['sponser_id'];
$result=mysqli_query($con,"SELECT name from meddolic_user_details where user_id='$sponser_id' AND account_status=1");

if($val=mysqli_fetch_array($result)){
	 echo $val['name'];
} 
include("close-connection.php"); 
?>
