<?php
    include("../../conection.php");
    $ticketId = $_POST['ticketId'];
    $loginMemberId = $_POST['loginMemberId'];

    $queryDetails=mysqli_query($con,"SELECT a.ticketCode,a.ticketMessage,a.raiseDate,a.actionDate,a.ticketStatus,a.subjectId,a.priorityId,b.user_id,b.name FROM meddolic_user_support_ticket a, meddolic_user_details b WHERE a.memberId=b.member_id AND a.ticketId='$ticketId'");
    $valDetails=mysqli_fetch_assoc($queryDetails); ?>
<div class="modal-content">
    <div class="modal-header" style="background-color: #5d9cec;">
        <h4 class="modal-title" id="myModalLabel" style="color:#ffffff;">Ticket Remark-: <?=$valDetails['ticketCode']?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    </div>                          
    <form method="POST" action="ticketRemarkProcess" >
        <div class="modal-body" style="color:#000;">
            <div class="form-group">
                <label class="control-label" for="inputSuccess">Change Subject :</label>
                <input type="hidden" name="ticketId" value="<?=$ticketId?>">
                <input type="hidden" name="loginMemberId" value="<?=$loginMemberId?>">
                <select class="form-control" required id="subjectId" name="subjectId">
                <option value=""> Select One </option>
                  <?php $querySubject=mysqli_query($con,"SELECT subjectId,subjectName FROM meddolic_config_support_subject WHERE subjectStatus=1");
                  while($valSubject=mysqli_fetch_assoc($querySubject)){ ?>
                    <option value="<?=$valSubject['subjectId']?>" <?php if($valDetails['subjectId']==$valSubject['subjectId']) echo 'selected'; ?> > <?= $valSubject['subjectName']?> </option>
                  <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="inputSuccess">Change Priority :</label>
                <select class="form-control" required id="priorityId" name="priorityId">
                <option value=""> Select One </option>
                  <?php $queryPriority=mysqli_query($con,"SELECT priorityId,priorityName FROM meddolic_config_support_priority WHERE priorityStatus=1");
                  while($valPriority=mysqli_fetch_assoc($queryPriority)){ ?>
                  <option value="<?=$valPriority['priorityId']?>" <?php if($valDetails['priorityId']==$valPriority['priorityId']) echo 'selected'; ?> > <?= $valPriority['priorityName']?></option>
                  <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="inputSuccess">Change Status :</label>
                <select class="form-control" required id="ticketStatus" name="ticketStatus">
                <option value=""> Select One </option>
                <option value="1" <?php if($valDetails['ticketStatus']==1) echo 'selected';?> > Open </option>
                <option value="2" <?php if($valDetails['ticketStatus']==2) echo 'selected';?> > Processing </option>
                <option value="3" <?php if($valDetails['ticketStatus']==3) echo 'selected';?> > Completed </option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="inputSuccess">User Message :</label>
                <textarea type="text" class="form-control" readonly><?=$valDetails['ticketMessage']?></textarea>
            </div>
            <div class="form-group">
                <label class="control-label" for="inputSuccess">Resolve Remark :</label>
                <textarea type="text" class="form-control" name="adminMessage" required></textarea>
            </div>
       </div>
        <div class="modal-footer" style="background-color: #ff902bb5;">
            <input type="submit" name="ticketUpdate" class="btn btn-success" value="Update Ticket">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>
