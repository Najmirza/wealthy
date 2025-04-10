<?php
include("loginCheck.php");
if (isset($_POST['profileUpdate'])) {
    $memberId = $_POST['memberId'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $emailId = $_POST['emailId'];
    $countryId = $_POST['countryId'];
    $aadhar = $_POST['aadhar'];
    $pan = $_POST['pan'];
    $d = date("Y-m-d H:i:s");

    mysqli_query($con, "UPDATE meddolic_user_details SET name='$name',email_id='$emailId',phone='$phone',countryId='$countryId',aadhar='$aadhar',pan='$pan' WHERE member_id='$memberId'"); ?>
    <script>
        alert("Profile Updated Successfully!!!");
        window.top.location.href = "userProfileAuth";
    </script>
<?php
}

if(isset($_POST['addWalletAddress'])){
    $currencyId=$_POST['currencyId'];
    $memberId=$_POST['memberId'];
    $walletAddress=$_POST['walletAddress'];
    $emailOtp=md5($_POST['emailOtp']);
    $actualOtp=$_SESSION['addressVerifyOTP'];
    $d=date("Y-m-d H:i:s");
    $todayDate=date("Y-m-d");
    // if($actualOtp<>$emailOtp){
    //     unset($_SESSION['addressVerifyOTP']);?>
    //     <script>
    //         alert("Invalid OTP Enter");
    //         window.top.location.href='walletAddressAdd';
    //     </script>
    //     <?php
    //     exit;
    // }
    $queryIn=mysqli_query($con,"INSERT INTO meddolic_user_wallet_address_details (`currency_id`,`member_id`,`walletAddress`,`addDate`) VALUES ('$currencyId','$memberId','$walletAddress','$d')");
    if($queryIn){  ?>
        <script>
            alert('Wallet Address Added Successfully');
            window.top.location.href="walletAddressAdd";
        </script>
        <?php
        exit;
    }else{ ?>
        <script>
            alert('Wallet Address Not Added...Try Again');
            window.top.location.href="walletAddressAdd";
        </script>
        <?php
        exit;
    } }

if (isset($_POST['bankUpdate'])) {
    $memberId = $_POST['memberId'];
    $ifsc = $_POST['ifsc'];
    $bank = $_POST['bank'];
    $acName = $_POST['acName'];
    $branch = $_POST['branch'];
    $accountNo = $_POST['accountNo'];

    mysqli_query($con, "UPDATE meddolic_user_details SET ifsc=ucase('$ifsc'),bank=ucase('$bank'),branch=ucase('$branch'),accountNo='$accountNo',acName='$acName' WHERE member_id='$memberId'");
?>
    <script>
        alert('Bank Details Updated Successfully!!!');
        window.top.location.href = "bankDetails";
    </script>
    <?php
}

if (isset($_POST['changeLogin'])) {
    $memberId = $_POST['memberId'];
    $password = $_POST['password'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $d = date("Y-m-d H:i:s");

    if ($password2 != $password1) { ?>
        <script>
            alert("New Login passwords do not match!!!");
            window.top.location.href = 'changePassword';
        </script>
    <?php
        exit;
    }

    $newCalObj = new passEncrypt;
    $encPass = $newCalObj->twoPassEncrypt($password);
    $result = mysqli_query($con, "SELECT count(*) FROM meddolic_user_details WHERE member_id='$memberId' AND password='$encPass'");
    $val = mysqli_fetch_array($result);
    if ($val[0] == 0) { ?>
        <script>
            alert("Incorrect Current Login password!!!");
            window.top.location.href = 'changePassword';
        </script>
    <?php
        exit;
    }
    $newCalObj = new passEncrypt;
    $newEncPass = $newCalObj->twoPassEncrypt($password1);
    $result1 = mysqli_query($con, "UPDATE meddolic_user_details SET password='$newEncPass' WHERE member_id='$memberId'");
    if ($result1) {
        unset($_SESSION['user_member_id']);
        unset($_SESSION['member_user_id']);
        unset($_SESSION['member_password']); ?>
        <script>
            alert("Login Password Updated Successfully!!!\nNow please login again with new password. ");
            window.top.location.href = 'changePassword';
        </script>
    <?php
    }
}
if (isset($_POST['changeTrn'])) {
    $memberId = $_POST['memberId'];
    $password = $_POST['password'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $d = date("Y-m-d H:i:s");
    if ($password2 != $password1) { ?>
        <script>
            alert("New Login passwords do not match!!!");
            window.top.location.href = 'TrnPassword';
        </script>
    <?php
        exit;
    }
    $newCalObj = new passEncrypt;
    $encTrnPass = $newCalObj->twoPassEncrypt($password);
    $result = mysqli_query($con, "SELECT count(*) FROM meddolic_user_details WHERE member_id='$memberId' AND trnPassword='$encTrnPass'");
    $val = mysqli_fetch_array($result);
    if ($val[0] == 0) { ?>
        <script>
            alert("Incorrect Current Transaction password!!!");
            window.top.location.href = 'TrnPassword';
        </script>
    <?php
        exit;
    }
    $newCalObj = new passEncrypt;
    $newencTrnPass = $newCalObj->twoPassEncrypt($password1);
    $result1 = mysqli_query($con, "UPDATE meddolic_user_details SET trnPassword='$newencTrnPass' WHERE member_id='$memberId'");
    if ($result1) { ?>
        <script>
            alert("Transaction Password Updated Successfully!!!");
            window.top.location.href = 'TrnPassword';
        </script>
<?php
    }
} ?>
<?php include("../close-connection.php"); ?>