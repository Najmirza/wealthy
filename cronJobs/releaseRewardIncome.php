
<?php  
    require_once("../conection.php");
    require_once('../User/authIncomeFunction.php'); 
    $d=date("Y-m-d H:i:s");
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 50000);
    $todayDate=date("Y-m-d");

    
  $queryReward=mysqli_query($con,"SELECT summaryId,memberId,rewardId,rewardIncome,dueDate FROM meddolic_user_reward_income_summary WHERE rewardStatus=1  AND dueDate<='$d' ORDER BY summaryId ASC");
while($valNo=mysqli_fetch_assoc($queryReward)){
    $summaryId=$valNo['summaryId'];
    $memberId=$valNo['memberId'];
    $rewardId=$valNo['rewardId'];
    $rewardIncome=$valNo['rewardIncome'];
    $dueDate=$valNo['dueDate'];

    $queryNew=mysqli_query($con,"INSERT INTO meddolic_user_reward_income_details (summaryId,memberId,rewardId,rewardIncome,releaseDate) VALUES ('$summaryId','$memberId','$rewardId','$rewardIncome','$dueDate')");
    $rewardInId=$con->insert_id;
    incomeEntry($con,$memberId,$rewardInId,$rewardIncome,15,$dueDate);
    
        $nextDueDate = date('Y-m-01 00:00:00', strtotime('+1 month', strtotime($dueDate)));

    mysqli_query($con,"UPDATE meddolic_user_reward_income_summary SET dueDate='$nextDueDate' WHERE memberId='$memberId' AND summaryId='$summaryId'");
} echo "Done"; ?>
<?php include("../close-connection.php");?>
