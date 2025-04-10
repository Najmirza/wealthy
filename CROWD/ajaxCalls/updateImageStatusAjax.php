<?php
   include("../../conection.php");
    $imageStatus=$_POST['imageStatus'];
    $query=mysqli_query($con,"UPDATE meddolic_config_misc_setting SET imageStatus='$imageStatus'");
    if($query){
        echo "1";
        return true;
    } else {
        return false;
    } ?>