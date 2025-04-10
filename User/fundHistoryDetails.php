<!DOCTYPE html>
<html lang="en">
<?php 
  require_once('Include/Head.php');
  require_once("loginCheck.php");
  require_once('Include/Header.php');
  require_once('Include/Menu.php');?>
<?php
  $orderId=$_GET['orderId']; 
  $queryPay=mysqli_query($con,"SELECT a.tempId,a.packagePrice,a.priceAmount,a.priceCurrency,a.addDate,a.payAmount,a.payCurrency,a.amountReceived,a.paymentId,a.paymentStatus,a.payAddress,a.createdTime,a.updateTime,a.purchaseId,b.user_id,b.name FROM meddolic_user_invest_purchase_details a, meddolic_user_details b WHERE (a.loginMemberId='$memberId' OR a.memberId='$memberId') AND a.orderId='$orderId' AND a.memberId=b.member_id");
  $valPay=mysqli_fetch_assoc($queryPay);
  $tempId=$valPay['tempId'];
  $packagePrice=$valPay['packagePrice'];
  $priceAmount=$valPay['priceAmount'];
  $priceCurrency=$valPay['priceCurrency'];
  $addDate=$valPay['addDate'];
  $payAmount=$valPay['payAmount'];
  $payCurrency=$valPay['payCurrency'];
  $amountReceived=$valPay['amountReceived'];
  $paymentId=$valPay['paymentId'];
  $paymentStatus=$valPay['paymentStatus'];
  $payAddress=$valPay['payAddress'];
  $createdTime=$valPay['createdTime'];
  $updateTime=$valPay['updateTime'];
  $purchaseId=$valPay['purchaseId'];
  $userId=$valPay['user_id'];
  $userName=$valPay['name']; ?>

      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
        
          <div class="container-xxl flex-grow-1 container-p-y">
            
            
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Fund  /</span> Fund Request History
</h4>

<div class="container-fluid">
<div class="row">
      <div class="col-xl-6 col-lg-12">
        <div class="box">
          <div class="box-header"><span class="badge badge-success">Request Id -: <?=$orderId?></span></div>
          <div class="box-body">
            <div class="form-group">
              <label>UserId</label>
              <input type="text" class="form-control" value="<?= $userId?>" readonly >
            </div>
            <div class="form-group">
              <label>UserName</label>
              <input type="text" class="form-control" value="<?= $userName?>" readonly>
            </div>
            <div class="form-group">
              <label>Add Amount</label>
              <input type="text" class="form-control" value="<?= $packagePrice?>" readonly >
            </div>
            <div class="form-group">
              <label>Create Date</label>
              <input type="text" class="form-control" value="<?= $addDate?>" readonly >
            </div>
            <div class="form-group">
              <label>Order Id</label>
              <input type="text" class="form-control" value="<?= $orderId?>" readonly >
            </div>
            <div class="form-group">
              <label>Payment Status</label>
              <input type="text" class="form-control" value="<?= $paymentStatus?>" readonly >
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-12">
        <div class="box">
          <div class="box-body">
            <div class="col-xl-12 col-lglg-4 col-md-12 col-sm-4 col-12">
              <label class="control-label">To pay, send exact amount of <?=$payCurrency?> to the given address</label>
              <label class="control-label">Amount : <strong><?= $payAmount?></strong> <?=$payCurrency?></label>
              <p><label style="font-size:16px;">Payment Address -: <?php if($paymentStatus=="finished") echo "<span class='badge badge-success'>FINISHED</span>";else if($paymentStatus=="confirming") echo "<span class='badge badge-primary'>CONFIRMING</span>";else if($paymentStatus=="refunded") echo "<span class='badge badge-danger'>REFUNDED</span>";else if($paymentStatus=="failed") echo "<span class='badge badge-danger'>FAILED</span>";else if($paymentStatus=="partially_paid") echo "<span class='badge badge-warning'>PARTIAL PAID</span>";else if($paymentStatus=="sending") echo "<span class='badge badge-warning'>SENDING</span>";else if($paymentStatus=="confirmed") echo "<span class='badge badge-success'>CONFIRMED</span>";else if($paymentStatus=="waiting") echo "<span class='badge badge-primary'>WAITING</span>";else if($paymentStatus=="expired") echo "<span class='badge badge-danger'>EXPIRED</span>";else if($paymentStatus=="canceled") echo "<span class='badge badge-danger'>CANCELED</span>"?></p>
                <div class="row">
                  <div class="col-md-10">
                    <div class="form-group">
                      <input type="text" class="form-control pull-right" id="payAddress" value="<?=$payAddress?>"  readonly style="display: inline-block;" >
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <a onclick="copyPayAddress()" style="display: inline-block;" href="javascript:;" class="btn btn-success btn-sm" ><i class="zoom fa fa-copy " style="color:white;"></i> Copy</a>
                    </div>
                  </div>
                </div>
              <br>
              <label class="control-label">QR Code</label>
              <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?=$payAddress?>&choe=UTF-8" ><br><br>
            </div>
            <?php if($payAddress==""){ ?>
            <div class="col-xl-12 col-lg-4 col-md-12 col-sm-4 col-12">
              <a href="fundAddressGenerate?tempId=<?=$tempId?>" class="btn btn-success" onclick="return confirm('Are You Sure to Re-Generate Payment Address?')">Re Generate Address</a>
            </div> 
            <?php } ?>
          </div>
        </div>
      </div>
    </div> 
  </div>
</div>
          
          

          <?php require_once('Include/Footer.php');?>
          <script>
function copyPayAddress(){
  var copyText = document.getElementById("payAddress");
  copyText.select();
  document.execCommand("Copy");
  alert("Pay Address Copied Successfully!!!");
}
var d = document.getElementById("Fund");
  d.className += " active";
var d = document.getElementById("fundRequest");
  d.className += " active";
</script>
</body>

</html>