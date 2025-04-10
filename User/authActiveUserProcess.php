<?php
include("loginCheck.php");
require_once('../PHPMailer/EncrptyModel.php');
require_once('authIncomeFunction.php');
if (isset($_POST['startInvest'])) {
    $user_id1 = $_POST['sponser_id'];
    $loginMemberId = $_POST['loginMemberId'];
    $trnPassword = $_POST['trnPassword'];
    $packageId = $_POST['packageId'];
    $d = date("Y-m-d H:i:s");
    $todayDate = date("Y-m-d");

    $resultUser = mysqli_query($con, "SELECT * FROM meddolic_user_details WHERE user_id='$user_id1' AND user_type=2");
    if (!mysqli_num_rows($resultUser)) { ?>
        <script>
            alert("Invalid User Id!!!");
            window.top.location.href = "activateMember";
        </script>
    <?php
        exit;
    }
    // $queryNew = mysqli_query($con, "SELECT currentPackage FROM meddolic_user_details WHERE user_id='$user_id1'");
    // $valNew = mysqli_fetch_assoc($queryNew);
    // if ($valNew['currentPackage'] == 2) { ?>
    //     <script>
    //         alert("Already Active User Id!!!");
    //         window.top.location.href = "activateMember";
    //     </script>
    // <?php
    //     exit;
    // }
    $newCalObj121 = new passEncrypt;
    $encTrnPass = $newCalObj121->twoPassEncrypt($trnPassword);
    $queryCheck = mysqli_query($con, "SELECT COUNT(1) FROM meddolic_user_details WHERE member_id='$loginMemberId' AND trnPassword='$encTrnPass'");
    $valCheck = mysqli_fetch_array($queryCheck);
    if ($valCheck[0] == 0) { ?>
        <script>
            alert("Incorrect Transaction Password!!!");
            window.top.location.href = 'activateMember';
        </script>
    <?php
        exit;
    }
    $queryIncome = mysqli_query($con, "SELECT packagePrice FROM meddolic_config_package_list WHERE packageId='$packageId'");
    $valIncome = mysqli_fetch_assoc($queryIncome);
    $packagePrice = $valIncome['packagePrice'];


    $queryWallet = mysqli_query($con, "SELECT fundWallet FROM meddolic_user_details WHERE member_id='$loginMemberId'");
    $valWallet = mysqli_fetch_array($queryWallet);
    $currentWallet = $valWallet[0];
    if ($currentWallet <= 0) { ?>
        <script>
            alert("Insufficient Balance in Wallet to Purchase");
            window.top.location.href = "activateMember";
        </script>
    <?php
        exit;
    }
    if ($currentWallet < $packagePrice) { ?>
        <script>
            alert("Insufficient Balance in Wallet to Purchase");
            window.top.location.href = "activateMember";
        </script>
    <?php
        exit;
    }
    $queryDetails = mysqli_query($con, "SELECT a.member_id,a.sponser_id,a.topup_flag,a.currentReward,a.currentPackage,b.poolEntry,b.topup_flag AS sponserTop,b.activation_date,b.packageType,b.boosterStatus FROM meddolic_user_details a, meddolic_user_details b WHERE a.user_id='$user_id1' AND a.sponser_id=b.member_id");
    $valDetails = mysqli_fetch_assoc($queryDetails);
    $memberId = $valDetails['member_id'];
    $sponserId = $valDetails['sponser_id'];
    $topupFlag = $valDetails['topup_flag'];
    $currentPackage = $valDetails['currentPackage'];
    $currentReward=$valDetails['currentReward'];
    $nextReward=$currentReward+1;
    $sponserTop = $valDetails['sponserTop'];
    $poolEntry=$valDetails['poolEntry'];
    $activeDate = $valDetails['activation_date'];
    $sponserPackType = $valDetails['packageType'];
    $boosterStatus=$valDetails['boosterStatus']; 


    $queryBuy = mysqli_query($con, "SELECT COUNT(1) FROM meddolic_user_activation_details WHERE member_id='$memberId' AND packageId='$packageId'");
    $valBuy = mysqli_fetch_array($queryBuy);
    if ($valBuy[0] > 0) {
    ?>
        <script>
            alert("Already Purchase This Pacakge!!!");
            window.top.location.href = "activateMember";
        </script>
<?php
        exit;
    }

    //Wallet Add & Statement Add Code Starts//
    function income($con, $memberId, $trnId, $incomeAmount, $statementId, $d)
    {
        mysqli_query($con, "INSERT INTO meddolic_user_wallet_statement (`member_id`,`wallet_statement_id`,`deb_cr`,`amount`,`date_time`,`trn_id`) VALUES ('$memberId','$statementId',2,'$incomeAmount','$d','$trnId')");
        mysqli_query($con, "UPDATE meddolic_user_details SET wallet=wallet+'$incomeAmount' WHERE member_id='$memberId'");
    }
    // Wallet Add & Statement Add Code Ends//


    //Activation & Update Code Starts//    
    if ($topupFlag == 0) {
        mysqli_query($con, "UPDATE meddolic_user_details SET topup_flag=1,activation_date='$d',currentPackage='$packageId' WHERE member_id='$memberId'");
        mysqli_query($con, "UPDATE meddolic_user_child_ids SET topup_status=1,topup_date='$d' WHERE child_id='$memberId'");
    }
    $queryIn = mysqli_query($con,"INSERT INTO meddolic_user_activation_details (`member_id`,`sponser_id`,`packageId`,`investPrice`,`date_time`,`activate_by`) VALUES ('$memberId','$sponserId','$packageId','$packagePrice','$d','$loginMemberId')");
    $purchaseId = $con->insert_id;
    mysqli_query($con, "UPDATE meddolic_user_details SET fundWallet=fundWallet-'$packagePrice' WHERE member_id='$loginMemberId'");
    mysqli_query($con, "INSERT INTO meddolic_user_wallet_statement (`member_id`,`wallet_statement_id`,`deb_cr`,`amount`,`date_time`,`trn_id`) VALUES ('$loginMemberId',7,1,'$packagePrice','$d','$purchaseId')");
    //Activation & Update Code Ends
    mysqli_query($con, "UPDATE meddolic_user_details SET poolEntry='$packageId',currentPackage='$currentPackage'+1 WHERE member_id='$memberId'");
    

    //Level Income Code Starts
    releaseLevelIncome($con,$memberId,$packagePrice,$packageId,$purchaseId,$d);
    //Level Income Code Ends  

    //Auto Pool Entry Code Starts
    $queryRate = mysqli_query($con, "SELECT packageId,packagePrice,reEntryId FROM meddolic_config_package_list WHERE packageId='$packageId' ");
    $valRate = mysqli_fetch_assoc($queryRate);
    $poolId = $valRate['packageId'];
    $upgradePrice = $valRate['packagePrice'];
    $reEntryId = $valRate['reEntryId'];


    for ($i = 0; $i < $reEntryId; $i++) {
        $queryOld = mysqli_query($con, "SELECT COUNT(1) FROM meddolic_user_pool_entry_details WHERE memberId='$memberId'");
        $valOld = mysqli_fetch_array($queryOld);
        $oldCount = $valOld[0] + 1;
        $queryIn = mysqli_query($con, "INSERT INTO meddolic_user_pool_entry_details (`memberId`,`entryDate`,`reEntryCount`) VALUES ('$memberId','$d','$oldCount')");
        $entryId = $con->insert_id;
        poolTreeEntry($con, $memberId, $d, $entryId);
    }
    
    
        for ($i = 0; $i < $reEntryId; $i++) {
            $queryboardOld=mysqli_query($con,"SELECT COUNT(1) FROM meddolic_user_board_entry_details WHERE memberId='$memberId'");
            $valboardOld=mysqli_fetch_array($queryboardOld);
            $oldBoardCount=$valboardOld[0]+1;
            $queryMagical=mysqli_query($con,"INSERT INTO meddolic_user_board_entry_details (`memberId`,`entryDate`,`reEntryCount`) VALUES ('$memberId','$d','$oldBoardCount')");
            $magicalentryId = $con->insert_id;
            magicalPlaceholderSet($con,$memberId,$magicalentryId,$d);
        }
        if($poolId == 1) {
        $querySponserOld = mysqli_query($con, "SELECT COUNT(1) FROM meddolic_user_board_entry_details WHERE memberId='$sponserId'");
        $valSponserOld = mysqli_fetch_array($querySponserOld);
        $oldSponserBoardCount = $valSponserOld[0] + 1;

    $queryMagicalBoost=mysqli_query($con,"INSERT INTO meddolic_user_board_entry_details (`memberId`,`entryDate`,`reEntryCount`) VALUES ('$sponserId','$d','$oldSponserBoardCount')");
    $boostentryId = $con->insert_id;
    magicalPlaceholderSet($con,$sponserId,$boostentryId,$d);
        }
   
    
   if($nextReward<=3){
        $queryReward=mysqli_query($con,"SELECT directNeed,rewardIncome,rewardMonth,level FROM meddolic_config_reward_income WHERE rewardId='$nextReward'");
        $valReward=mysqli_fetch_assoc($queryReward);
        $directNeed=$valReward['directNeed'];
        $rewardIncome=$valReward['rewardIncome'];
        $rewardMonth=$valReward['rewardMonth'];
        $level=$valReward['level'];
        rewardReleaseSet($con,$memberId,$nextReward,$directNeed,$rewardIncome,$d,$rewardMonth,$level);
    }
    //Reward Income Check Code Starts//
        relayRewardLoop($con,$memberId,$d);
    //Reward Income Check Code Ends//

    // echo "<script>alert('Account Activated Successfully!!!');window.top.location.href='activationHistory';</script>";
} ?>
<?php include("../close-connection.php"); ?>