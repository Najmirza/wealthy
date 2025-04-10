<br><br><br>
<center>
	<h2>Processing your request!!!</h2>
	<h3>Please do not press back or refresh!!!</h3>
</center>
<?php

include("loginCheck.php");
if (isset($_POST['fundTransfer'])) {
	$user_id1 = $_POST['sponser_id'];
	$loginMemberId = $_POST['loginMemberId'];
	$amount = $_POST['amount'];
	$trnPassword = $_POST['trnPassword'];
	$incomeWallet = $_POST['incomeWallet'];
	$fundWallet = $_POST['fundWallet'];
	$d = date("Y-m-d H:i:s");
	$todayDate = date("Y-m-d");

	if ($amount <= 0) { ?>
		<script>
			alert("Invalid Amount Enter!!!");
			window.top.location.href = "mainToFund";
		</script>
	<?php
		exit;
	}
	$newCalObj1 = new passEncrypt;
	$encTrnPass = $newCalObj1->twoPassEncrypt($trnPassword);
	$queryCheck = mysqli_query($con, "SELECT COUNT(1) FROM meddolic_user_details where member_id='$loginMemberId' AND trnPassword='$encTrnPass'");
	$valCheck = mysqli_fetch_array($queryCheck);
	if ($valCheck[0] == 0) { ?>
		<script>
			alert("Incorrect Transaction Password!!!");
			history.go(-1);
		</script>
	<?php
		exit;
	}

	$resultFund = mysqli_query($con, "SELECT wallet FROM meddolic_user_details WHERE member_id='$loginMemberId' AND wallet>='$amount'");
	if (!mysqli_num_rows($resultFund)) { ?>
		<script>
			alert("Insufficient Balance in Income Wallet to Transfer!!!");
			window.top.location.href = "mainToFund";
		</script>
	<?php
		exit;
	}

		$queryWallet = mysqli_query($con, "SELECT currentPackage FROM  meddolic_user_details WHERE member_id='$loginMemberId'");
		$valWallet = mysqli_fetch_array($queryWallet);
		$currentPackage = $valWallet[0];

	 	$queryCapping = mysqli_query($con,"SELECT cappingLimit FROM meddolic_config_package_list WHERE packageId='$currentPackage'");
		$valCapping = mysqli_fetch_assoc($queryCapping);
		$cappingLimit = $valCapping['cappingLimit'];

		// echo $cappingLimit;

		$queryCappingWithdraw = mysqli_query($con,"SELECT SUM(amount) AS totalWithdraw FROM meddolic_user_wallet_withdrawal_crypto WHERE member_id='$loginMemberId' AND released IN(0,1)");
		$valCappingWith = mysqli_fetch_assoc($queryCappingWithdraw);
		$cappingWithdrawal = $valCappingWith['totalWithdraw'];	

		// echo $cappingWithdrawal;

		$queryIncome = mysqli_query($con,"SELECT SUM(transferAmount) AS totalIncomeTransfer FROM meddolic_user_income_wallet_transfer WHERE memberId='$loginMemberId' ");
		$valIncome = mysqli_fetch_assoc($queryIncome);
		$totalTransfer = $valIncome['totalIncomeTransfer'];

        $queryDirect=mysqli_query($con,"SELECT COUNT(1) FROM meddolic_user_details WHERE sponser_id='$loginMemberId' AND topup_flag=1");
	    $valDirect=mysqli_fetch_array($queryDirect);
	    $totalDirect=$valDirect[0];
		

		$queryCharge = mysqli_query($con, "SELECT p2pTransferCharge,directNeed FROM meddolic_config_misc_setting");
		$valCharge = mysqli_fetch_assoc($queryCharge);
		$TransferCharg = $valCharge['p2pTransferCharge'];
		$directNeed = $valCharge['directNeed'];

		$totalCapping=$cappingWithdrawal+$totalTransfer;
		// echo $totalCapping;

		$finalCapping=$cappingLimit-$totalCapping;
		// echo $finalCapping;
		if($amount>$finalCapping){?>
			<script>
				alert("Cappng is Over Need to Upgrade Your Account...!!!");
				window.top.location.href = "mainToFund";
			</script>
		<?php
			exit;
		}
		
		
		$Charge=$amount*$TransferCharg / 100;
		$netAmount = $amount - $Charge;
		
		if($totalDirect<$directNeed){?>
		 <script>
			alert("Need to Give <?=$directNeed?> Direct to Transfer ");
			history.go(-1);
		</script>
		<?php
			exit;
			}

	mysqli_query($con, "UPDATE meddolic_user_details SET wallet=wallet-'$amount',fundWallet=fundWallet+'$netAmount' WHERE member_id='$loginMemberId'");

	$queryIn = mysqli_query($con, "INSERT INTO meddolic_user_income_wallet_transfer(`memberId`,`transferAmount`,`transferCharge`,`depositAmount`,`transferDate`,`incomeWallet`,`fundWallet`) VALUES ('$loginMemberId','$amount','$Charge','$netAmount','$d','$incomeWallet','$fundWallet')");
	$trfId = $con->insert_id;

	mysqli_query($con, "INSERT INTO meddolic_user_wallet_statement (`member_id`,`wallet_statement_id`,`deb_cr`,`amount`,`date_time`,`trn_id`) VALUES ('$loginMemberId',9,1,'$amount','$d','$trfId')"); ?>
	<script>
		alert("Fund Transfer Successfully!!!");
		window.top.location.href = "mainToFund";
	</script>
<?php } ?>
<?php include("../close-connection.php"); ?>