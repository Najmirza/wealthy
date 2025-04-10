<!DOCTYPE html>
<html lang="en">
<?php 
    require_once("loginCheck.php");
    require_once('Include/Head.php');
    require_once('Include/Header.php');
    require_once('Include/Menu.php');?>
    <!-- Content wrapper -->
    <div class="content-wrapper">



  <div class="container-xxl flex-grow-1 container-p-y">      
      <div class="page-title">
          <div class="row">
              <div class="col-6">
                  <h3>Support</h3>
              </div>
              <div class="col-6">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"></li>
                      <li class="breadcrumb-item active" style="display:none;">Support</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-info text-white" style="margin-top: 27px;">+ Create New Ticket</a>
    </div>
    <div class="row">
      <div class="card">
        <div class="card-header">
          <h5>All Outbox Tickets</h5>
        </div>
        <div class="card-body">
          <div class="dt-ext table-responsive">
            <table class="table table-bordered table-hover display margin-top-10 w-p100" id="export-button">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Ticket No</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Priority</th>
                  <th>Raise Date</th>
                  <th>Last Update</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $count=0;
                $queryRequest=mysqli_query($con,"SELECT a.ticketCode,a.ticketMessage,a.raiseDate,a.actionDate,a.ticketStatus,b.user_id,b.name,c.subjectName,d.priorityName FROM meddolic_user_support_ticket a, meddolic_user_details b, meddolic_config_support_subject c, meddolic_config_support_priority d WHERE a.memberId='$memberId' AND a.memberId=b.member_id AND a.subjectId=c.subjectId AND a.priorityId=d.priorityId ORDER BY a.raiseDate DESC");
                while($valRequest=mysqli_fetch_assoc($queryRequest)){
                  $count++; ?>
                  <tr>
                    <td><?= $count?></td>
                    <td><?= $valRequest['ticketCode']?></td>
                    <td><?= $valRequest['subjectName']?></td>
                    <td><?= $valRequest['ticketMessage']?></td>
                    <td><?= $valRequest['priorityName']?></td>
                    <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:s", strtotime($valRequest['raiseDate']))?></td>
                    <td><?php if($valRequest['actionDate']!=''){ ?> <i class="fa fa-clock-o"></i>  <?= date("d-m-Y H:i:s", strtotime($valRequest['actionDate'])); } ?></td>
                    <td><?php if($valRequest['ticketStatus']==1) echo "<span class='badge badge-primary'>OPEN</span>";else if($valRequest['ticketStatus']==2) echo "<span class='badge badge-warning'>PROCESSING</span>";else if($valRequest['ticketStatus']==3) echo "<span class='badge badge-success'>RESOLVED</span>";?></td>
                  </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="card">
        <div class="card-header">
          <h5>All Inbox Tickets</h5>
        </div>
        <div class="card-body">
          <div class="dt-ext table-responsive">
            <table class="table table-bordered table-hover display margin-top-10 w-p100" id="column-selector">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $count=0;
              $queryResponse=mysqli_query($con,"SELECT a.adminMessage,a.actionDate,a.ticketStatus,b.user_id,b.name,c.subjectName FROM meddolic_user_support_ticket a, meddolic_user_details b, meddolic_config_support_subject c WHERE a.memberId='$memberId' AND a.memberId=b.member_id AND a.subjectId=c.subjectId AND a.adminMessage<>'' ORDER BY a.actionDate DESC");
              while($valResponse=mysqli_fetch_assoc($queryResponse)){
                $count++; ?>
                <tr>
                  <td><?= $count?></td>
                  <td><?= $valResponse['subjectName']?></td>
                  <td><?= $valResponse['adminMessage']?></td>
                  <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:s", strtotime($valResponse['actionDate']))?></td>
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
<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="SupportProcess" enctype="multipart/form-data" method="POST" role="form">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Create a new ticket</h4>
              <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
            <div class="form-horizontal">
              <div class="form-group">
                <label class="col-md-12">Subject</label>
                <div class="col-md-12">
                  <select class="form-control" required id="subjectId" name="subjectId">
                    <option value=""> Select One </option>
                      <?php $querySubject=mysqli_query($con,"SELECT subjectId,subjectName FROM meddolic_config_support_subject WHERE subjectStatus=1");
                      while($valSubject=mysqli_fetch_assoc($querySubject)){ ?>
                        <option value="<?=$valSubject['subjectId']?>"> <?= $valSubject['subjectName']?> </option>
                      <?php } ?>
                    </select>
                    <input type="hidden" name="memberId" value="<?=$memberId?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-12">Priority</label>
                <div class="col-md-12">
                  <select class="form-control" required id="priorityId" name="priorityId">
                    <option value=""> Select One </option>
                      <?php $queryPriority=mysqli_query($con,"SELECT priorityId,priorityName FROM meddolic_config_support_priority WHERE priorityStatus=1");
                      while($valPriority=mysqli_fetch_assoc($queryPriority)){ ?>
                      <option value="<?=$valPriority['priorityId']?>"> <?= $valPriority['priorityName']?></option>
                      <?php } ?>
                    </select>
                </div>
              </div>
              <div class="form-group">
                  <label class="col-md-12">Message</label>
                  <div class="col-md-12">
                      <textarea class="form-control" cols="20" data-val="true" data-val-required="Message is Required" id="ticketMessage" name="ticketMessage" placeholder="Enter Message" rows="2"></textarea>
                      <span class="field-validation-valid" data-valmsg-for="msg" data-valmsg-replace="true"></span>
                  </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" name="supportTicket">Submit</button>
          </div>
      </div>
    </form>
  </div>
</div>
<?php require_once('Include/Footer.php');?>
<script>
var d = document.getElementById("Support");
    d.className += " active";
</script>
</body>
</html>