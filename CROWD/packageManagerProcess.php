
<br><br><br>
<center>
<h2>Processing your request!!!</h2>
<h3>Please do not press back or refresh!!!</h3>
</center>
<?php 

ob_start();
error_reporting(E_ALL ^ E_NOTICE); 
include("loginCheck.php");
if(isset($_POST['updatePackage'])){
    $packageId=$_POST['packageId'];
    $packageStart=$_POST['packageStart'];
    $packageEnd=$_POST['packageEnd'];
    $minCashback=$_POST['minCashback'];
    $dailyCashback=$_POST['dailyCashback'];
    $returnPercent=$_POST['returnPercent'];
    $d=date("Y-m-d H:i:s");
    $todayDate=date("Y-m-d");

    $queryIn=mysqli_query($con,"UPDATE meddolic_config_package_list SET `packageStart`='$packageStart',`packageEnd`='$packageEnd',`minCashback`='$minCashback',`dailyCashback`='$dailyCashback',`returnPercent`='$returnPercent' WHERE packageId='$packageId'");
    if($queryIn){ ?>
        <script>
            alert('Rate Updated Successfully');
            window.top.location.href="packageManager";
        </script>
        <?php
        exit;
    }else{ ?>
        <script>
            alert('Rate Not Updated...Try Again');
            window.top.location.href="packageManager";
        </script>
        <?php
        exit;
    } } ?>
<?php include("../close-connection.php"); ?>