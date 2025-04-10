<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="description" content="Wealthy Crowd|| Sign Up || User">
    <title>Wealthy Crowd || Sign Up Success || User</title>
    <meta name="author" content="Wealthy Crowd || Sign Up || User">
    <link rel="icon" href="assets\images\logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="User/login-assets/accountcustom.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<?php require_once('conection.php');
error_reporting(1);
unset($_SESSION['tokenSet']);
$randToken = rand(1111, 9999) . time() . date('s');
$newToken = md5($randToken);
$_SESSION['tokenSet'] = $newToken; ?>

<body class="bg">
    <div id="mainCoantiner">
        <!--dust particel-->
        <div>
            <div class="starsec"></div>
            <div class="starthird"></div>
            <div class="starfourth"></div>
            <div class="starfifth"></div>
        </div>
        <div class="container pt-3 login-form-container mb-5">
            <div class="row justify-content-sm-center">
                <div class="col-sm-6 col-md-6">

                    <div class="card account-card text-center gradient-border" id="box">
                        <div class="card-body">
                            <div class="col-md-12 text-center pb-2">
                                <a href="../index.html"><span class="text-white txt font-weight-bolder"> Home |</span></a><a id="btnForgotPassword" href="User" class="reset-password txt text-white font-weight-bolder"> Login</a>
                            </div>
                            <img src="assets\images\logo.png" class="img-fluid" style="width:180px">
                            <div class="text-white mb-4">
                                <h2>Register</h2>
                            </div>
                            <!-- <h4 class="text-center">Hunger & Debt Ltd</h4> -->
                            <form action="authRegisterProcess" class="form-signin" enctype="multipart/form-data" method="POST">
                                <?php
                                if (!empty($_GET['affiliateCode'])) {
                                    $query1 = "SELECT name,topup_flag FROM meddolic_user_details WHERE user_id='$_GET[affiliateCode]' AND topup_flag=1";
                                    $result1 = mysqli_query($con, $query1);
                                    $val1 = mysqli_fetch_assoc($result1);
                                    $sponser_name = $val1['name']; ?>
                                    <div class="row">

                                        <div class="col-sm-6 col-md-6 mx-auto">
                                            <input type="text" class="form-control mb-2" name="sponser_id1" disabled value="<?= $_GET['affiliateCode'] ?>" style="background-color: #fff0;color: #ffffff;">
                                            <input type="hidden" name="sponser_id" value="<?= $_GET['affiliateCode'] ?>">

                                        </div>
                                        <div class="col-sm-6 col-md-6 mx-auto">
                                            <input type="text" class="form-control mb-2" disabled value="<?= $sponser_name ?>" placeholder="Sponser Name" style="background-color: #fff0;color: #ffffff;">
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-sm-6 col-md-6 mx-auto">
                                            <input class="form-control mb-2" name="sponser_id" required id="sponser_id" onblur="sponserNewValid(this.value)" placeholder="Sponsor Id" style="background-color: #fff0;color: #ffffff;">
                                        </div>
                                        <div class="col-sm-6 col-md-6 mx-auto">
                                            <input type="text" class="form-control mb-2" readonly disabled id="sponsorName" placeholder="Sponser Name" style="background-color: #fff0;color: #ffffff;">
                                        </div>
                                    <?php } ?>
                                    <div class="col-sm-6 col-md-6 mx-auto">
                                        <input type="text" class="form-control mb-2" id="userName" name="name" placeholder="Enter Your Name" style="background-color: #fff0;color: #ffffff;" required />
                                        <input type="hidden" name="goodFile" value="<?= $newToken ?>">
                                    </div>
                                    <div class="col-sm-6 col-md-6 mx-auto">
                                        <input type="email" class="form-control mb-2" id="EMail" name="emailId" placeholder="Enter Email ID" style="background-color: #fff0;color: #ffffff;" required />
                                    </div>
                                    <div class="col-sm-6 col-md-6 mx-auto">
                                        <select class="form-control ps-15" required id="M_COUNTRY" name="countryId" style="margin-bottom:8px">
                                            <option value="">Select Country</option>
                                            <?php $queryCountry = "SELECT * FROM meddolic_config_country_list WHERE status=1 ORDER BY countryName ASC";
                                            $resultCountry = mysqli_query($con, $queryCountry);
                                            while ($valCountry = mysqli_fetch_assoc($resultCountry)) { ?>
                                                <option value="<?= $valCountry['country_id'] ?>"><?= $valCountry['countryName'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-md-6 mx-auto">
                                        <input type="number" class="form-control mb-2" id="MobPhone" name="phone" placeholder="Enter Mobile No" style="background-color: #fff0;color: #ffffff;" required oninput="validateMobileNumber(this)" />
                                    </div>

                                    <!-- <div class="col-sm-6 col-md-6 mx-auto mb-2">
                                        <select class="form-control ps-15 bg-transparent" id="gender" name="gender" required>
                                            <option value="mail">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 col-md-6 mx-auto">
                                        <input type="number" class="form-control mb-2" id="aadhar" name="aadhar" placeholder="Enter Aadhaar No" style="background-color: #fff0;color: #ffffff;" required />
                                    </div>

                                    <div class="col-sm-6 col-md-6 mx-auto">
                                        <input type="text" class="form-control mb-2" id="pan" name="pan" placeholder="Enter Pan No" style="background-color: #fff0;color: #ffffff;" required />
                                    </div> -->

                                    <label class="container">
                                        <input type="checkbox" checked="checked" required>
                                        <span class="checkmark"></span>
                                        Terms and condition
                                    </label>
                                    </div>
                                    <center>
                                        <div class="wrapper mt-5">
                                            <button class="btn btn4" name="submitRegister" name="submitRegister">Submit</button>
                                        </div>
                                    </center>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="User/login-assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js"></script>
    <!-- fullscreen -->
    <script src="User/login-assets/vendor_components/screenfull/screenfull.js"></script>
    <!-- popper -->
    <script src="User/login-assets/vendor_components/popper/dist/popper.min.js"></script>
    <!-- Bootstrap 4.0-->
    <script src="User/login-assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="custom.js"></script>
    <script>
        function onlynum(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function sponserNewValid(sponser_id) {
            document.getElementById("sponsorName").value = "";
            if (!sponser_id == "") {
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var v = xmlhttp.responseText;
                        if (v.trim() != "") {
                            // $("#sponsorName").html(responce);
                            document.getElementById("sponsorName").value = v.trim();
                        } else {
                            alert("Invalid Sponser ID");
                            document.getElementById("sponser_id").value = "";
                        }
                    }
                }
                xmlhttp.open("GET", "getSponserNameAjax?sponserId=" + sponser_id, true);
                xmlhttp.send();
            }
        }

        function validateMobileNumber(input) {
            const mobileNumber = input.value;
            const isValid = /^\d{10}$/.test(mobileNumber);

            if (!isValid) {
                input.setCustomValidity("Please enter a 10-digit mobile number");
            } else {
                input.setCustomValidity("");
            }
        }
        const emailInput = document.getElementById('EMail');

        emailInput.addEventListener('input', function() {
            const email = emailInput.value;
            const regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if (!regex.test(email)) {
                emailInput.setCustomValidity('Please enter a valid Email address (example@xyz.com)');
            } else {
                emailInput.setCustomValidity('');
            }
        });
    </script>
</body>

</html>