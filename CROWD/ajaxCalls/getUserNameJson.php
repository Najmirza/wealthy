<?php 

include("../../conection.php"); 

$sponser_id=$_GET['sponser_id'];

$result=mysqli_query($con,"SELECT name,member_id,wallet FROM meddolic_user_details WHERE user_id='$sponser_id'");
if($val=mysqli_fetch_array($result)){
   echo json_encode($val);
}
include("../../close-connection.php"); 
?>
