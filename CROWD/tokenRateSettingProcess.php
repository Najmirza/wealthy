
<br><br><br>
<center>
<h2>Processing your request!!!</h2>
<h3>Please do not press back or refresh!!!</h3>
</center>
<?php 
include("loginCheck.php");
if(isset($_POST['coinUpdate'])){
    $coinRate=$_POST['coinRate'];
    $tokenId=$_POST['tokenId'];
    $d=date('Y-m-d H:i:s');
    
    $queryIn=mysqli_query($con,"UPDATE meddolic_config_misc_setting SET coinRate='$coinRate'");
    if($queryIn){ ?>
        <script>
            alert('Token Updated Successfully');
            window.top.location.href="tokenRateSetting";
        </script>
        <?php
        exit;
    }else{ ?>
        <script>
            alert('Token Not Updated...Try Again');
            window.top.location.href="tokenRateSetting";
        </script>
        <?php
        exit;
    } } ?>
<?php include("../close-connection.php"); ?>