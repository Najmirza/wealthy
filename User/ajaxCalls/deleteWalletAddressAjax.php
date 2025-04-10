<?php
   include("../../conection.php");
    $paymentId = $_POST['paymentId'];
    $query=mysqli_query($con,"UPDATE meddolic_user_wallet_address_details SET status=0 WHERE payment_id='$paymentId'");
    if($query){
        echo "1";
        return true;
    } else {
        return false;
    } ?>