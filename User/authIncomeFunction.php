<?php
//Wallet Add & Statement Add Code Starts//
function incomeEntry($con, $memberId, $trnId, $incomeAmount, $statementId, $d)
{
    mysqli_query($con, "INSERT INTO meddolic_user_wallet_statement (`member_id`,`wallet_statement_id`,`deb_cr`,`amount`,`date_time`,`trn_id`) VALUES ('$memberId','$statementId',2,'$incomeAmount','$d','$trnId')");
    mysqli_query($con, "UPDATE meddolic_user_details SET wallet=wallet+'$incomeAmount' WHERE member_id='$memberId'");
}
//Wallet Add & Statement Add Code Ends//

//Level Income Code Start
function releaseLevelIncome($con,$memberId,$packagePrice,$packageId,$purchaseId,$d){
    $queryMain=mysqli_query($con,"SELECT a.member_id,a.level,b.poolEntry FROM meddolic_user_child_ids a, meddolic_user_details b WHERE a.child_id='$memberId' AND a.member_id=b.member_id AND a.level<=10 AND b.topup_flag=1 AND b.account_status=1");
    while($valMain=mysqli_fetch_assoc($queryMain)){
      $parentId=$valMain['member_id'];
      $level=$valMain['level'];
      $poolEntry=$valMain['poolEntry'];
      // if($poolEntry>=$packageId){
        $queryIncome = mysqli_query($con, "SELECT levelIncome,directNeed FROM meddolic_config_level_income WHERE level='$level' AND poolId='$packageId'");
        $valIncome = mysqli_fetch_assoc($queryIncome);
        $levelIncome = $valIncome['levelIncome'];
        $directNeed = $valIncome['directNeed'];      
        $queryDirect = mysqli_query($con, "SELECT COUNT(1) FROM meddolic_user_details where sponser_id='$parentId' AND topup_flag=1");
        $valDirect = mysqli_fetch_array($queryDirect);
        $totalDirect = $valDirect[0];
        if($totalDirect>=$directNeed){
        $queryIn =mysqli_query($con,"INSERT INTO meddolic_user_level_income (`memberId`,`childId`,`levelIncome`,`level`,`packagePrice`,`packageId`,`dateTime`) VALUES ('$parentId','$memberId','$levelIncome','$level','$packagePrice','$packageId','$d')");
          $levelInId=$con->insert_id;
          if ($level == 1) {
            $statementId = 15;
          } else {
            $statementId = 1;
          }
          incomeEntry($con,$parentId,$levelInId,$levelIncome,$statementId, $d);
        }
      
    }
  }
  //Level Income Code End

// Placeholder Update Code Starts//

function placeholderSet($con,$placeholderId,$legPosition,$memberId,$entryId,$d,$nextEntryId){
  if($entryId!=$nextEntryId){
    mysqli_query($con,"UPDATE meddolic_user_pool_entry_details SET placeholderId='$placeholderId',legPosition='$legPosition',parentEntryId='$nextEntryId' WHERE memberId='$memberId' AND entryId='$entryId'");
    $newParId=$entryId;
    //Child ID Code Starts//
    $queryMain=mysqli_query($con,"SELECT a.placeholderId,a.legPosition,b.entryId,b.parentEntryId FROM meddolic_user_pool_entry_details a, meddolic_user_pool_entry_details b WHERE a.memberId='$memberId' AND a.placeholderId=b.memberId AND a.entryId='$newParId' AND b.entryId='$nextEntryId'");
    $valMain=mysqli_fetch_array($queryMain);
    $parentId=$valMain[0];
    $legPosition=$valMain[1];
    $newParId=$valMain[2];
    $nextEntryId=$valMain[3];
    $level=1;
    while($parentId && $level<=10){
      mysqli_query($con,"INSERT INTO meddolic_user_pool_placeholder_details (`member_id`,`child_id`,`leg_position`,`level`,`parentEntryId`,`entryId`,`date_time`) VALUES ('$parentId','$memberId','$legPosition','$level','$newParId','$entryId','$d')");

      $queryMaal=mysqli_query($con,"SELECT a.placeholderId,a.legPosition,b.entryId,b.parentEntryId FROM meddolic_user_pool_entry_details a, meddolic_user_pool_entry_details b WHERE a.memberId='$parentId' AND a.placeholderId=b.memberId AND a.entryId='$newParId' AND b.entryId='$nextEntryId'");
      $valMaal=mysqli_fetch_array($queryMaal);
      $parentId=$valMaal[0];
      $legPosition=$valMaal[1];
      $newParId=$valMaal[2];
      $nextEntryId=$valMaal[3];
      $level++;
    }
    //Child ID Code Ends//
  }
}
    // Placeholder Update Code Ends//
    
