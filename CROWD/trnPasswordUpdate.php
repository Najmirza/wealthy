<?php
    include("loginCheck.php");
    require_once('../PHPMailer/EncrptyModel.php');
    use PHPMailer\PHPMailer\PHPMailer;
    $userId=$_GET['user_id'];
    $queryMail=mysqli_query($con,"SELECT member_id,name,email_id FROM meddolic_user_details WHERE user_id='$userId' AND user_type=2 AND account_status=1");
    if($valMail=mysqli_fetch_array($queryMail)){ 
        $member_id=$valMail['member_id'];
        $emailId=$valMail['email_id'];
        $name=$valMail['name'];
        function trnPassword( $length = 6 ) {
            $chars = "0123456789";
            $password = substr( str_shuffle( $chars ), 0, $length );
            return $password;
        }   
        $trnPassword=trnPassword (6);
        $passObj= new passEncrypt();
        $encTrnPass= $passObj -> twoPassEncrypt($trnPassword);
        $queryupdate=mysqli_query($con,"UPDATE meddolic_user_details SET trnPassword='$encTrnPass' WHERE member_id='$member_id'");
        
        require_once "../PHPMailer/PHPMailer.php";
        require_once "../PHPMailer/SMTP.php";
        require_once "../PHPMailer/Exception.php";
        require_once "../PHPMailer/OAuthCredential.php";
        $mailSubject="Wealthy Crowd Transaction Password Recover";
        $newMsg='    <html>
        <head>
          <title>Login Transaction Password Recovery - Wealthy Crowd</title>
          <link href="https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
          <div style="background-color: #f2f2f2; padding: 20px;">
            <h1>Login Transaction Password Recovery - Wealthy Crowd</h1>
            <p>Dear <strong>'.$name.'</strong>,</p>
            <p>Greetings from Wealthy Crowd! We received your request to recover your login Transaction  password for your Wealthy Crowd account. We understand the importance of accessing your account and are here to assist you.</p>
            <ul>
              <li>Your User ID: <strong>'.$userId.'</strong></li>
              <li>Login Transaction  Password: <em>'.$trnPassword.'</em></li>
            </ul>
            <p>If you did not make this request or need further assistance, please contact our support team immediately.</p>
            <p>Best Regards,</p>
            <p><strong>TEAM Wealthy Crowd</strong></p>
          </div>
        </body>
      </html> ';
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
        $mail->send();  ?>
        <script>
            alert('EMAIL SEND Successfully');
            window.top.location.href="viewMemberDetails?user_id=<?= $userId?>";
        </script>
        <?php
        exit;
    }else{ ?>
        <script>
            alert('Email not Send ..Try Again');
            window.top.location.href="viewMemberDetails?user_id=<?= $userId?>";
        </script>
        <?php
        exit;
    }  ?>