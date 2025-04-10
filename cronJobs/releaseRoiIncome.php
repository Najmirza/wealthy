<?php include("../conection.php");
require_once('../User/authIncomeFunction.php');
$d = date("Y-m-d H:i:s");
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 50000);
$todayDate = date("Y-m-d");

$queryNo = mysqli_query($con, "SELECT a.member_id,a.packageId,a.packagePrice,a.dueDate,a.summary_id,b.account_status FROM meddolic_user_cashback_income_summary a, meddolic_user_details b WHERE a.member_id=b.member_id AND a.dueDate<='$d' ORDER BY a.packageId ASC");
while ($valNo = mysqli_fetch_assoc($queryNo)) {
    $memberId = $valNo['member_id'];
    $packageId = $valNo['packageId'];
    $packagePrice = $valNo['packagePrice'];
    $summary_id = $valNo['summary_id'];
    $dueDate = $valNo['dueDate'];
    $acctStatus = $valNo['account_status'];

    $queryConfig = mysqli_query($con, "SELECT roiPercent FROM meddolic_config_roi_income WHERE packageId='$packageId'");
    $valConfig = mysqli_fetch_assoc($queryConfig);
    $roiPercent = $valConfig['roiPercent'];

    // $totalGet = userIncomeGet($con, $memberId, $primaryId);
    $finalRoiIn =  ($packagePrice * $roiPercent) / 100;

    $queryLv = mysqli_query($con, "INSERT INTO meddolic_user_cashback_income_details (`summary_id`,`member_id`,`incomeAmount`,`date_time`) VALUES ('$summary_id','$memberId','$finalRoiIn','$d')");
    $roiIncomeId = $con->insert_id;
    incomeEntry($con, $memberId, $roiIncomeId, $finalRoiIn, 2, $dueDate);
    $nextDueDate = date('Y-m-d H:i:s', strtotime($dueDate . ' +5 minute'));
    mysqli_query($con, "UPDATE meddolic_user_cashback_income_summary SET dueDate='$nextDueDate' WHERE member_id='$memberId' AND packageId='$packageId'");
    if ($newRestBal <= 0) {
        mysqli_query($con, "UPDATE meddolic_user_invest_income_summary SET investStatus=2 WHERE memberId='$memberId' AND package_id='$primaryId'");
    }
}
echo "Done"; ?>
<?php include("../close-connection.php"); ?>