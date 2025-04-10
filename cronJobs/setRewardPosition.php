<?php  
    require_once("../conection.php");
    require_once('../User/authIncomeFunction.php'); 
    $d=date("Y-m-d H:i:s");
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 50000);
    $todayDate=date("Y-m-d");
    
$queryUser=mysqli_query($con,"SELECT member_id,currentReward FROM meddolic_user_details WHERE topupFlag=1 ORDER BY member_id ASC");
while($valUser=mysqli_fetch_assoc($queryUser)){
    $memberId=$valUser['member_id'];
    $currentReward=$valUser['currentReward'];
    $nextReward=$currentReward+1;

    $queryRe=mysqli_query($con,"SELECT teamBusiness,selfPackage,monthlyIncome,perDayIncome FROM meddolic_config_reward_income WHERE rewardId='$nextReward'");
    $valRe=mysqli_fetch_assoc($queryRe);
    $teamBusiness=$valRe['teamBusiness'];
    $selfPackage=$valRe['selfPackage'];
    $monthlyIncome=$valRe['monthlyIncome'];
    $perDayIncome=$valRe['perDayIncome'];
    rewardRelease($con,$memberId,$nextReward,$teamBusiness,$selfPackage,$monthlyIncome,$perDayIncome,$d);

} echo "Done"; ?>
<?php include("../close-connection.php");?>
