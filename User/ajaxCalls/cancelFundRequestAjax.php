<?php
   include("../../conection.php");
    $tempId = $_POST['tempId'];
    $orderId = $_POST['orderId'];
    $query=mysqli_query($con,"UPDATE meddolic_user_invest_purchase_details SET paymentStatus='canceled',actionTaken=1,nextPayOpen=1 WHERE tempId='$tempId' AND orderId='$orderId' AND actionTaken=0");
    if($query){
        echo "1";
        return true;
    } else {
        return false;
    } ?>