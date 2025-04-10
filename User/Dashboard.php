<!DOCTYPE html>
<html lang="en">

<?php
require_once("loginCheck.php");
require_once('Include/Head.php');
require_once('Include/Header.php');
require_once('Include/Menu.php'); ?>

<?php
$todayDate = date('Y-m-d');
$d = date('Y-m-d H:i:s');
$queryGe = mysqli_query($con, "SELECT member_id,wallet,topup_flag,activation_date,fundWallet,date_time,currentPackage,currentReward,sponser_id FROM meddolic_user_details WHERE user_id='$userId'");
$valGe = mysqli_fetch_assoc($queryGe);
$memberId = $valGe['member_id'];
$incomeWallet = $valGe['wallet'];
$topupFlag = $valGe['topup_flag'];
$fundWallet = $valGe['fundWallet'];
$activationDate = $valGe['activation_date'];
$joinDate = $valGe['date_time'];
$currentPackage = $valGe['currentPackage'];
$currentReward = $valGe['currentReward'];
$sponser_id = $valGe['sponser_id'];

$querySponser=mysqli_query($con,"SELECT user_id FROM meddolic_user_details WHERE member_id='$sponser_id'");
$valSponserId=mysqli_fetch_assoc($querySponser);
$sponserUserId=$valSponserId['user_id'];

if ($currentReward > 0) {
	$queryRank = mysqli_query($con, "SELECT rewardName FROM meddolic_config_reward_income WHERE rewardId='$currentReward'");
	$valRank = mysqli_fetch_assoc($queryRank);
	$rankName = $valRank['rewardName'];
} else {
	$rankName = 'NA';
}




$queryInvest = mysqli_query($con, "SELECT SUM(investPrice) FROM meddolic_user_activation_details WHERE member_id='$memberId'");
$valInvest = mysqli_fetch_array($queryInvest);
$totalInvestment = $valInvest[0];


$queryboard = mysqli_query($con, "SELECT SUM(boardIncome) FROM meddolic_user_boosting_board_income WHERE memberId='$memberId' ");
$valboard = mysqli_fetch_array($queryboard);
$boosterBoardIncome = $valboard[0];

$queryLevel =mysqli_query($con,"SELECT SUM(levelIncome) FROM meddolic_user_level_income WHERE memberId='$memberId' AND level>= 1 AND packageId=1 AND releaseStatus=1");
$valLevel = mysqli_fetch_array($queryLevel);
$levelIncome = $valLevel[0];


$queryUpgradeLevel = mysqli_query($con, "SELECT SUM(levelIncome) FROM meddolic_user_level_income WHERE memberId='$memberId' AND level>=1 AND packageId>1 AND releaseStatus=1");
$valUpgradeLevel = mysqli_fetch_array($queryUpgradeLevel);
$upgradeLevelIncome = $valUpgradeLevel[0];


$querySponser = mysqli_query($con, "SELECT COUNT(1) FROM meddolic_user_details WHERE sponser_id='$memberId'");
$valSponser = mysqli_fetch_array($querySponser);
$totalSponser = $valSponser[0];

$queryDirect = mysqli_query($con, "SELECT COUNT(1) FROM meddolic_user_details where sponser_id='$memberId' AND topup_flag=1");
$valDirect = mysqli_fetch_array($queryDirect);
$activeSponser = $valDirect[0];

$queryInDirect = mysqli_query($con, "SELECT COUNT(1) FROM meddolic_user_details where sponser_id='$memberId' AND topup_flag=0");
$valInDirect = mysqli_fetch_array($queryInDirect);
$inActiveSponser = $valInDirect[0];

$queryTeam = mysqli_query($con, "SELECT COUNT(1) FROM meddolic_user_child_ids WHERE member_id='$memberId'");
$valTeam = mysqli_fetch_array($queryTeam);
$totalTeam = $valTeam[0];

$queryActveTeam = mysqli_query($con, "SELECT COUNT(1) FROM meddolic_user_child_ids WHERE member_id='$memberId' AND topup_status=1");
$valActveTeam = mysqli_fetch_array($queryActveTeam);
$activeTeam = $valActveTeam[0];

