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
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Misc Setting</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Setting </a></li>
                        <li class="breadcrumb-item active"> Misc Setting</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Misc Setting</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Setting Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $count=0;
                                    $querySetting=mysqli_query($con,"SELECT * FROM meddolic_config_setting");
                                    while($valSetting=mysqli_fetch_assoc($querySetting)){ 
                                        $count++; ?>
                                    <tr>
                                        <td><?=$count; ?></td>
                                        <td><?=$valSetting['setting_name']; ?></td>
                                        <td><?php if($valSetting['status']=='1') { ?>
                                            <button class="btn btn-primary btn-xs"><b>Yes</b></button>
                                          <?php } else { ?>
                                            <button class="btn btn-danger btn-xs"><b>No</b></button>
                                          <?php }  ?></td>
                                        <td><?php if($valSetting['status']=='1') { ?><a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="setSettingStatus(<?=$valSetting['id']?>,0)">Set to No</a><?php } else { ?> <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="setSettingStatus(<?=$valSetting['id']?>,1)">Set to Yes</a><?php } ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Level Setting</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Level</th>
                                        <th>Level Income</th>
                                        <th>Roll-Up Level Income</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $count=0;
                                    $queryLevel=mysqli_query($con,"SELECT * FROM meddolic_config_level_income ORDER BY id ASC");
                                    while($valLevel=mysqli_fetch_assoc($queryLevel)){ 
                                        $count++; ?>
                                    <tr>
                                        <td><?=$count?></td>
                                        <td>Level <?=$valLevel['level']?></td>
                                        <td>$  <?=$valLevel['levelIncome']?></td>
                                        <td>$  <?=$valLevel['rollUpLevelIncome']?></td>
                                        <td><a data-id="<?= $valLevel['id']?>" data-toggle="modal" data-target="#levelSetting" data-whatever="<?= $valLevel['id']?>" href="#" class="btn btn-success btn-xs" > Edit </a></td>
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
<div class="modal fade" id="levelSetting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="levelEditDash">
             <!-- Content goes in here -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php include('include/footer.php'); ?>
<script>
function setSettingStatus(settingId,settingStatus) {
  if(settingId!=""){
      if(confirm('Are you sure to Update this Setting?')){
        $.ajax({
          type: "POST",
          url: 'ajaxCalls/setSettingStatusAjax',
          data: { settingId:settingId, settingStatus : settingStatus},
          cache: false,
          success: function(data){
               // alert(data);
            if(data){
              alert('Setting Updated Successfully');
              location.reload();
            }
          }
      });
    }
  }
}
$('#levelSetting').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var modal = $(this);
  var id = recipient;
  $.ajax({
    type: "POST",
    url: "ajaxCalls/levelSettingAjax",
    data: { id: id },
    cache: false,
    success: function (data) {
      console.log(data);
      modal.find('.levelEditDash').html(data);
    },
    error: function(err) {
      console.log(err);
    }
  });  
})
var d = document.getElementById("Setting");
    d.className += " active";
var d = document.getElementById("miscSetting");
    d.className += " active";
</script>
</body>
</html> 