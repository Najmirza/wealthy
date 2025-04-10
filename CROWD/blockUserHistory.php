<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php');
      include("loginCheck.php");
      include('include/header.php');
      include('include/menu.php'); ?>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Block User History</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Member </li>
                        <li class="breadcrumb-item active"> Block User History</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Block User History</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>          
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Sponser</th>
                                        <th>Status</th>
                                        <th>Joinig Date</th>
                                        <th>PassKey</th>
                                        <th>Activation Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $query="";
                                    if($user_id1!=""){
                                      $query= $query." AND user_id='$user_id1'";  
                                    }
                                    $count=0;
                                    $queryUser=mysqli_query($con,"SELECT a.user_id,a.name,a.phone,a.member_id,a.password,a.activation_date,a.account_status,a.topup_flag,a.date_time,b.user_id AS sponserId,b.name AS sponserName FROM meddolic_user_details a, meddolic_user_details b WHERE CAST(a.date_time AS DATE) BETWEEN '$cal_date' AND '$cal_date1' AND a.member_id!=1 AND a.user_type=2 AND account_status=0 AND a.sponser_id=b.member_id ".$query." order by a.date_time desc");
                                    while($valUser=mysqli_fetch_array($queryUser)){
                                        $count++;
                                ?>
                                    <tr>
                                        <td><?= $count?></td>
                                        <td><?= $valUser['user_id']?></td>
                                        <td><?= $valUser['name']?></td>
                                        <td><?= $valUser['phone']?></td>
                                        <td><?= $valUser['sponserName']." (User ID:".$valUser['sponserId'].")";?></td>
                                        <td><?php if($valUser['topup_flag']==1) echo "Active"; else echo "Not-Active";?></td>
                                        <td><?= date("d-m-Y H:i:d", strtotime($valUser['date_time']))?></td>
                                        <td><?= $valUser['password']; ?></td>
                                        <td><?= $valUser['activation_date']; ?></td>
                                        <td><a href="viewMemberDetails?user_id=<?= $valUser['user_id']?>" class="btn btn-success btn-sm">More</a>&nbsp; <a href="javascript:void(0);" onclick="memberDashboard('<?=base64_encode($valUser['user_id'])?>','<?=base64_encode($valUser['password'])?>','<?=base64_encode($valUser['member_id'])?>')" class="btn btn-primary btn-sm">Dashboard</a> &nbsp;<?php if($valUser['account_status']==1) { ?><a href="javascript:void(0);" onclick="blockUser(<?=$valUser['member_id']?>,0)" class="btn btn-danger btn-sm" style="font-size: 12px;">Block User</a><?php } else { ?> <a href="javascript:void(0);" onclick="unBlockUser(<?=$valUser['member_id']?>,1)" class="btn btn-warning btn-sm" style="font-size: 10px;">Un-Block User</a> <?php } ?> </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>
<script>
function memberDashboard(userId,password,memberId){
   var url='../member/setSessionAdvice?userId='+userId+'&mID='+password+'&codeGenerate='+memberId;
   window.open(url,'_blank');
};
function blockUser(memberId,blockStatus) {
  if(memberId!=""){
      if(confirm('Are you sure to Block this Member?')){
        $.ajax({
          type: "POST",
          url: 'ajaxCalls/blockUnBlockUserAjax',
          data: { memberId:memberId, blockStatus:blockStatus },
          cache: false,
          success: function(data){
               alert(data);
             if(data){
              alert('User Block Successfully');
              location.reload();
             }
          }
      });
    }
  }
}
function unBlockUser(memberId,blockStatus) {
  if(memberId!=""){
      if(confirm('Are you sure to Un-Block this Member?')){
        $.ajax({
          type: "POST",
          url: 'ajaxCalls/blockUnBlockUserAjax',
          data: { memberId:memberId, blockStatus:blockStatus },
          cache: false,
          success: function(data){
            // alert(data);
            if(data){
              alert('User Un-Block Successfully');
              location.reload();
            }
          }
      });
    }
  }
}
var d = document.getElementById("Members");
    d.className += " active";
var d = document.getElementById("blockUserHistory");
    d.className += " active";
</script>
</body>
</html> 