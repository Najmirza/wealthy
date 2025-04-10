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
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Business Plan Update</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Setting </a></li>
                        <li class="breadcrumb-item active"> Business Plan Update</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h2>Business Plan Update</h2>
                    </div>
                    <div class="body">
                        <form method="POST" action="businessPlanSettingProcess" onsubmit="return confirm('Are you sure?')" enctype="multipart/form-data">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Select PDF *</label>
                                            <input type="file" name="pdfPath" class="form-control" required accept=".pdf, .PDF" />
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="pdfUpdate" class="btn btn-primary action-button float-left" value="Submit" >Update PDF</button>
                                <button type="button" name="previous" class="btn btn-danger action-button-previous float-left ml-3" value="Reset" onclick="location.reload()">Reset</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>
<script>
var d = document.getElementById("Setting");
    d.className += " active";
var d = document.getElementById("businessPlanSetting");
    d.className += " active";
</script>
</body>
</html> 