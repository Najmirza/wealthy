<?php
   include("../../conection.php");
    $tokenId = $_POST['tokenId'];
    $queryDetails=mysqli_query($con,"SELECT id,coinRate FROM meddolic_config_misc_setting WHERE id='$tokenId'");
    $valDetails=mysqli_fetch_array($queryDetails);
?>
<div class="modal-content">
    <div class="modal-header" style="background-color: #5d9cec; color: #ffffff;">
        <h4 class="modal-title" id="myModalLabel">Token Edit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="removeModal()">x</button>
    </div>                            
    <form method="POST" action="tokenRateSettingProcess">
        <div class="modal-body">
            <div class="form-group">
                <label class="control-label" for="inputSuccess">Token Rate</label>
                <input type="hidden" name="tokenId" value="<?= $tokenId?>">
                <input type="text" class="form-control" name="coinRate" value="<?= $valDetails['coinRate']?>" required >
            </div>
       </div>
        <div class="modal-footer" style="background-color: #ff902bb5;">
            <input type="submit" name="coinUpdate" class="btn btn-success" value="Save Change">
            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="removeModal()">Close</button>
        </div>
    </form>
</div>
