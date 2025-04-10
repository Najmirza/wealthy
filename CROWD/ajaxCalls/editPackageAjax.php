<?php
   include("../../conection.php");
    $packageId = $_POST['packageId'];
     
    $queryDetails=mysqli_query($con,"SELECT packageId,packageStart,packageEnd,minCashback,dailyCashback,returnPercent FROM meddolic_config_package_list WHERE packageId='$packageId'");
    $valDetails=mysqli_fetch_assoc($queryDetails); ?>
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle" style="color: #000000;">Edit Package : $  <?= $valDetails['packageStart']?> - $  <?= $valDetails['packageEnd']?> </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
    </div>
    <form action="packageManagerProcess" method="post" enctype="multipart/form-data">
        <div class="modal-body" style="color:#000000;">
            <div class="form-group">
                <div class="form-group">
                    <label class="control-label" for="inputSuccess">Package Start *</label>
                    <input class="form-control" required name="packageStart" type="text" value="<?= $valDetails['packageStart']?>" >
                    <input type="hidden" value="<?= $packageId?>" name="packageId">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label class="control-label" for="inputSuccess">Package End *</label>
                    <input class="form-control" required name="packageEnd" type="text" value="<?= $valDetails['packageEnd']?>" >
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label class="control-label" for="inputSuccess">Min Cashback ( In <i class="fa fa-percent"></i> ) </label>
                    <input class="form-control" type="text" required name="minCashback" value="<?= $valDetails['minCashback']?>" >
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label class="control-label" for="inputSuccess">Max Cashback ( In <i class="fa fa-percent"></i> ) </label>
                    <input class="form-control" type="text" required name="dailyCashback" type="text" value="<?= $valDetails['dailyCashback']?>" >
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label class="control-label" for="inputSuccess">Daily Cashback ( In <i class="fa fa-percent"></i> ) </label>
                    <input class="form-control" type="text" required name="returnPercent" value="<?= $valDetails['returnPercent']?>" >
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" name="updatePackage" class="btn btn-primary">Update Now</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>