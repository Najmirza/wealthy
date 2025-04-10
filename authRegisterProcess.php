
<br><br><br>
<center>
<h2>Processing your request!!!</h2>
<h3>Please do not press back or refresh!!!</h3>
</center>
<?php 
use PHPMailer\PHPMailer\PHPMailer;
require_once("conection.php");
require('PHPMailer/EncrptyModel.php');
if(isset($_POST['submitRegister'])){
$newToken=$_SESSION['tokenSet'];
$goodFile=mysqli_real_escape_string($con,$_POST['goodFile']);
if($goodFile==$newToken){
    $name=mysqli_real_escape_string($con,$_POST['name']);
    $sponser_id=mysqli_real_escape_string($con,$_POST['sponser_id']);
    $emailId=mysqli_real_escape_string($con,$_POST['emailId']);
    $phone=mysqli_real_escape_string($con,$_POST['phone']);
    $countryId=mysqli_real_escape_string($con,$_POST['countryId']);
    // $aadhar=mysqli_real_escape_string($con,$_POST['aadhar']);
    // $pan=mysqli_real_escape_string($con,$_POST['pan']);
    $d=date("Y-m-d H:i:s");
    $dt=date("Y-m-d");

    $queryCheck=mysqli_query($con,"SELECT * FROM meddolic_user_details WHERE user_id='$sponser_id' AND account_status=1 AND topup_flag=1");
    if(!mysqli_num_rows($queryCheck)) { ?>
        <script>
            alert("Invalid / Suspended Sponser Id!!!");
            history.go(-1);
        </script>
        <?php
        exit;
    }
    
    $querySponser=mysqli_query($con,"SELECT member_id from meddolic_user_details where user_id='$sponser_id'");
    $valSponser=mysqli_fetch_array($querySponser);
    $sponser_member_id=$valSponser[0];

    function trnPassword( $length = 6 ) {
        $chars = "0123456789";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }
    $loginPassword=trnPassword (6);
    $trnPassword=trnPassword (6);

    $passObj= new passEncrypt();
    $encLogPass= $passObj -> twoPassEncrypt($loginPassword);
    $encTrnPass= $passObj -> twoPassEncrypt($trnPassword);
    $queryInsert=mysqli_query($con,"INSERT INTO meddolic_user_details (`name`,`email_id`,`phone`,`password`,`trnPassword`,`sponser_id`,`date_time`,`countryId`) VALUES ('$name','$emailId','$phone','$encLogPass','$encTrnPass','$sponser_member_id','$d','$countryId')");
    $used_member_id = $con->insert_id;
    $newMember=base64_encode($used_member_id);
    $newMd=md5($used_member_id);
    $newSha=sha1($used_member_id);

    $_SESSION['newDevineToken'] = $used_member_id;
    $_SESSION['newAdvineToken'] = $newSha;
    $_SESSION['ngDefine'] = $newMd;
    $_SESSION['newLogPass'] = $loginPassword;
    $_SESSION['ngTrnPass'] = $trnPassword;

    function userIdSet($con,$used_member_id,$name,$loginPassword,$d,$emailId,$trnPassword){
        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";
        require_once "PHPMailer/OAuthCredential.php";
        $user_id="WC".rand(11,99).rand(111,999);
        $queryExist=mysqli_query($con,"SELECT COUNT(1) FROM meddolic_user_details WHERE user_id='$user_id'");
        $valExist=mysqli_fetch_array($queryExist);
        if($valExist[0]==0){
            mysqli_query($con,"UPDATE meddolic_user_details SET user_id='$user_id' WHERE member_id='$used_member_id'");
            $mailSubject="Wealthy Crowd Account Details";
            $newMsg='   <html>
            <head>
              <title>Welcome to Wealthy Crowd</title>
              <link href="https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css" rel="stylesheet" type="text/css" />
            </head>
            <body>
              <div style="background-color: #f2f2f2; padding: 20px;">
                <h1>Welcome to Wealthy Crowd</h1>
                <p>Dear Member, ' . $name . ',</p>
                <p>Welcome to Wealthy Crowd. We are thrilled to have you as a new member of our growing community. Congratulations on taking the first step towards exploring the exciting world of decentralized Web 3.0 blockchain-based digital world.</p>
               
                <ul>
                  <li>Affiliate ID: ' . $user_id . '</li>
                  <li>Login Password:' . $loginPassword . '</li>
                  <li>Transaction Password: ' . $trnPassword . '</li>
                </ul>
        
                <p>Best Regards,</p>
                <img src="https://cygnetglobal.io/images/CEG00.png" alt="" style="height:60px; width:60px;">
                <p>TEAM Wealthy Crowd ECO SYSTEM</p>
              </div>
            </body>
            </html>';
            $mail = new PHPMailer();
            $mail->isSMTP();
            // $mail->SMTPDebug = 4;  //Keep It commented this is used for debugging                          
            $mail->Host = smtpServer; // smtp address of your email
            $mail->SMTPAuth = true;
            $mail->Username = EmailCode;
            $mail->Password = addCode;
            $mail->Port = smtpPort; 
            $mail->SMTPSecure = "tls"; 
            $mail->smtpConnect([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                ]
            ]);

            //Email Settings
            $mail->isHTML(true);
            $mail->setFrom(EmailCode, mailerName);
            $mail->addAddress($emailId); // enter email address whom you want to send
            $mail->Subject = ("$mailSubject");
            $mail->Body = $newMsg;
            $mail->send();
        }else{
            userIdSet($con,$used_member_id,$name,$loginPassword,$d,$emailId,$trnPassword);
        }
    }
    userIdSet($con,$used_member_id,$name,$loginPassword,$d,$emailId,$trnPassword);

    //Joining Code Ends//    

    //Child ID Code Starts//

    $queryChild=mysqli_query($con,"SELECT sponser_id,date_time FROM meddolic_user_details WHERE member_id='$used_member_id'");
    $valChild=mysqli_fetch_array($queryChild);
    $parent_id=$valChild[0];
    $date_time=$valChild[1];
    $level=1;
    while($parent_id){
        mysqli_query($con,"INSERT INTO meddolic_user_child_ids (`member_id`,`child_id`,`level`,`date_time`) VALUES ('$parent_id','$used_member_id','$level','$date_time')");

        $queryUser=mysqli_query($con,"SELECT sponser_id FROM meddolic_user_details WHERE member_id='$parent_id'");
        $valUser=mysqli_fetch_array($queryUser);
        $parent_id=$valUser[0];
        $level++;
    }
    //Child ID Code Ends//
    unset($_SESSION['tokenSet']); ?>
    <script>
        window.top.location.href="authRegisterSuccess?BorCool=<?=$newMd?>&glowCoco=<?=$newMember?>&kriNote=<?=$newSha?>";
    </script> 
<?php } else { ?>
    <script>
        alert('Your Session Expired.Please re Submit your form Again');
        history.go(-1);
    </script> 
<?php } } ?>
<?php require("close-connection.php"); ?>