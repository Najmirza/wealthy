<?php
    include("../../conection.php");
    $pinId = $_POST['pinId'];
    $query=mysqli_query($con,"UPDATE meddolic_config_pin_type SET pinStatus=0 WHERE pin_id='$pinId'");
    if($query){
        echo true;
    } else {
        return false;
    }
?>