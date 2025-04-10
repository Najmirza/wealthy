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
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Cashback Setting</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Setting </a></li>
                        <li class="breadcrumb-item active"> Cashback Setting</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Cashback Setting</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Start Package</th>
                                        <th>End Package</th>
                                        <th>CashBack Percent</th>
                                        <th>Daily Percent</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $count=0;
                                    $queryPackage=mysqli_query($con,"SELECT * FROM meddolic_config_package_list ORDER BY packageId ASC");
                                    while($valPackage=mysqli_fetch_assoc($queryPackage)){ 
                                        $count++; ?>
                                    <tr>
                                        <td><?=$count?></td>
                                        <td>$  <?=$valPackage['packageStart']?></td>
                                        <td>$  <?=$valPackage['packageEnd']?></td>
                                        <td><?=$valPackage['minCashback']?> - <?=$valPackage['dailyCashback']?> <i class="fa fa-percent"></i></td>
                                        <td><?=$valPackage['returnPercent']?> <i class="fa fa-percent"></i></td>
                                        <td><a data-id="<?= $valPackage['packageId']?>" data-toggle="modal" data-target="#editPackage" data-whatever="<?= $valPackage['packageId']?>" href="#" class="btn btn-success btn-sm" > Edit </a></td>
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
<div class="modal fade" id="editPackage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="packageEditDash">
             <!-- Content goes in here -->
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>
<script>
$('#editPackage').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var modal = $(this);
  var packageId = recipient;
  $.ajax({
    type: "POST",
    url: "ajaxCalls/editPackageAjax",
    data: { packageId: packageId },
    cache: false,
    success: function (data) {
      console.log(data);
      modal.find('.packageEditDash').html(data);
    },
    error: function(err) {
      console.log(err);
    }
  });  
})
var d = document.getElementById("Setting");
    d.className += " active";
var d = document.getElementById("packageManager");
    d.className += " active";
</script>
</body>
</html> 