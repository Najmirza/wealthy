<?php
    include("../conection.php");
    use PHPMailer\PHPMailer\PHPMailer;
    $currentTime = $_POST['currentTime'];
    $otpCode=rand(11111,99999);
    unset($_SESSION['loginOTP']);
    $_SESSION['loginOTP']=md5($otpCode);
    $emailId='botmineadm@gmail.com';
    
    require_once "../PHPMailer/PHPMailer.php";
    require_once "../PHPMailer/SMTP.php";
    require_once "../PHPMailer/Exception.php";
    require_once "../PHPMailer/OAuthCredential.php";
    
    $mailSubject="Wealthy Crowd OTP Verification";
        $newMsg='<html>
                    <head>
                        <title>Wealthy Crowd OTP Verification</title>
                        <link href="https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css" rel="stylesheet" type="text/css" />
                    </head>
                    <body><span style="background-color:#ffffff; color:#222222; font-family:arial,helvetica,sans-serif; font-size:small">Dear ,&nbsp;</span><span style="color:#ff0000"><span style="font-family:comic sans ms,cursive"><span style="font-size:small"><strong> Wealthy Crowd Admin </strong></span></span></span><span style="background-color:#ffffff; color:#222222; font-family:arial,helvetica,sans-serif; font-size:small">,&nbsp;<br />
                    <br /> Your Verification Login OTP Code Will be <strong>OTP CODE : </strong>  <strong>'.$otpCode.'</strong></span><br />
                    <br />Much appreciated and Respect:</span><br />
                    <span style="font-family:georgia,serif"><span style="background-color:rgb(255, 255, 255); font-size:small"><strong>Wealthy Crowd TEAM</strong></span></span><span style="background-color:rgb(255, 255, 255); color:rgb(34, 34, 34); font-family:arial,helvetica,sans-serif; font-size:small">.</span></body></html>';
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 4;  //Keep It commented this is used for debugging                          
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

        echo "true";
        return true; ?>