<?php
require_once("../conection.php");
if($_SESSION['member_user_id']!="" && $_SESSION['member_password']!=""){
    $userId=mysqli_real_escape_string($con,$_SESSION['member_user_id']);
    $passKey=mysqli_real_escape_string($con,$_SESSION['member_password']);
    $queryLog=mysqli_query($con,"SELECT * FROM meddolic_user_details WHERE user_id='$userId' AND password='$passKey' AND user_type=2 AND account_status=1");
    $countLog=mysqli_num_rows($queryLog);
    if($countLog==1) { 
        $valDetails=mysqli_fetch_assoc($queryLog);
        unset($_COOKIE['memberUserId']);
        setcookie('memberUserId', null, -1, '/');
        unset($_COOKIE['memberPassKey']);
        setcookie('memberPassKey', null, -1, '/');
        setcookie ("memberUserId",$valDetails["user_id"],time()+ 3600);
        setcookie ("memberPassKey",$valDetails["password"],time()+ 3600); ?>
        <script>
            window.top.location.href="Dashboard";
        </script>
        <?php
        exit;
    }else { echo "<script>self.location='LoginAuth';</script>;"; } 
} else {
    echo "<script>self.location='LoginAuth';</script>;";
} ?>
