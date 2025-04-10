<?php
require_once("loginCheck.php");
require_once('Include/Head.php');
require_once('Include/Header.php');
require_once('Include/Menu.php'); ?>
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Profile /</span> Wallet Address Add
    </h4>

    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <h4 class="card-header">Wallet Address</h4>
          
          </div>
          <div class="card-body pt-2 mt-1">
            <form action="userProfileAuthProcess" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                  <span>Select Currency *</span>
                    <select class="form-control" required  name="currencyId">
                      <option value="">Select One</option>
                      <?php $queryCoin=mysqli_query($con,"SELECT * FROM meddolic_config_currency_list WHERE status=1 ORDER BY currencyName ASC");
                            while($valCoin=mysqli_fetch_assoc($queryCoin)){ ?>
                                <option value="<?=$valCoin['currency_id']?>"> <?=$valCoin['currencyName']?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
              <div class="row mt-2 gy-4">
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                  <span>Wallet Address *</span>
                  <input class="form-control" name="walletAddress" id="walletAddress" type="text" required placeholder="Enter Wallet Address">
                  <input type="hidden" name="memberId" value="<?=$memberId?>"/>
                  </div>
                </div>
                
            <div class="col-md-12">
                <button type="submit" name="addWalletAddress" class="btn btn-primary col-md-2 col-sm-3">Save</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      </div>
      </div>
      <div class="table-panel">
            <div class="row">    
                <div class="col-lg-12">                	
                    <div class="table-responsive">
                    	<table id="example" class="table table-bordered table-custom table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Currency Name</th>
                                    <th>Wallet Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $count=0;
                            $queryWallet=mysqli_query($con,"SELECT a.payment_id,a.walletAddress,a.addDate,b.currencyName FROM meddolic_user_wallet_address_details a, meddolic_config_currency_list b WHERE a.member_id='$memberId' AND a.currency_id=b.currency_id AND a.status=1 ORDER BY a.addDate DESC");
                            while($valWallet=mysqli_fetch_assoc($queryWallet)){ 
                              $count++; ?>
                                <tr>
                                    <td><?= $count?></td>
                                    <td><?= $valWallet['currencyName']?></td>
                                    <td><?= $valWallet['walletAddress']?></td>
                                    <td><a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteWalletAddress(<?=$valWallet['payment_id']?>)"><i class="fa fa-trash"></i> Delete</a></td>
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
  <!-- / Content -->


  <?php require_once('Include/Footer.php'); ?>
  <script>
function deleteWalletAddress(paymentId){
    if(paymentId!=""){
        if(confirm('Are you sure to Delete this Wallet Address?')){
            $.ajax({
                type: "POST",
                url: 'ajaxCalls/deleteWalletAddressAjax',
                data: { paymentId:paymentId },
                cache: false,
                success: function(data){
                    // alert(data);
                    if(data){
                        alert('Wallet Address Deleted Successfully');
                        location.reload();
                    }
                }
            });
        }
    }
}
</script>