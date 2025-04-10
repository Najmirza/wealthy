<?php
include("loginCheck.php");
require_once('../PHPMailer/EncrptyModel.php');
require_once('authIncomeFunction.php');

// Boosting Board Placeholder Update Code Starts
if (isset($_POST['booster'])) {
    $memberId = $_POST['loginMemberId'];
    $boostingAmount = $_POST['boostingAmount'];
    $trnPassword = $_POST['trnPassword'];
    $d = date("Y-m-d H:i:s");
    $todayDate = date("Y-m-d");

    
    // Check if the member has already boosted 2 times in the last 24 hours
    $queryBoostCount =mysqli_query($con,"SELECT COUNT(*) FROM meddolic_user_booster_details WHERE member_id='$memberId' AND boostingDate >= DATE_SUB(NOW(), INTERVAL 1 DAY)");
    $boostCount = mysqli_fetch_array($queryBoostCount)[0];
    if ($boostCount >= 2) {
        ?>
        <script>
            alert("You have already boosted 2 times in the last 24 hours. Better luck next day!");
            window.top.location.href = 'authBooster';
        </script>
        <?php
        exit;
    }

    // Check the transaction password
    $newCalObj121 = new passEncrypt;
    $encTrnPass = $newCalObj121->twoPassEncrypt($trnPassword);
    $queryCheck = mysqli_query($con, "SELECT COUNT(1) FROM meddolic_user_details WHERE member_id='$memberId' AND trnPassword='$encTrnPass'");
    $valCheck = mysqli_fetch_array($queryCheck);
    if ($valCheck[0] == 0) { ?>
        <script>
            alert("Incorrect Transaction Password!!!");
            window.top.location.href = 'authBooster';
        </script>
    <?php
        exit;
    }

    $queryWallet = mysqli_query($con, "SELECT fundWallet FROM meddolic_user_details WHERE member_id='$memberId'");
    $valWallet = mysqli_fetch_array($queryWallet);
    $currentWallet = $valWallet[0];
    if ($currentWallet <= 0) { ?>
        <script>
            alert("Insufficient Balance in Wallet to Purchase");
            window.top.location.href = "authBooster";
        </script>
    <?php
        exit;
    }
    if ($currentWallet < $boostingAmount) { ?>
        <script>
            alert("Insufficient Balance in Wallet to Purchase");
            window.top.location.href = "authBooster";
        </script>
    <?php
        exit;
    }

        $queryboardOld=mysqli_query($con,"SELECT COUNT(1) FROM meddolic_user_board_entry_details WHERE memberId='$memberId'");
        $valboardOld=mysqli_fetch_array($queryboardOld);
        $oldBoardCount=$valboardOld[0]+1;
        $queryMagical=mysqli_query($con,"INSERT INTO meddolic_user_board_entry_details (`memberId`,`entryDate`,`reEntryCount`) VALUES ('$memberId','$d','$oldBoardCount')");

        $magicalentryId = $con->insert_id;
        magicalPlaceholderSet($con,$memberId,$magicalentryId,$d);

    // Insert the boost details
    $queryIn = mysqli_query($con,"INSERT INTO meddolic_user_booster_details (`member_id`,`boostingAmount`,`boostingDate`) VALUES ('$memberId','$boostingAmount','$d')");
    mysqli_query($con, "UPDATE meddolic_user_details SET fundWallet=fundWallet-'$boostingAmount' WHERE member_id='$memberId'");


    if ($queryIn) {
        echo "<script>alert('Id Boosted Successfully!!!');window.top.location.href='authBooster';</script>";
    }
}
?>