function checkPoolComplete($con,$parentId,$memberId,$d,$entryId,$parentEntryId){
  $queryFetch=mysqli_query($con,"SELECT a.member_id,a.parentEntryId,b.poolStatus,b.poolLevel,b.reEntryCount FROM meddolic_user_pool_placeholder_details a, meddolic_user_pool_entry_details b WHERE a.child_id='$memberId' AND a.entryId='$entryId' AND a.parentEntryId=b.entryId AND b.poolStatus=1 ORDER BY a.level ASC");
  while($valFetch=mysqli_fetch_assoc($queryFetch)){
    $parentId=$valFetch['member_id'];
    $parentEntryId=$valFetch['parentEntryId'];
    $poolStatus=$valFetch['poolStatus'];
    $poolLevel=$valFetch['poolLevel'];
    $reEntryCount=$valFetch['reEntryCount'];

    if($poolLevel<=10 && $poolStatus==1){
      $queryIncome=mysqli_query($con,"SELECT userIncome,directNeed FROM meddolic_config_pool_income  WHERE poolLevel='$poolLevel'");
      $valIncome=mysqli_fetch_array($queryIncome);
      $poolIncome=$valIncome['userIncome'];
      $userNeed=$valIncome['directNeed'];

      $queryCount=mysqli_query($con,"SELECT COUNT(1) FROM meddolic_user_pool_placeholder_details WHERE member_id='$parentId' AND level='$poolLevel' AND parentEntryId='$parentEntryId'");
      $valCount=mysqli_fetch_array($queryCount);
      $totalTeam=$valCount[0];

      if($totalTeam>=$userNeed){
      //Pool Income Code Starts
      $queryIn=mysqli_query($con,"INSERT INTO meddolic_user_pool_income (`memberId`,`poolIncome`,`poolLevel`,`entryId`,`dateTime`,`entryCount`) VALUES ('$parentId','$poolIncome','$poolLevel','$parentEntryId','$d','$reEntryCount')");
      $poolInId=$con->insert_id;
      incomeEntry($con,$parentId, $poolInId, $poolIncome, 2, $d);

      //Pool Income Code Ends

        if($poolLevel<10){
          mysqli_query($con,"UPDATE meddolic_user_pool_entry_details SET poolLevel=poolLevel+1,entryDate='$d' WHERE memberId='$parentId' AND entryId='$parentEntryId'");
        } else if($poolLevel==10){
          mysqli_query($con,"UPDATE meddolic_user_pool_entry_details SET poolStatus=2 WHERE memberId='$parentId' AND entryId='$parentEntryId'");
        }
      }
    }
  }
}
    //Check Pool Complete & Income Code Ends
    
    // Auto Pool Tree Entry Code Starts
    function poolTreeEntry($con,$parentId,$d,$entryId){
      $tableName="meddolic_user_pool_1";
      $sql = mysqli_query($con,"SELECT * FROM ".$tableName."");
      $num_rows =mysqli_num_rows($sql);
      switch ($num_rows) {
        case 0:
          mysqli_query($con,"INSERT INTO ".$tableName." (`member_id`,`parentEntryId`) VALUES('$parentId','$entryId')");
          $placeholderId=$parentId;
          $legPosition=1;
          break;
        case 1:
          $val1 =mysqli_fetch_assoc($sql);
          if($val1['child_id']!=""){
            mysqli_query($con,"INSERT INTO ".$tableName." (`member_id`,`parentEntryId`,`child_id`,`childEntryId`,`legPosition`,`tree_level`,`date_time`) VALUES('$val1[member_id]','$val1[parentEntryId]','$parentId','$entryId',2,1,'$d')");
            $placeholderId=$val1['member_id'];
            $parentEntryId=$val1['parentEntryId'];
            $legPosition=2;
            placeholderSet($con,$placeholderId,$legPosition,$parentId,$entryId,$d,$parentEntryId);
            checkPoolComplete($con,$placeholderId,$parentId,$d,$entryId,$parentEntryId);
          } else {
            mysqli_query($con,"UPDATE ".$tableName." SET child_id='$parentId',childEntryId='$entryId',legPosition=1,tree_level=1,date_time='$d' WHERE id='$val1[id]'");
            $placeholderId=$val1['member_id'];
            $parentEntryId=$val1['parentEntryId'];
            $legPosition=1;
            placeholderSet($con,$placeholderId,$legPosition,$parentId,$entryId,$d,$parentEntryId);
          }
          break;
        default:
          $lastId=mysqli_query($con,"SELECT * FROM ".$tableName." ORDER BY id DESC LIMIT 1");
          $lastData=mysqli_fetch_assoc($lastId);
          switch ($lastData['legPosition']) {
            case 1 :
              $legPosition=$lastData['legPosition']+1;
              mysqli_query($con,"INSERT INTO ".$tableName." (`member_id`,`parentEntryId`,`child_id`,`childEntryId`,`legPosition`,`tree_level`,`date_time`) VALUES('$lastData[member_id]','$lastData[parentEntryId]','$parentId','$entryId','$legPosition','$lastData[tree_level]','$d')");
              $placeholderId=$lastData['member_id'];
              $parentEntryId=$lastData['parentEntryId'];
              placeholderSet($con,$placeholderId,$legPosition,$parentId,$entryId,$d,$parentEntryId);
              checkPoolComplete($con,$placeholderId,$parentId,$d,$entryId,$parentEntryId);
              break;
            default:
              // echo "string";
              $levelChild=mysqli_query($con,"SELECT * FROM ".$tableName." WHERE tree_level=".$lastData['tree_level']);
              $treeLevel=$lastData['tree_level'];
              $levelNumRows=mysqli_num_rows($levelChild);
              $parent='';
              if ($levelNumRows == pow(2, $lastData['tree_level'])){
                // echo "string";
                $levelFirstChild=mysqli_query($con,"SELECT child_id,childEntryId FROM ".$tableName." WHERE tree_level=".$lastData['tree_level']." ORDER BY id ASC LIMIT 1");
                $levelFirstChildData=mysqli_fetch_assoc($levelFirstChild);
                $treeLevel++;
                $parent=$levelFirstChildData['child_id'];
                $parentEntryId=$levelFirstChildData['childEntryId'];
              } else {
                // echo "string1";
                $lastIdChild=mysqli_query($con,"SELECT id,tree_level FROM ".$tableName." WHERE child_id=".$lastData['member_id']." AND childEntryId=".$lastData['parentEntryId']);
                $lastIdChildData=mysqli_fetch_assoc($lastIdChild);
  
                $levelFirstChild=mysqli_query($con,"SELECT child_id,childEntryId FROM ".$tableName." WHERE id > ".$lastIdChildData['id']." AND tree_level=".$lastIdChildData['tree_level']." ORDER BY id ASC LIMIT 1");
                $levelFirstChildData=mysqli_fetch_assoc($levelFirstChild);
                // print_r($levelFirstChildData);
                $parent=$levelFirstChildData['child_id'];
                $parentEntryId=$levelFirstChildData['childEntryId'];
              }
              // echo $parent;
              mysqli_query($con,"INSERT INTO ".$tableName." (`member_id`,`parentEntryId`,`child_id`,`childEntryId`,`legPosition`,`tree_level`, `date_time`) VALUES ('$parent','$parentEntryId','$parentId','$entryId',1,'$treeLevel','$d')");
              $placeholderId=$parent;
              $parentEntryId=$parentEntryId;
              $legPosition=1;
              placeholderSet($con,$placeholderId,$legPosition,$parentId,$entryId,$d,$parentEntryId);
            break;
          }
        break;
      }
    }

    
    //Boosting Board Placeholder Update Code Starts//
