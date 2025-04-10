<?php
   include("../../conection.php");
    $id = $_POST['id'];
?>
<div class="modal-content">
    <div class="modal-header" style="background-color: #5d9cec; color: #ffffff;">
        <h4 class="modal-title" id="myModalLabel">Reject Remark Add</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    </div>                          
    <form method="POST" action="withdrawRequestCancel" >
        <div class="modal-body">
        <div class="form-group">
        <label class="control-label" for="inputSuccess">Reject Remark :</label>
            <input type="text" class="form-control" id="remarks" name="remarks" required >
            <input type="hidden" id="id" name="id" value="<?= $id?>" >
        </div>
       </div>
        <div class="modal-footer" style="background-color: #ff902bb5;">
            <input type="submit" name="cancelWithdraw" class="btn btn-success" value="Reject Withdraw">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>
