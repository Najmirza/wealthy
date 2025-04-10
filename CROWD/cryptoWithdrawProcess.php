<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Kolkata');
include("loginCheck.php");

if (isset($_POST['addEditRemark'])) {
    $d = date('Y-m-d H:i:s');
    $id = $_POST['id'];
    $member_id = $_POST['member_id'];
    $withdrawStatus = $_POST['withdrawStatus'];
    $remarks = $_POST['remarks'];
    $from_date = $_POST['fromDate'];
    $to_date = $_POST['toDate'];
    $user_id = $_POST['userId'];

    $result1 = mysqli_query($con, "UPDATE meddolic_user_wallet_withdrawal_crypto SET remarks='$remarks',payment_date='$d',released='$withdrawStatus' WHERE id='$id'");

    $queryDetails = mysqli_query($con, "SELECT amount FROM meddolic_user_wallet_withdrawal_crypto WHERE id='$id'");
    $valDetails = mysqli_fetch_assoc($queryDetails);
    $withdrawAmount = $valDetails['amount'];

    if ($withdrawStatus == 3) {
        mysqli_query($con, "UPDATE meddolic_user_details SET wallet=wallet+'$withdrawAmount' WHERE member_id='$member_id'");

        mysqli_query($con, "INSERT INTO  meddolic_user_wallet_statement (`member_id`,`wallet_statement_id`,`deb_cr`,`amount`,`date_time`,`trn_id`) VALUES ('$member_id',11,1,'$withdrawAmount','$d','$id')");
    }
    if ($result1) { ?>
        <script>
            alert("Action Taken Successfully!!!");
            window.top.location.href = 'walletWithdrawInr';
        </script>
<?php }
} ?>
<?php include("../close-connection.php"); ?>