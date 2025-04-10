<?php
   include("../../conection.php");
    $stopId = $_POST['stopId'];
    $query=mysqli_query($con,"UPDATE meddolic_config_roi_stop_list SET stopStatus=0 WHERE stopId='$stopId'");
    if($query){
        echo "1";
        return true;
    } else {
        return false;
    }
?>