$queryInActiveTeam = mysqli_query($con, "SELECT COUNT(1) FROM meddolic_user_child_ids WHERE member_id='$memberId' AND topup_status=0");
$valInActiveTeam = mysqli_fetch_array($queryInActiveTeam);
$inActiveTeam = $valInActiveTeam[0];

$queryRank = mysqli_query($con, "SELECT SUM(rewardIncome) FROM meddolic_user_reward_income_details WHERE memberId='$memberId' AND releaseStatus=1");
$valRank = mysqli_fetch_array($queryRank);
$rankIncome = $valRank[0];

$queryPool = mysqli_query($con, "SELECT SUM(poolIncome) FROM meddolic_user_pool_income WHERE memberId='$memberId' AND releaseStatus=0");
$valPool = mysqli_fetch_array($queryPool);
$poolIncome = $valPool[0];


$totalIncome = $referralIncome+$rankIncome+$levelIncome+$upgradeLevelIncome+$poolIncome+$boosterBoardIncome;



$queryWithdraw = mysqli_query($con, "SELECT SUM(amount) FROM meddolic_user_wallet_withdrawal_crypto WHERE member_id='$memberId' AND (released=1 OR released=2)");
$valWithdraw = mysqli_fetch_array($queryWithdraw);
$totalWithdraw = $valWithdraw[0];

$queryIncomeTransfer = mysqli_query($con, "SELECT SUM(transferAmount) FROM meddolic_user_income_wallet_transfer WHERE memberId='$memberId'");
$valTransfer = mysqli_fetch_array($queryIncomeTransfer);
$mainToFundTransfer = $valTransfer[0];

