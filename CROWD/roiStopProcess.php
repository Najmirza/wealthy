<?php 
ob_start();
error_reporting(E_ALL ^ E_NOTICE);
include("loginCheck.php");
if(isset($_POST['addStopDate'])){
    $stopDate=date('Y-m-d',strtotime($_POST['stopDate']));
    $d=date("Y-m-d H:i:s");
    $todayDate=date("Y-m-d");
    if($stopDate<$todayDate){ ?>
        <script>
            alert('Select Greater Date From Today Date!!!');
            window.top.location.href="roiStop";
        </script>
        <?php
        exit;
    }
    $queryIn=mysqli_query($con,"INSERT INTO meddolic_config_roi_stop_list (`stopDate`,`addDate`) VALUES ('$stopDate','$d')");
    if($queryIn){ ?>
        <script>
            alert('ROI Stop Date Added Successfully');
            window.top.location.href="roiStop";
        </script>
        <?php
        exit;
    }else{ ?>
        <script>
            alert('ROI Stop Date Not Added...Try Again');
            window.top.location.href="roiStop";
        </script>
        <?php
        exit;
    } } ?>d
<?php include("../close-connection.php"); ?>