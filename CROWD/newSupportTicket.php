<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php');
      include("loginCheck.php");
      include('include/header.php');
      include('include/menu.php'); ?>
<?php 
if($_GET){
  if($_GET['subjectId']){
      $subjectId=$_GET['subjectId'];
  }   
  if($_GET['priorityId']){
    $priorityId=$_GET['priorityId'];
  }
  if($_GET['ticketStatus']){
    $ticketStatus=$_GET['ticketStatus'];
  }   
}else{
  $ticketStatus=1;
} ?>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> New Tickets</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Support </li>
                        <li class="breadcrumb-item active"> New Tickets</li>
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
                                    <select class="form-control" name="subjectId">
                                        <option value=""> Select One </option>
                                        <?php $querySubject=mysqli_query($con,"SELECT subjectId,subjectName FROM meddolic_config_support_subject WHERE subjectStatus=1");
                                        while($valSubject=mysqli_fetch_assoc($querySubject)){ ?>
                                          <option value="<?=$valSubject['subjectId']?>" <?php if($valSubject['subjectId']==$subjectId) echo 'selected'; ?> > <?= $valSubject['subjectName']?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <select class="form-control" name="priorityId">
                                        <option value=""> Select One </option>
                                        <?php $queryPriority=mysqli_query($con,"SELECT priorityId,priorityName FROM meddolic_config_support_priority WHERE priorityStatus=1");
                                        while($valPriority=mysqli_fetch_assoc($queryPriority)){ ?>
                                        <option value="<?=$valPriority['priorityId']?>" <?php if($valPriority['priorityId']==$priorityId) echo 'selected'; ?> > <?= $valPriority['priorityName']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <select class="form-control" name="ticketStatus">
                                        <option value=""> Select One </option>
                                        <option value="1" <?php if($ticketStatus==1) echo 'selected';?> > Open </option>
                                        <option value="2" <?php if($ticketStatus==2) echo 'selected';?> > Processing </option>
                                    </select>
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
                        <h2>New Support Tickets</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>UserId</th>
                                        <th>Name</th>
                                        <th>TicketNo</th>
                                        <th>Subject</th>
                                        <th>Priority</th>
                                        <th>Message</th>
                                        <th>Raise Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $query="";
                                    if($subjectId!=""){
                                        $query= $query." AND a.subjectId='$subjectId'";  
                                    }
                                    if($priorityId!=""){
                                        $query= $query." AND a.priorityId='$priorityId'";  
                                    }
                                    if($ticketStatus!=""){
                                        $query= $query." AND a.ticketStatus='$ticketStatus'";  
                                    }
                                    $count=0;
                                    $queryRequest=mysqli_query($con,"SELECT a.ticketId,a.ticketCode,a.ticketMessage,a.raiseDate,a.actionDate,a.ticketStatus,b.user_id,b.name,c.subjectName,d.priorityName FROM meddolic_user_support_ticket a, meddolic_user_details b, meddolic_config_support_subject c, meddolic_config_support_priority d WHERE a.memberId=b.member_id AND a.subjectId=c.subjectId AND a.priorityId=d.priorityId ".$query." ORDER BY a.raiseDate DESC");
                                    while($valRequest=mysqli_fetch_assoc($queryRequest)){
                                        $count++; ?>
                                    <tr>
                                        <td><?= $count?></td>
                                        <td><?= $valRequest['user_id']?></td>
                                        <td><?= $valRequest['name']?></td>
                                        <td><?= $valRequest['ticketCode']?></td>
                                        <td><?= $valRequest['subjectName']?></td>
                                        <td><?= $valRequest['priorityName']?></td>
                                        <td><?= $valRequest['ticketMessage']?></td>
                                        <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:s", strtotime($valRequest['raiseDate']))?></td>
                                        <td><?php if($valRequest['ticketStatus']==1) echo "<span class='badge badge-primary'>OPEN</span>";else if($valRequest['ticketStatus']==2) echo "<span class='badge badge-warning'>PROCESSING</span>";else if($valRequest['ticketStatus']==3) echo "<span class='badge badge-success'>RESOLVED</span>";?></td>
                                        <td><a data-id="<?= $valRequest['ticketId']?>" data-toggle="modal" data-target="#ticketRemark" data-whatever="<?= $valRequest['ticketId']?>" href="javascript:void(0)" ><span class='badge badge-success'>Remark</span></a></td>
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
<div class="modal fade" id="ticketRemark" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="ticketRemarkDash">
      <!-- Content goes in here -->
      </div>
    </div>
  </div>
</div>
<?php include('include/footer.php'); ?>
<script>
$('#ticketRemark').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var modal = $(this);
  var ticketId = recipient;
  var loginMemberId = '<?=$member_id?>';
  $.ajax({
    type: "POST",
    url: "ajaxCalls/ticketRemarkAjax",
    data: { ticketId: ticketId, loginMemberId:loginMemberId },
    cache: false,
    success: function (data) {
      console.log(data);
      modal.find('.ticketRemarkDash').html(data);
    },
    error: function(err) {
      console.log(err);
    }
  });  
})
var d = document.getElementById("Support");
    d.className += " active";
var d = document.getElementById("newSupportTicket");
    d.className += " active";
</script>
</body>
</html> 