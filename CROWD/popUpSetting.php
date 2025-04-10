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
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Popup Update</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Setting </a></li>
                        <li class="breadcrumb-item active">Popup Update</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Popup Update</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>                    
                                        <th>Dashboard Notice</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $queryConfig=mysqli_query($con,"SELECT * from meddolic_config_misc_setting");
                                    $valConfig=mysqli_fetch_assoc($queryConfig); ?>
                                    <tr>
                                        <form action="popUpSettingProcess" method="POST" enctype="multipart/form-data" > 
                                            <td>1</td>
                                            <td><?php if($valConfig['dashboardImage']!="") { ?><img src="../<?=$valConfig['dashboardImage']?>" class="img-responsive" height="100px" width="100px"><?php } ?> &nbsp; <input type="file" name="dashboardImage" class="form-control-file" required accept=".jpg, .JPG, .png, .PNG, .jpeg, .JPEG, .gif, .GIF" ></td> 
                                            <td class="text-center"><input type="submit" class="btn btn-success" name="imageUpdate" value="Update">
                                            <?php if($valConfig['imageStatus']==0){ ?>
                                                <a href="javascript:void();" class="btn btn-warning" onclick="updateImageStatus(1)">Show</a>
                                            <?php } else { ?>
                                                <a href="javascript:void();" class="btn btn-danger" onclick="updateImageStatus(0)">Hide</a>
                                            <?php } ?></td>
                                        </form>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>
<script>
function updateImageStatus(imageStatus){
  $.ajax({
      type: "POST",
      url: 'ajaxCalls/updateImageStatusAjax',
      data: { imageStatus:imageStatus },
      cache: false,
      success: function(data){
         if(data){
          alert('Updated Successfully');
          location.reload();
         }
      }
  });
}
var d = document.getElementById("Setting");
    d.className += " active";
var d = document.getElementById("popUpSetting");
    d.className += " active";
</script>
</body>
</html> 