function magicalPlaceholderSet($con,$memberId,$entryId,$d){
  
    $queryFetch=mysqli_query($con,"SELECT entryId,memberId,reEntryCount,boardStatus FROM meddolic_user_board_entry_details  WHERE boardStatus=1 ORDER BY entryId ASC LIMIT 1");
    $valFetch=mysqli_fetch_array($queryFetch);
    $parentEntryId=$valFetch['entryId'];
    $reEntryCount=$valFetch['reEntryCount'];
    $parentId=$valFetch['memberId'];
    $boardStatus=$valFetch['boardStatus'];
if($parentEntryId!=$entryId){

  $queryCount=mysqli_query($con,"SELECT COUNT(1) FROM  meddolic_user_board_placeholder_details WHERE parentEntryId='$parentEntryId' AND member_id='$parentId'");
    $valCount=mysqli_fetch_array($queryCount);
    $leg_position=$valCount[0]+1;

    mysqli_query($con,"INSERT INTO meddolic_user_board_placeholder_details (`member_id`,`child_id`,`leg_position`,`parentEntryId`,`entryId`,`date_time`) VALUES ('$parentId','$memberId','$leg_position','$parentEntryId','$entryId','$d')");

      if ($boardStatus == 1 && $leg_position==2) {
            $queryIncome = mysqli_query($con, "SELECT userIncome FROM meddolic_config_board_income");
            $valIncome = mysqli_fetch_array($queryIncome);
            $userIncome = $valIncome['userIncome'];


        // Boosting Income Code Starts
        $queryIn = mysqli_query($con, "INSERT INTO meddolic_user_boosting_board_income (`memberId`,`boardIncome`,`entryId`,`dateTime`,`entryCount`) VALUES ('$parentId','$userIncome','$parentEntryId','$d','$reEntryCount')");
        $boosterInId = $con->insert_id;
        incomeEntry($con, $parentId, $boosterInId, $userIncome, 3, $d);
        // Boosting Income Code Ends
      mysqli_query($con,"UPDATE meddolic_user_board_entry_details SET boardStatus=0 WHERE memberId='$parentId' AND entryId='$parentEntryId'");
      }
}
              
    }
    //Child ID Code Ends//

   // Reward Rank Set Code Starts//
