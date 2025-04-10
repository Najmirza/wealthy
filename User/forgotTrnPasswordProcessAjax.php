<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require_once('../conection.php');
    require('../PHPMailer/EncrptyModel.php');
	$d=date("Y-m-d H:i:s");
	$userId=mysqli_real_escape_string($con,$_POST['userId']);
	$d=date('Y-m-d H:i:s');
    $queryDetails=mysqli_query($con,"SELECT member_id,name,phone,user_id,email_id FROM meddolic_user_details WHERE user_id='$userId' AND user_type=2 AND account_status=1");
    if($valDetails=mysqli_fetch_array($queryDetails)){
    	$email_id=$valDetails['email_id'];
        $memberId=$valDetails['member_id'];
        $name=$valDetails['name'];
        $phone=$valDetails['phone'];
        $user_id=$valDetails['user_id'];

        function trnPassword( $length = 6 ) {
            $chars = "0123456789";
            $password = substr( str_shuffle( $chars ), 0, $length );
            return $password;
        }   
    
        $trnPassword=trnPassword (6);
        $passObj= new passEncrypt();

        $encTrnPass= $passObj -> twoPassEncrypt($trnPassword);

        $queryupdate=mysqli_query($con,"UPDATE meddolic_user_details SET  trnPassword='$encTrnPass' WHERE member_id='$memberId'");

        require_once "../PHPMailer/PHPMailer.php";
        require_once "../PHPMailer/SMTP.php";
        require_once "../PHPMailer/Exception.php";
        require_once "../PHPMailer/OAuthCredential.php";
    	
        $mailSubject="Wealthy Crowd Transaction Password Recover";
        $newMsg=' <html>
        <head>
          <title>Login Transaction Password Recovery - Wealthy Crowd</title>
          <link href="https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
          <div style="background-color: #f2f2f2; padding: 20px;">
            <h1>Login Transaction Password Recovery - Wealthy Crowd</h1>
            <p>Dear '.$name.',</p>
            <p>Greetings from Wealthy Crowd! We received your request to recover your login Transaction password for your Wealthy Crowd account. We understand the importance of accessing your account and are here to assist you.</p>
            <ul>
              <li>Your User ID: '.$userId.'</li>
              <li>Login Transaction Password: '.$trnPassword.'</li>
            </ul>
        
            <p>Best Regards,</p>
            <img src="	https://cygnetglobal.io/images/CEG00.png" alt="" style="height:60px; width:60px;">
             <p>TEAM Wealthy Crowd ECO SYSTEM</p>
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
        $mail->addAddress($email_id); // enter email address whom you want to send
        $mail->Subject = ("$mailSubject");
        $mail->Body = $newMsg;
        $mail->send();
        echo "../../";
		} else {
			return false ;
		} ?>