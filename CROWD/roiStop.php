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
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Stop ROI</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Setting </a></li>
                        <li class="breadcrumb-item active"> Stop ROI</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Stop ROI</h2>
                    </div>
                    <a class="btn btn-success" data-id="ThisID"  data-toggle="modal" data-target="#addStopDate" href="#" style="float:right;" ><i class="fa fa-plus"></i> Add New Date</a><br><br>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>          
                                        <th>Stop Date</th>
                                        <th>Add Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $todayDate=date('Y-m-d');
                                $count=0;
                                $queryStop=mysqli_query($con,"SELECT * FROM meddolic_config_roi_stop_list WHERE stopDate>='$todayDate' AND stopStatus=1 ORDER BY stopDate ASC");
                                while($valStop=mysqli_fetch_assoc($queryStop)){
                                    $count++; ?>
                                    <tr>
                                        <td><?= $count; ?></td>
                                        <td><i class="fa fa-clock-o"></i> <?= $valStop['stopDate']?></td>
                                        <td><i class="fa fa-clock-o"></i> <?= $valStop['addDate']?></td>
                                        <td><a onclick="deleteStopDate(<?=$valStop['stopId']?>)" href="javascript:void(0)" class="btn btn-danger btn-xs"> Delete </a></td>
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
<div class="modal fade" id="addStopDate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Add ROI Stop Date </h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form action="roiStopProcess" method="post" enctype="multipart/form-data">
        <div class="modal-body">     
            <div class="form-group">
            <label class="control-label" for="inputSuccess">Select Date * </label>
            <div class="input-group mb-3">                                        
                <input data-provide="datepicker" data-date-autoclose="true" class="form-control" name="stopDate" id="from_date" placeholder="e.g. ROI Stop Date" required readonly >
            </div>
          </div>        
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" name="addStopDate" value="Add Now">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include('include/footer.php'); ?>
<script>
$(document).ready(function () {
    $("#roiDatePick").datepicker({
        minDate: 0
    });
});
</script>
<script>
function deleteStopDate(stopId){
  if(stopId!=""){
      if(confirm('Are you sure to Delete this Date?')){
        $.ajax({
          type: "POST",
          url: 'ajaxCalls/deleteStopDateAjax',
          data: { stopId:stopId },
          cache: false,
          success: function(data){
               // alert(data);
             if(data){
              alert('ROI Date Deleted Successfully');
              location.reload();
             }
          }
      });
    }
  }
}
var d = document.getElementById("Setting");
    d.className += " active";
var d = document.getElementById("roiStop");
    d.className += " active";
</script>
</body>
</html> 