function rewardReleaseSet($con,$memberId,$rewardId,$directNeed,$rewardIncome,$d,$rewardMonth,$level){
    // $querySponser=mysqli_query($con,"SELECT COUNT(1) FROM meddolic_user_details WHERE sponser_id='$memberId' AND topup_flag=1");
    // $valSponser=mysqli_fetch_array($querySponser);
    // $totalDirect=$valSponser[0];

  echo  $queryTeam="SELECT COUNT(1) FROM meddolic_user_activation_details WHERE member_id IN (SELECT child_id FROM meddolic_user_child_ids WHERE member_id='$memberId' AND topup_status=1 AND packageId=1 AND level='$level' AND  level<=3 )";
    $valTeam=mysqli_fetch_array($queryTeam);
    $totalMember=$valTeam[0];

    // echo $totalMember;
    // echo $directNeed;


    if($totalMember>=$directNeed){

        $dueDate=date('Y-m-d H:i:s', strtotime($d. ' +1 Month'));
        mysqli_query($con,"UPDATE meddolic_user_reward_income_summary SET rewardStatus=0 WHERE  memberId='$memberId'");
      // echo  $queryRe="INSERT INTO meddolic_user_reward_income_summary (`memberId`,`rewardId`,`dateTime`,`rewardIncome`,`rewardMonth`,`dueDate`) VALUES ('$memberId','$rewardId','$d','$rewardIncome','$rewardMonth','$dueDate')";
        $summaryId=$con->insert_id;
        mysqli_query($con,"UPDATE meddolic_user_details SET currentReward=currentReward+1 WHERE member_id='$memberId'");       
        $nextReward=$rewardId+1;
        if($nextReward<=3){
            $queryRe=mysqli_query($con,"SELECT directNeed,rewardIncome,rewardMonth,level FROM meddolic_config_reward_income WHERE rewardId='$nextReward'");
            $valRe=mysqli_fetch_assoc($queryRe);
            $directNeed=$valRe['directNeed'];
            $rewardIncome=$valRe['rewardIncome'];
            $rewardMonth=$valRe['rewardMonth'];
            $level=$valRe['level'];
            rewardReleaseSet($con,$memberId,$nextReward,$directNeed,$rewardIncome,$d,$rewardMonth,$level);
        }
    }
        
    }
//Reward Rank Set Code Ends//

function relayRewardLoop($con,$memberId,$d){
    $queryMain=mysqli_query($con,"SELECT a.sponser_id,b.topup_flag,b.currentReward FROM meddolic_user_details a, meddolic_user_details b WHERE a.member_id='$memberId' AND a.sponser_id=b.member_id");
    $valMain=mysqli_fetch_assoc($queryMain);
    $parentId=$valMain['sponser_id'];
    $topupFlag=$valMain['topup_flag'];
    $currentReward=$valMain['currentReward'];
    $nextReward=$currentReward+1;
    while($parentId){
        if($topupFlag==1 && $nextReward<=3){            
            $queryReward=mysqli_query($con,"SELECT directNeed,rewardIncome,rewardMonth,level FROM meddolic_config_reward_income WHERE rewardId='$nextReward'");
            $valReward=mysqli_fetch_assoc($queryReward);
            $directNeed=$valReward['directNeed'];
            $rewardIncome=$valReward['rewardIncome'];
            $rewardMonth=$valReward['rewardMonth'];
            $level=$valReward['level'];
            rewardReleaseSet($con,$parentId,$nextReward,$directNeed,$rewardIncome,$d,$rewardMonth,$level);
        }
        $queryMo=mysqli_query($con,"SELECT a.sponser_id,b.topup_flag,b.currentReward FROM meddolic_user_details a, meddolic_user_details b WHERE a.member_id='$parentId' AND a.sponser_id=b.member_id");
        $valMo=mysqli_fetch_assoc($queryMo);
        $parentId=$valMo['sponser_id'];
        $topupFlag=$valMo['topup_flag'];
        $currentReward=$valMo['currentReward'];
        $nextReward=$currentReward+1;
    }
}