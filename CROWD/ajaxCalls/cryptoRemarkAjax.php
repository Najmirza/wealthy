<?php
    include("../../conection.php");
    $id = $_POST['id'];
    $userId = $_POST['userId'];
    $withdrawStatus = $_POST['withdrawStatus'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $queryDetails=mysqli_query($con,"SELECT orderid,member_id,released FROM meddolic_user_wallet_withdrawal_crypto WHERE id='$id'");
    $valDetails=mysqli_fetch_assoc($queryDetails); ?>
<div class="modal-content">
    <div class="modal-header" style="background-color: #5d9cec; ">
        <h4 class="modal-title" id="myModalLabel" style="color: #ffffff;">Withdraw Remark : <?=$valDetails['orderid']?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    </div>                          
    <form method="POST" action="cryptoWithdrawProcess" >
        <div class="modal-body">
            <div class="form-group">
                <label class="control-label" for="inputSuccess">Select One :</label>
                <select name="withdrawStatus" class="form-control" required >
                    <option value=""> -Select Status- </option>
                    <option value="0" <?php if($valDetails['released']==0) echo 'selected';?> > Pending </option>
                    <option value="1" <?php if($valDetails['released']==1) echo 'selected';?> > Released </option>
                    <option value="2" <?php if($valDetails['released']==2) echo 'selected';?> > Processing </option>
                    <option value="3" <?php if($valDetails['released']==3) echo 'selected';?> > Reject </option>
                </select>
                <input type="hidden" id="id" name="id" value="<?=$id?>" >
                <input type="hidden" name="memberId" value="<?=$valDetails['member_id']?>" >
                <input type="hidden" name="mainStatus" value="<?=$withdrawStatus?>" >
                <input type="hidden" name="fromDate" value="<?=$fromDate?>" >
                <input type="hidden" name="toDate" value="<?=$toDate?>" >
                <input type="hidden" name="userId" value="<?=$userId?>" >
            </div>
            <div class="form-group">
                <label class="control-label" for="inputSuccess"> Remark :</label>
                <input type="text" class="form-control" id="remarks" name="remarks" required >
            </div>
        </div>
        <div class="modal-footer" style="background-color: #ff902bb5;">
            <input type="submit" name="addEditRemark" class="btn btn-success" value="Submit Now">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>