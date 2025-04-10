<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php');
      include("loginCheck.php");
      include('include/header.php');
      include('include/menu.php'); ?>
<?php  
    $user_id1="";
    if($_GET){
      if($_GET['user_id']){
        $user_id1=$_GET['user_id'];
        $query="select count(*) from meddolic_user_details where user_id='$user_id1'";
        $result=mysqli_query($con,$query);
        $val=mysqli_fetch_array($result);
        if($val[0]==0) { ?>
          <script>
            alert("Invalid User Id");
            </script>
          <?php
          $user_id1=$_SESSION['admin_user_id'];    
        }
      }
      if($_GET['from_date']){
        $show_date=$_GET['from_date'];
        $cal_date = date("Y-m-d", strtotime($show_date));
      }   
      if($_GET['to_date'] ){
        $show_date1=$_GET['to_date'];
        $cal_date1 = date("Y-m-d", strtotime($show_date1));
      }
    } else{
      $show_date=date("d-m-Y"); 
      $show_date1=date("d-m-Y");
      $cal_date=date("Y-m-d"); 
      $cal_date1=date("Y-m-d");
    }
?>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> View Active Member</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Member </li>
                        <li class="breadcrumb-item active"> View Active Member</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="body">
                        <form>
                            <div class="row">
                                <div class="col-lg-3 col-md-12">
                                    <div class="input-group date">
                                        <input class="form-control" type="text" placeholder="Enter User ID" name="user_id" value="<?= $user_id1?>" >
                                        <div class="input-group-append">                                            
                                            <button class="btn btn-outline-secondary" type="button"><i class="fa fa-user"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="input-group mb-3">                                        
                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control" name="from_date" id="from_date" placeholder="e.g. From Date" required value="<?= $show_date; ?>" readonly >
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="input-group mb-3">                                        
                                        <input name="to_date" id="to_date" data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="e.g. To Date" required="" value="<?= $show_date1; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="input-group mb-3">                                        
                                        <input class="btn btn-primary" type="submit" value="Search" >
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>View Active Member</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>          
                                        <th>UserId</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Sponser</th>
                                        <th>Package</th>
                                        <th>Joinig Date</th>
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
                                    $queryUser=mysqli_query($con,"SELECT a.user_id,a.name,a.phone,a.member_id,a.password,a.activation_date,a.packageType,a.account_status,a.topup_flag,a.date_time,b.user_id AS sponserId,b.name AS sponserName FROM meddolic_user_details a, meddolic_user_details b WHERE CAST(a.activation_date AS DATE) BETWEEN '$cal_date' AND '$cal_date1' AND a.member_id!=1 AND a.user_type=2 AND a.sponser_id=b.member_id AND a.topup_flag=1 ".$query." order by a.activation_date DESC");
                                    while($valUser=mysqli_fetch_array($queryUser)){
                                        $count++; ?>
                                    <tr>
                                        <td><?= $count?></td>
                                        <td><?= $valUser['user_id']?></td>
                                        <td><?= $valUser['name']?></td>
                                        <td><?= $valUser['phone']?></td>
                                        <td><?= $valUser['sponserName']." (User ID:".$valUser['sponserId'].")";?></td>
                                        <td><b><?php if($valUser['packageType']==1) echo 'ACTIVE'; else if($valUser['packageType']==2) echo 'SUPER ACTIVE';?></b></td>
                                        <td><?= date("d-m-Y H:i:s", strtotime($valUser['date_time']))?></td>
                                        <td><?= $valUser['activation_date']; ?></td>
                                        <td><a href="viewMemberDetails?user_id=<?= $valUser['user_id']?>" class="btn btn-success btn-sm">More</a>&nbsp; <a href="javascript:void(0);" onclick="memberDashboard('<?=base64_encode($valUser['user_id'])?>','<?=$valUser['password']?>','<?=base64_encode($valUser['member_id'])?>')" class="btn btn-primary btn-sm">Dashboard</a> &nbsp;<?php if($valUser['account_status']==1) { ?><a href="javascript:void(0);" onclick="blockUser(<?=$valUser['member_id']?>,0)" class="btn btn-danger btn-sm" style="font-size: 12px;">Block User</a><?php } else { ?> <a href="javascript:void(0);" onclick="unBlockUser(<?=$valUser['member_id']?>,1)" class="btn btn-warning btn-sm" style="font-size: 10px;">Un-Block User</a> <?php } ?> </td>
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
   var url='../User/setSessionAdvice?userId='+userId+'&mID='+password+'&codeGenerate='+memberId;
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
</script>
</body>
</html> 