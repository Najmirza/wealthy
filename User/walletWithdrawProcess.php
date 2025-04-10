<?php
include("loginCheck.php");
if (isset($_POST['walletWithdraw'])) {
	 $memberId = $_POST['memberId'];
	$withdraw_amount = $_POST['investmentAmount'];
	$minimumPayout=$_POST['minimumPayout'];
	$trnPassword=$_POST['trnPassword'];
	$paymentId = $_POST['paymentId'];
	$emailOtp = $_POST['emailOtp'];
	$actualOtp = $_SESSION['withdrawOTP'];
	$d = date("Y-m-d H:i:s");
	$todayDate = date('Y-m-d');

	$newCalObj121 = new passEncrypt;
    $encTrnPass = $newCalObj121->twoPassEncrypt($trnPassword);
    $queryCheck = mysqli_query($con, "SELECT COUNT(1) FROM meddolic_user_details WHERE member_id='$memberId' AND trnPassword='$encTrnPass'");
    $valCheck = mysqli_fetch_array($queryCheck);
    if ($valCheck[0] == 0) { ?>
        <script>
            alert("Incorrect Transaction Password!!!");
            window.top.location.href = 'walletWithdraw';
        </script>
    <?php
        exit;
    }

	 if($withdraw_amount<$minimumPayout){ ?>
	 <script>
		alert("The Minimum withdraw amount is $ <?= $minimumPayout; ?>");
		history.go(-1);
	</script>
	 <?php
		exit;
		 }

		
		$result=mysqli_query($con,"SELECT COUNT(1) FROM meddolic_user_wallet_withdrawal_crypto WHERE member_id='$memberId' AND CAST(withdrawal_date AS date)='$todayDate' AND (released=1 OR released=0)  ");
		$val=mysqli_fetch_array($result);
		if($val[0]>=1){ 
		?>
	 <script>
		alert("The Maximun Withdraw Limit Reached today");
		history.go(-1);	
	</script>
	 <?php
		exit;
		}

		$queryWallet = mysqli_query($con, "SELECT wallet,currentPackage FROM  meddolic_user_details WHERE member_id='$memberId'");
		$valWallet = mysqli_fetch_array($queryWallet);
		$currentWallet = $valWallet[0];
		$currentPackage = $valWallet[1];
		if ($currentWallet < $withdraw_amount) { ?>
		<script>
			alert("Insufficient Balance in Your Wallet To Withdraw");
			history.go(-1);
		</script>
	<?php
		exit;
		}

		$queryCapping = mysqli_query($con,"SELECT cappingLimit FROM meddolic_config_package_list WHERE packageId='$currentPackage'");
		$valCapping = mysqli_fetch_assoc($queryCapping);
		$cappingLimit = $valCapping['cappingLimit'];

		$queryCappingWithdraw = mysqli_query($con,"SELECT SUM(amount) AS totalWithdraw FROM meddolic_user_wallet_withdrawal_crypto WHERE member_id='$memberId' AND released IN(0,1)");
		$valCappingWith = mysqli_fetch_assoc($queryCappingWithdraw);
		$cappingWithdrawal = $valCappingWith['totalWithdraw'];

		$queryCappingWithdraw = mysqli_query($con,"SELECT SUM(transferAmount) AS totalIncomeTransfer FROM meddolic_user_income_wallet_transfer WHERE memberId='$memberId' ");
		$valCappingWith = mysqli_fetch_assoc($queryCappingWithdraw);
		$totalTransfer = $valCappingWith['totalIncomeTransfer'];

		$totalCapping=$cappingWithdrawal+$totalTransfer;

		 $finalCapping=$cappingLimit-$totalCapping;
		if($withdraw_amount>$finalCapping){?>
			<script>
				alert("Cappng is Over Need to Upgrade Your Account...!!!");
				window.top.location.href = "walletWithdraw";
			</script>
		<?php
			exit;

		}

	 	$queryDirect=mysqli_query($con,"SELECT COUNT(1) FROM meddolic_user_details WHERE sponser_id='$memberId' AND topup_flag=1");
	  	$valDirect=mysqli_fetch_array($queryDirect);
	  	$totalDirect=$valDirect[0];

		$orderId = rand(11101, 99999) . $memberId . date('s') . date('h');

		$queryCharge = mysqli_query($con, "SELECT withdrawCharge,directNeed FROM meddolic_config_misc_setting");
		$valCharge = mysqli_fetch_assoc($queryCharge);
		$withdrawCharg = $valCharge['withdrawCharge'];
		$directNeed = $valCharge['directNeed'];

		$Charge = $withdraw_amount * $withdrawCharg / 100;
		$netAmount = $withdraw_amount - $Charge;
		

		if($totalDirect<$directNeed){?>
		 <script>
			alert("Need to Give <?=$directNeed?> Direct to Withdraw");
			history.go(-1);
		</script>
		<?php
			exit;
			}


		$queryIn = mysqli_query($con, "INSERT INTO meddolic_user_wallet_withdrawal_crypto (`member_id`,`withdrawal_date`,`date_time`,`amount`,`withdrawCharge`,`netAmount`,`orderid`,`paymentId`) VALUES ('$memberId','$todayDate','$d','$withdraw_amount','$Charge','$netAmount','$orderId','$paymentId')");
		$lastWithdraw = $con->insert_id;
		mysqli_query($con, "UPDATE meddolic_user_details SET wallet=wallet-'$withdraw_amount' WHERE member_id='$memberId'");
		mysqli_query($con, "INSERT INTO meddolic_user_wallet_statement (`member_id`,`wallet_statement_id`,`deb_cr`,`amount`,`date_time`,`trn_id`) VALUES ('$memberId',11,1,'$withdraw_amount','$d','$lastWithdraw')"); ?>
	<script>
		alert("Wallet Withdraw Successfully");
		window.top.location.href = "walletWithdraw";
	</script>
<?php } ?>
<?php include("../close-connection.php"); ?>