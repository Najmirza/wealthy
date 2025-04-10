<?php include('../../conection.php');

  $payment_id=$_POST['paymentId'];

  $queryDetails=mysqli_query($con,"SELECT * FROM meddolic_config_payment_details WHERE payment_id='$payment_id'");
  $valDetails=mysqli_fetch_assoc($queryDetails); ?>
  <div class="box">
    <div class="card-header"> <?=$valDetails['paymentName']?> </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <textarea type='text' class="form-control" readonly onclick="copyTronLink()" id="tronLink" ><?=$valDetails['paymentAddress']?></textarea>
        </div>
        <div class="col-md-6">
          <?php if($valDetails['paymentImage']!="") { ?><img src="../<?=$valDetails['paymentImage']?>" class="img-responsive" width="200%" height="100%"><?php } ?>
        </div>
      </div>
    </div>
  </div>