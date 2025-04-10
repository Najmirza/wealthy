<br><br><br>
<center>
<h2>Processing your request!!!</h2>
<h3>Please do not press back or refresh!!!</h3>
</center>
<?php 
include("loginCheck.php");
require_once('../PHPMailer/EncrptyModel.php');
if(isset($_POST['fundTransfer'])){
   
 	$user_id1=$_POST['sponser_id']; 
 	$sender_member_id=$_POST['login_member_id'];
 	$amount=$_POST['amount'];
	$trnPassword=$_POST['trnPassword'];
 	$d=date("Y-m-d H:i:s");
 	$entry_date=date("Y-m-d");


// 	 $newCalObj11= new passEncrypt;
// 	 $encTrnPass= $newCalObj11 -> twoPassEncrypt($trnPassword);
// 	 $queryCheck=mysqli_query($con,"SELECT COUNT(1) FROM meddolic_user_details WHERE member_id='$sender_member_id' AND trnPassword='$encTrnPass'");
// 	 $valCheck=mysqli_fetch_array($queryCheck);
// 	 if($valCheck[0]==0) { ?>
// 		 <script>
// 		   alert("Incorrect Transaction Password!!!");
// 		   window.top.location.href='fundTransfer';
// 		 </script>
// 		 <?php
// 		 exit;
// 	 }




 	if($amount<0 || $amount==0){ ?>
 		<script>
	    alert("Please Enter Valid Transfer Amount!!!");
	    window.top.location.href="fundTransfer";
	  </script>
	  <?php
	  exit;
 	}

	$result=mysqli_query($con,"SELECT * from meddolic_user_details where user_id='$user_id1' AND user_type=2 AND account_status=1");
	if(!mysqli_num_rows($result)) { ?>
	  <script>
	    alert("Invalid Member ID!!!");
	    window.top.location.href="fundTransfer";
	  </script>
	  <?php
	  exit;
	}

	$query1="SELECT member_id FROM meddolic_user_details WHERE user_id='$user_id1'";
	$result1=mysqli_query($con,$query1);
	$val1=mysqli_fetch_assoc($result1);
	$receiver_member_id=$val1['member_id'];

	mysqli_query($con,"UPDATE meddolic_user_details set fundWallet=fundWallet+'$amount' where member_id='$receiver_member_id'");

	mysqli_query($con,"INSERT INTO meddolic_user_fund_transfer_history(`sender_member_id`, `receiver_member_id`,`amount`,`date_time`) VALUES ('$sender_member_id','$receiver_member_id','$amount','$d')");

	mysqli_query($con,"INSERT INTO meddolic_user_wallet_statement (`member_id`,`wallet_statement_id` ,`deb_cr`, `amount`, `date_time`,`trn_id`) VALUES ('$receiver_member_id',6,2,'$amount','$d','$sender_member_id')");

?>
<script>
  alert("Fund Transfer Successfully!!!");
  window.top.location.href="fundTransferHistory";
</script>
<?php } ?>
<?php include("../close-connection.php"); ?>