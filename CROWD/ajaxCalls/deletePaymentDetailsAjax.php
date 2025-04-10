<?php
   include("../../conection.php");
    $paymentId = $_POST['paymentId'];
    $query=mysqli_query($con,"UPDATE meddolic_config_payment_details SET status=0 WHERE payment_id='$paymentId'");
    if($query){
        echo true;
    } else {
        return false;
    } ?>