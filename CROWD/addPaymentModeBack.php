
<br><br><br>
<center>
<h2>Processing your request!!!</h2>
<h3>Please do not press back or refresh!!!</h3>
</center>
<?php 

ob_start();
error_reporting(E_ALL ^ E_NOTICE);
include("loginCheck.php");
if(isset($_POST['addPaymentMode'])){
    $paymentName=$_POST['paymentName'];
    $paymentAddress=$_POST['paymentAddress'];
    $d=date("Y-m-d H:i:s");
    $todayDate=date("Y-m-d");

    $queryIn=mysqli_query($con,"INSERT INTO meddolic_config_payment_details (`paymentName`,`paymentAddress`) VALUES ('$paymentName','$paymentAddress')");

    $payment_id=$con->insert_id;
    if($queryIn){
        if(!empty($_FILES['paymentImage']['name'])){
            $allowedExts = array("gif", "jpeg", "jpg", "png","GIF","JPEG","JPG","PNG");
            $temp = explode(".", $_FILES["paymentImage"]["name"]);
            $extension = end($temp);
            if ((($_FILES["paymentImage"]["type"] == "image/gif")
            || ($_FILES["paymentImage"]["type"] == "image/jpeg")
            || ($_FILES["paymentImage"]["type"] == "image/jpg")
            || ($_FILES["paymentImage"]["type"] == "image/png")
            || ($_FILES["paymentImage"]["type"] == "application/png"))
            && ($_FILES["paymentImage"]["size"] < 5000000)
            && in_array($extension, $allowedExts))    {
                if ($_FILES["paymentImage"]["error"] > 0){
                // echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                } else{
                    $newFileName = uniqid('QRImage-', true) 
                    . '.' . strtolower(pathinfo($_FILES['paymentImage']['name'], PATHINFO_EXTENSION));
                      move_uploaded_file($_FILES["paymentImage"]["tmp_name"],
                      "../assets/SupportFile/" . $newFileName);
                      // echo "Stored in: " . "upload/logo/" . $_FILES["file"]["name"];
                    $paymentImage = "assets/SupportFile/" . $newFileName;
                    $file = $_FILES["paymentImage"]["name"];
                    mysqli_query($con,"UPDATE meddolic_config_payment_details SET paymentImage='$paymentImage' WHERE payment_id='$payment_id'");
                }
              }
            } ?>
        <script>
            alert('Payment Mode Added Successfully');
            window.top.location.href="paymentDetailsUpdate";
        </script>
        <?php
        exit;
    }else{ ?>
        <script>
            alert('Payment Mode Not Added...Try Again');
            window.top.location.href="paymentDetailsUpdate";
        </script>
        <?php
        exit;
    } } ?>
<?php include("../close-connection.php"); ?>