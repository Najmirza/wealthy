<?php
    include("../../conection.php");
    $slabId = $_POST['slabId'];
    $queryDetails=mysqli_query($con,"SELECT boosterPercent FROM meddolic_config_misc_setting WHERE id='$slabId'");
    $valDetails=mysqli_fetch_assoc($queryDetails); ?>
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">Edit Percent :</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
    </div>
    <form action="miningSettingProcess" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <div class="form-group">
                    <label class="control-label" for="inputSuccess">Mining Percent</label>
                    <input class="form-control" required type="text" value="<?= $valDetails[boosterPercent]?>" name="boosterPercent" >
                    <input type="hidden" value="<?= $slabId?>" name="slabId">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" name="updateMining" class="btn btn-primary">Update Now</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>