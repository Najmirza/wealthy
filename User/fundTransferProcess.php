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
	$loginMemberId=$_POST['loginMemberId'];
	$amount=$_POST['amount'];	
	$trnPassword=$_POST['trnPassword'];
	$d=date("Y-m-d H:i:s");
	$entry_date=date("Y-m-d");

	if($amount=='' || $amount<0){ ?>
	  	<script>
			alert("Enter Valid Transfer Amount!!!");
	  		history.go(-1);
	  	</script>
	  	<?php
	  	exit;
	}
	if($amount<1){ ?>
	  	<script>
			alert("Minimum Transfer Amount $ 1 !!!");
	  		history.go(-1);
	  	</script>
	  	<?php
	  	exit;
	}
	$newCalObj4= new passEncrypt;
	$encTrnPass= $newCalObj4 -> twoPassEncrypt($trnPassword);
  	$queryCheck=mysqli_query($con,"SELECT COUNT(1) FROM meddolic_user_details WHERE trnPassword='$encTrnPass' AND member_id='$loginMemberId'");
  	$valCheck=mysqli_fetch_array($queryCheck);
  	if($valCheck[0]==0) { ?>
	  <script>
			alert("Incorrect Transaction Password!!!");
	  	history.go(-1);
	  </script>
	  <?php
	  exit;
  	}

	  $queryDirect=mysqli_query($con,"SELECT COUNT(1) FROM meddolic_user_details WHERE sponser_id='$loginMemberId' AND topup_flag=1");
	  $valDirect=mysqli_fetch_array($queryDirect);
	  $totalDirect=$valDirect[0];
	
	$result=mysqli_query($con,"SELECT * FROM meddolic_user_details WHERE user_id='$user_id1' AND user_type=2");
	if(!mysqli_num_rows($result)) { ?>
	  <script>
	    alert("Invalid Member Details!!!");
	    window.top.location.href="fundTransfer";
	  </script>
	  <?php
	  exit;
	}

	$resultFund=mysqli_query($con,"SELECT fundWallet FROM meddolic_user_details WHERE member_id='$loginMemberId' AND fundWallet>='$amount'");
	if(!mysqli_num_rows($resultFund)){ ?>
		<script>
		alert("Insufficient Balance in Wallet to Transfer!!!");
	    window.top.location.href="fundTransfer";
		</script>
		<?php
		exit;
	}

	$query1="SELECT member_id,phone FROM meddolic_user_details WHERE user_id='$user_id1'";
	$result1=mysqli_query($con,$query1);
	$val1=mysqli_fetch_assoc($result1);
	$receiver_member_id=$val1['member_id'];
	$receiverPhone=$val1['phone'];

	$querySender=mysqli_query($con,"SELECT user_id,currentPackage FROM meddolic_user_details WHERE member_id='$loginMemberId'");
	$valSender=mysqli_fetch_assoc($querySender);
	$senderUserId=$valSender['member_id'];
	$currentPackage=$valSender['currentPackage'];


	if($loginMemberId==$receiver_member_id){ ?>
		<script>
			alert("You Can't Transfer Fund to Yourself!!!");
	    	window.top.location.href="fundTransfer";
		</script>
		<?php
		exit;
	}

	$queryCharge = mysqli_query($con, "SELECT p2pTransferCharge,directNeed FROM meddolic_config_misc_setting");
		$valCharge = mysqli_fetch_assoc($queryCharge);
		$p2pTransferCharg = $valCharge['p2pTransferCharge'];
		$directNeed = $valCharge['directNeed'];

		$Charge=$amount*$p2pTransferCharg / 100;
		$netAmount = $amount - $Charge;
		if($totalDirect<$directNeed){ 
			?>
		 <script>
					 alert("Need to Give <?=$directNeed?> Direct to Transfer");
					 history.go(-1);
				
		</script>
		 <?php
				 exit;
			 }

			//  $queryCapping =mysqli_query($con, "SELECT cappingLimit FROM meddolic_config_package_list WHERE packageId='$currentPackage'");
			//  $valCapping = mysqli_fetch_assoc($queryCapping);
			//  $cappingLimit = $valCapping['cappingLimit'];
			
			//  $queryCappingWithdraw = mysqli_query($con,"SELECT SUM(amount) AS totalWithdraw FROM meddolic_user_wallet_withdrawal_crypto WHERE member_id='$loginMemberId' AND released IN(0,1)");
			//  $valCappingWith = mysqli_fetch_assoc($queryCappingWithdraw);
			//  $cappingWithdrawal = $valCappingWith['totalWithdraw'];

			//  $queryCappingWithdraw = mysqli_query($con,"SELECT SUM(amount) AS totalp2pTransfer FROM meddolic_user_fund_transfer_history WHERE sender_member_id='$loginMemberId' AND status=1");
			//  $valCappingWith = mysqli_fetch_assoc($queryCappingWithdraw);
			//  $totalTransfer = $valCappingWith['totalp2pTransfer'];

			//  $totalCapping=$cappingWithdrawal+$totalTransfer;
	 
			//   $finalCapping=$cappingLimit-$totalCapping;
			//  if($amount>$finalCapping){?>
			// 	 <script>
			// 		 alert("Cappng is Over Need to Upgrade Your Account...!!!");
			// 		 window.top.location.href = "fundTransfer";
			// 	 </script>
			//  <?php
			// 	 exit;
	 
			//  }

	mysqli_query($con,"UPDATE meddolic_user_details SET fundWallet=fundWallet+'$amount' WHERE member_id='$receiver_member_id'");

	mysqli_query($con,"UPDATE meddolic_user_details SET fundWallet=fundWallet-'$amount' WHERE member_id='$loginMemberId'");

	mysqli_query($con,"INSERT INTO meddolic_user_fund_transfer_history (`sender_member_id`,`receiver_member_id`,`amount`,`netAmount`,`date_time`) VALUES ('$loginMemberId','$receiver_member_id','$amount','$amount','$d')");


	mysqli_query($con,"INSERT INTO meddolic_user_wallet_statement (`member_id`,`wallet_statement_id`,`deb_cr`, `amount`,`date_time`,`trn_id`) VALUES ('$loginMemberId',5,1,'$amount','$d','$receiver_member_id')");

	mysqli_query($con,"INSERT INTO meddolic_user_wallet_statement (`member_id`,`wallet_statement_id`,`deb_cr`, `amount`,`date_time`,`trn_id`) VALUES ('$receiver_member_id',6,2,'$amount','$d','$loginMemberId')");?>
	<script>
	  alert("Fund Transfer Successfully!!!");
	  window.top.location.href="fundTransfer";
	</script>
	<?php } ?>
<?php include("../close-connection.php");?>