$queryCapping = mysqli_query($con,"SELECT cappingLimit FROM meddolic_config_package_list WHERE packageId='$currentPackage'");
$valCapping = mysqli_fetch_assoc($queryCapping);
$cappingLimit = $valCapping['cappingLimit'];


 ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="    margin-top: 120px;">
	<div class="container-full">
		<div class="col-lg-12 col-xs-12">
			<div class="form-group" align="center" style="font-size: 18px;font-weight: 600;background-color: #fff;color: #fff;">
				<label style="color:#000000;">Referral URL</label>
				<input id="referralCone" type="hidden" readonly value="https://wealthycrowd.online/authUserRegister?affiliateCode=<?= $userId ?>">
				<a style="display: inline-block;margin-top: 1px;font-weight: bold;padding: 3px 8px;border-radius: 5px;color: #fff;" href="javascript:void(0)" onclick="copyLink()" class="btn btn-sm btn-success waves-effect">
					<i class="fa fa-copy"></i>
					<span>Copy </span>
				</a>
				<a style="display: inline-block;margin-top: 1px;font-weight: bold;padding: 3px 8px;border-radius: 5px;color: #fff;" target="_blank" href="https://api.whatsapp.com/send?phone=&amp;text=https://wealthycrowd.online/authUserRegister?affiliateCode=<?= $userId ?>" class="btn btn-sm btn-success waves-effect">
					<i class="fab fa-whatsapp"></i>
					<span>Whatsapp</span>
				</a>
				<a style="display: inline-block;margin-top: 1px;font-weight: bold;padding: 3px 8px;border-radius: 5px;color: #fff;" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=https://wealthycrowd.online/authUserRegister?affiliateCode=<?= $userId ?>" class="btn btn-sm btn-primary waves-effect">
					<i class="fab fa-facebook-f"></i>
					<span>Facebook</span>
				</a>
				<a style="display: inline-block;margin-top: 1px;font-weight: bold;padding: 3px 8px;border-radius: 5px;color: #fff;" target="_blank" href="https://telegram.me/share/url?url=https://wealthycrowd.online/authUserRegister?affiliateCode=<?= $userId ?>" class="btn btn-sm btn-primary waves-effect">
					<i class="fab fa-telegram"></i>
					<span>Telegram</span></a>
			</div>
		</div>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xl-3 col-12">
					<div class="box">
						<div class="box-body">
							<div class="d-flex justify-content-between align-items-center">
								<div>
									<span class="m-0"><?= $userName ?></span>
									<h4 class="mb-0 counter"><?= $userId ?></h4>
									<h6 class="mb-0 counter"><?php if ($currentPackage == 0) echo "<span class='badge badge-danger'>INACTIVE</span>";
																else if ($currentPackage == 1) echo "<span class='badge badge-success'>ACTIVE</span>";
																else if ($currentPackage == 2) echo "<span class='badge badge-success'>SUPER ACTIVE</span>"; ?></h6>
									<h6>Joining Date :-<?=$joinDate?></h6>
									<h6>Activation Date :-<?=$activationDate?></h6>
									<h6>Sponser_id :-<?=$sponserUserId?></h6>
								</div>
								<div><i class="fa fa-podcast fs-40 BTC  m-0" aria-hidden="true"></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-12">
					<div class="box">
						<a href="totalEarning">
							<div class="box-body">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<p class="box-title mb-5">Total Earning</p>
										<h4 class="mb-0">$  <?= isset($totalIncome) ? $totalIncome : '0.00'; ?></h4>
									</div>
									<div><i class="fa fa-gift BTC fs-40" aria-hidden="true"></i></div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-12">
					<div class="box">
						<a href="rankIncome">
							<div class="box-body">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<p class="box-title mb-5">Reward Income</p>
										<h4 class="mb-0">$  <?= isset($rankIncome) ? $rankIncome : '0.00'; ?> </h4>
									</div>
									<div><i class="fa fa-link BTC fs-40" aria-hidden="true"></i></div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-12">
					<div class="box">
						<a href="autopoolIncome">
							<div class="box-body">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<p class="box-title mb-5">AutoPool Income</p>
										<h4 class="mb-0">$  <?= isset($poolIncome) ? $poolIncome : '0.00'; ?> </h4>
									</div>
									<div><i class="fa fa-download BTC fs-40" aria-hidden="true"></i></div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-12">
					<div class="box">
						<a href="#">
							<div class="box-body">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<p class="box-title mb-5">Magical Income</p>
										<h4 class="mb-0">$  <?= isset($boosterBoardIncome) ? $boosterBoardIncome : '0.00'; ?> </h4>
									</div>
									<div><i class="fa fa-link BTC fs-40" aria-hidden="true"></i></div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-12">
					<div class="box">
						<a href="walletOutstanding">
							<div class="box-body">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<p class="box-title mb-5">Income Wallet</p>
										<h4 class="mb-0">$  <?= isset($incomeWallet) ? $incomeWallet : '0.00'; ?> </h4>
									</div>
									<div><i class="fa fa-shield BTC fs-40" aria-hidden="true"></i></div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-12">
					<div class="box">
						<a href="walletOutstanding">
							<div class="box-body">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<p class="box-title mb-5">Purchase Wallet</p>
										<h4 class="mb-0">$  <?= isset($fundWallet) ? $fundWallet : '0.00'; ?> </h4>
									</div>
									<div><i class="fa fa-shield BTC fs-40" aria-hidden="true"></i></div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-12">
					<div class="box">
						<a href="levelIncome">
							<div class="box-body">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<p class="box-title mb-5">Level Income</p>
										<h4 class="mb-0"> $  <?= isset($levelIncome) ? $levelIncome : '0.00'; ?></h4>
									</div>
									<div><i class="fa fa-rocket BTC fs-40" aria-hidden="true"></i></div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-12">
					<div class="box">
						<a href="upgradelevelIncome">
							<div class="box-body">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<p class="box-title mb-5">Level Upgrade Income</p>
										<h4 class="mb-0"> $  <?= isset($upgradeLevelIncome) ? $upgradeLevelIncome : '0.00'; ?></h4>
									</div>
									<div><i class="fa fa-rocket BTC fs-40" aria-hidden="true"></i></div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-12">
					<div class="box">
						<a href="mainToFund">
							<div class="box-body">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<p class="box-title mb-5">Total Income To Fund </p>
										<h4 class="mb-0">$ <?= isset($mainToFundTransfer) ? $mainToFundTransfer : '0.00'; ?></h4>
									</div>
									<div><i class="fa fa-dollar BTC fs-40" aria-hidden="true"></i></div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-12">
					<div class="box">
						<a href="walletWithdraw">
							<div class="box-body">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<p class="box-title mb-5">Total Withdrawl</p>
										<h4 class="mb-0">$  <?= isset($totalWithdraw) ? $totalWithdraw : '0.00'; ?> </h4>
									</div>
									<div><i class="fa fa-upload BTC fs-40" aria-hidden="true"></i></div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-12">
					<div class="box">
						<a href="#">
							<div class="box-body">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<p class="box-title mb-5">Total Capping</p>
										<h4 class="mb-0">$ <?= isset($cappingLimit) ? $cappingLimit : '0.00'; ?></h4>
									</div>
									<div><i class="fa fa-ban BTC fs-40" aria-hidden="true"></i></div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-12">
					<div class="box">
						<a href="activationHistory">
							<div class="box-body">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<p class="box-title mb-5">Total Self Investment</p>
										<h4 class="mb-0">$ <?= isset($totalInvestment) ? $totalInvestment : '0.00'; ?></h4>
									</div>
									<div><i class="fa fa-dollar BTC fs-40" aria-hidden="true"></i></div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-12">
					<div class="box">
						<a href="#">
							<div class="box-body">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<p class="box-title mb-5">Current Reward Name</p>
										<h4 class="mb-0">  <?= $rankName ?></h4>
									</div>
									<div><i class="fa fa-gift BTC fs-40" aria-hidden="true"></i></div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-12">
					<div class="box">
						<a href="levelTeam">
						<div class="box-body">
							<div class="d-flex justify-content-between align-items-center">
								<div class="media-body text-center"><span class="m-0">Total Team</span>
									<h4 class="mb-0 counter"><i class="fa fa-users"></i> <?= isset($totalTeam) ? $totalTeam : '0'; ?></h4>
									<div class="row">
										<div class="col b-r-light"><span>Active</span>
											<h4 class="counter mb-0"><?= isset($activeTeam) ? $activeTeam : '0'; ?></h4>
										</div>
										<div class="col"><span>In-Active</span>
											<h4 class="counter mb-0"><?= isset($inActiveTeam) ? $inActiveTeam : '0'; ?></h4>
										</div>
									</div>
								</div>
							</div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-12">
					<div class="box">
						<a href="refferalTeam">
						<div class="box-body">
							<div class="d-flex justify-content-between align-items-center">

								<div class="media-body text-center"><span class="m-0">Total Referrals</span>
									<h4 class="mb-0 counter"><i class="fa fa-users"></i> <?= isset($totalSponser) ? $totalSponser : '0'; ?></h4>
									<div class="row">
										<div class="col b-r-light"><span>Active</span>
											<h4 class="counter mb-0"><?= isset($activeSponser) ? $activeSponser : '0'; ?></h4>
										</div>
										<div class="col"><span>In-Active</span>
											<h4 class="counter mb-0"><?= isset($inActiveSponser) ? $inActiveSponser : '0'; ?></h4>
										</div>
									</div>
								</div>
							</div>
						</div>
						</a>
					</div>
				</div>
			</div>
	</div>
	</section>

	<button type="button" id="modalShow" style="display:none;" data-bs-toggle="modal" data-bs-target="#welcomeNotice" class="btn btn-primary">Show</button>
	<?php $queryConfig = mysqli_query($con, "SELECT dashboardImage,imageStatus FROM meddolic_config_misc_setting");
	$valConfig = mysqli_fetch_assoc($queryConfig); ?>
	<div id="welcomeNotice" class="modal animated fadeInLeft custo-fadeInLeft" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<center><img src="../<?= $valConfig['dashboardImage'] ?>" width="100%"></center>
				</div>
			</div>
		</div>
	</div>
	<!-- /.content -->
</div>
</div>
<?php require_once('Include/Footer.php'); ?>
<script>
	function copyLink() {
		var link = $("#referralCone").val();
		var tempInput = document.createElement("input");
		tempInput.style = "position: absolute; left: -1000px; top: -1000px";
		tempInput.value = link;
		document.body.appendChild(tempInput);
		tempInput.select();
		document.execCommand("copy");
		alert('Referral Link Copied Successfully');
	}

	function popMsg() {
		<?php if ($valConfig['imageStatus'] == 1) { ?>
			$('#modalShow').click();
		<?php } ?>
	}
	window.load = popMsg();
	var d = document.getElementById("dashboard");
	d.className += " active";
</script>
</body>

</html>