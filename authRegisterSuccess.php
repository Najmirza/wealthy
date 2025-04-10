<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="description" content="Wealthy Crowd|| Sign Up || User">
    <title>Wealthy Crowd ||  Success || User</title>
    <meta name="author" content="Wealthy Crowd || Sign Up || User">
    <link rel="icon" href="assets\images\logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="User/login-assets/accountcustom.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<?php require('conection.php');  
  $newMember=$_GET['glowCoco'];
  $glowCoco=base64_decode($newMember);
  $queryNew=mysqli_query($con,"SELECT a.name,a.user_id,a.password,a.trnPassword,b.user_id AS sponserId,b.name AS sponserName FROM meddolic_user_details a, meddolic_user_details b WHERE a.member_id='$_SESSION[newDevineToken]' AND a.user_type=2 AND a.sponser_id=b.member_id");
  $valNew=mysqli_fetch_assoc($queryNew);
  $newName=$valNew['name'];
  $newUserId=$valNew['user_id'];
  $password=$_SESSION['newLogPass'];
  $trnPassword=$_SESSION['ngTrnPass'];
  $sponserId=$valNew['sponserId'];
  $sponserName=$valNew['sponserName']; ?>
<body class="bg">
    <div id="mainCoantiner">

        <!--dust particel-->
        <div>
            <div class="starsec"></div>
            <div class="starthird"></div>
            <div class="starfourth"></div>
            <div class="starfifth"></div>
        </div>
        <div class="container pt-3 login-form-container">
            <div class="row justify-content-sm-center">
                <div class="col-sm-6 col-md-6">

                    <div class="card account-card text-center gradient-border" id="box">
                        <div class="card-body">
                            <div class="col-md-12 text-center pb-2">
                                <a href="http://cygnetglobal.io"><span class="text-white txt font-weight-bolder"> Home |</span></a><a id="btnForgotPassword" href="authUserRegister" class="reset-password txt text-white font-weight-bolder"> Sign Up</a>
                            </div>
                            <img src="assets/images/logo.png" class="img-fluid" style="width:120px">
                            <div class="text-white mb-4">
                                <h2>Registration Successfully!</h2>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 mx-auto">
                                    <label class="control-label">UserId</label>
                                    <input type="text" class="form-control mb-2" value="<?=$newUserId?>" style="background-color: #fff0;color: #ffffff;" readonly />
                                </div>
                                <div class="col-sm-6 col-md-6 mx-auto">
                                    <label class="control-label">User Name</label>
                                    <input type="text" class="form-control mb-2" value="<?=$newName?>" style="background-color: #fff0;color: #ffffff;" readonly />
                                </div>
                                <div class="col-sm-6 col-md-6 mx-auto">
                                    <label class="control-label">Password</label>
                                    <input type="text" class="form-control mb-2" disabled value="<?=$password?>" style="background-color: #fff0;color:#ffffff;" readonly />
                                </div>
                                <div class="col-sm-6 col-md-6 mx-auto">
                                    <label class="control-label">Trn Password</label>
                                    <input type="text" class="form-control mb-2" value="<?=$trnPassword?>" style="background-color: #fff0;color: #ffffff;" readonly />
                                </div>
                                <div class="col-sm-6 col-md-6 mx-auto">
                                    <label class="control-label">SponserId</label>
                                    <input type="text" class="form-control mb-2" value="<?=$sponserId?>" style="background-color: #fff0;color: #ffffff;" readonly />
                                </div>
                                <div class="col-sm-6 col-md-6 mx-auto">
                                    <label class="control-label">Sponsor Name</label>
                                    <input type="text" class="form-control mb-2" value="<?=$sponserName?>" style="background-color: #fff0;color: #ffffff;" readonly />
                                </div>
                            </div>
                            <center>
                                <div class="wrapper mt-5">
                                    <a href="User"><button class="btn btn4">Login</button></a>
                                </div>
                            </center>
                        </div>
                    </div>
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
</body>
</html>