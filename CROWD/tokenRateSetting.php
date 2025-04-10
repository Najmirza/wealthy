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
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Token Setting</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Token </a></li>
                        <li class="breadcrumb-item active">Token Setting</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Token Setting</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Token Rate</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $count=0;
                                    $queryToken=mysqli_query($con,"SELECT id,coinRate FROM meddolic_config_misc_setting");
                                    while($valToken=mysqli_fetch_array($queryToken)){
                                      $count++; ?>
                                    <tr>
                                        <td><?= $count?></td>
                                        <td>$  <?= $valToken['coinRate']?></td>
                                        <td><a data-id="<?= $valToken['id'];?>" data-toggle="modal" data-target="#tokenRateEdit" data-whatever="<?= $valToken['id'];?>" href="#" data-backdrop="static" data-keyboard="false" class="btn btn-success btn-sm">Edit</a></td>
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
<!-- Coin Rate Edit Modal -->
<div class="modal fade" id="tokenRateEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="tokenDash"></div>
    </div>
  </div>
</div>
<?php include('include/footer.php'); ?>
<script>
$('#tokenRateEdit').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var modal = $(this);
  var tokenId = recipient;
  // alert("helo");
    $.ajax({
      type: "POST",
      url: 'ajaxCalls/tokenRateAjaxFetch',
      data: { tokenId : tokenId },
      cache: false,
      success: function (data) {
          console.log(data);
          modal.find('.tokenDash').html(data);
      },
      error: function(err) {
          console.log(err);
      }
    });  
})
var d = document.getElementById("Token");
    d.className += " active";
var d = document.getElementById("tokenRateSetting");
    d.className += " active";
</script>
</body>
</html> 