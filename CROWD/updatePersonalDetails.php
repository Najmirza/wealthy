<?php 

ob_start();

error_reporting(E_ALL ^ E_NOTICE);
include("loginCheck.php");
$member_id1=$_POST['member_id1'];
$user_id1=$_POST['user_id'];
$name=$_POST['name'];
$phone=$_POST['phone'];
$email_id=$_POST['email_id'];


$result1=mysqli_query($con,"UPDATE meddolic_user_details SET name='$name',phone='$phone',email_id='$email_id' WHERE member_id='$member_id1'");
if($result1){ ?>
    <script>
    	alert("Personal Details Updated Successfully");
	    window.top.location.href='viewMemberDetails?user_id=<?=$user_id1?>';
    </script>
    <?php }else{ ?> 
    <script>
    	alert("Personal Details Not-Updated..Try Again!!!");
	    window.top.location.href='viewMemberDetails?user_id=<?=$user_id1?>';
    </script>	
    <?php } ?>
<?php include("../close-connection.php"); ?>