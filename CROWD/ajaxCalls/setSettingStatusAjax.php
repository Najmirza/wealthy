<?php
    include("../../conection.php");
    $settingId = $_POST['settingId'];
    $settingStatus = $_POST['settingStatus'];
    $query=mysqli_query($con,"UPDATE meddolic_config_setting SET status='$settingStatus' WHERE id='$settingId'");
    if($query){
        echo true;
    } else {
        return false;
    }
?>