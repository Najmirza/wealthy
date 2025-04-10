<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="description" content="ZRX POOL|| Sign Up || User">
    <title>Wealthy Crowd|| Trn Password Recovery</title>
    <meta name="author" content="ZRX POOL|| Sign Up || User">
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="login-assets/accountcustom.css">
</head>
<?php require('../conection.php');
error_reporting(1);
unset($_SESSION['passTokenSet']);
$randToken=rand(1111,9999).time().date('s');
$_SESSION['passTokenSet']=md5($randToken); ?>
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
                           <a href="http://cygnetglobal.in"><span class="text-white txt font-weight-bolder"> Home |</span></a><a id="btnForgotPassword" href="../User" class="reset-password txt text-white font-weight-bolder"> Sign In</a>
                        </div>
                        <img src="../assets/images/logo.png" class="img-fluid" style="max-width: 40%!important;">
                        <div class="text-white mb-4">
                            <h2>Password Transaction Recovery</h2>
                        </div>
                          <!-- <h4 class="text-center">Hunger & Debt Ltd</h4> -->
                        <div class="row">
                          <div class="col-sm-8 col-md-8 mx-auto">
                          <form class="form-signin" id="forgotTrnPassForm" >
                              <input type="text" class="form-control mb-4" style="background-color: #fff0;color: #ffffff;" data-val="true" data-val-required="User ID is Required" id="inputUserId" name="inputUserId" placeholder="Username" required value="<?php if(isset($_COOKIE["memberUserId"])) { echo $_COOKIE["memberUserId"]; }?>" />
                              <span class="field-validation-valid" data-valmsg-for="username" data-valmsg-replace="true"></span>
                              <input id="inputEmailId" name="inputEmailId" class="form-control mb-4" style="background-color: #fff0;color: #ffffff;" type="text" placeholder="Email Id" >
                              <span class="field-validation-valid" data-valmsg-for="mpwd" data-valmsg-replace="true"></span>
                              <div class="row">
                                <div class="col-sm-6 col-md-6">
                                  <a href="../User" class="text-white text-left">Sign In</a>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                  <a href="../authUserRegister" class="text-white text-right">Create an account </a>
                                </div>
                              </div>
                              <center>
                                <div class="wrapper mt-5">
                                  <button type="button" class="btn btn4" id="passSubmit" onclick="forgotTrnPassValidate('<?=$_SESSION['passTokenSet']?>')">Reset</button>
                                  <button disabled style="display: none;" class="btn btn-danger loadingMore">Validating Data...</button> 
                                </div>
                                <div class="col-12 text-center">
                                  <h6 id="success"></h6>
                                </div>
                              </center>
                            </form>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- jQuery 3 -->
  <script src="login-assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js"></script>
  <!-- fullscreen -->
  <script src="login-assets/vendor_components/screenfull/screenfull.js"></script>
  <!-- popper -->
  <script src="login-assets/vendor_components/popper/dist/popper.min.js"></script>
  <!-- Bootstrap 4.0-->
  <script src="login-assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="custom.js"></script>
</body>
</html>














