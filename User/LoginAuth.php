<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
  <meta name="description" content="Wealthy Crowd|| Sign Up || User">
  <title>Wealthy Crowd||</title>
  <meta name="author" content="Wealthy Crowd || Sign Up || User">
  <link rel="icon" href="assets\images\logo.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="login-assets/accountcustom.css">
</head>

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
        <div class="col-sm-6 col-md-6 alfa" style="left: -62px;">
          <img src="login-assets\images\login.jpg" alt="">
        </div>
        <div class="col-sm-6 col-md-6">

          <div class="card account-card text-center gradient-border" id="box">
            <div class="card-body">
              <div class="col-md-12 text-center pb-2">
                <a href="../index.html"><span class="text-white txt font-weight-bolder"> Home |</span></a>
                <a id="btnForgotPassword" href="../authUserRegister" class="reset-password txt text-white font-weight-bolder"> Sign Up</a>
              </div>
              <img src="../assets\images\logo.png" class="img-fluid" style="width:180px">
              <div class="text-white mb-4">
                <h2>Login</h2>
              </div>
              <!-- <h4 class="text-center">Hunger & Debt Ltd</h4> -->
              <div class="row">
                <div class="col-sm-8 col-md-10 mx-auto">
                  <form class="form-signin">

                    <div class="input-group">
                      <input type="text" id="inputUserId" class="form-control mb-4" style="background-color: #fff0;color: #ffffff;" data-val="true" data-val-required="User ID is Required" id="inputUserId" placeholder="Username" required value="<?php if (isset($_COOKIE[" memberUserId"])) {
                                                                                                                                                                                                                                                      echo $_COOKIE["memberUserId"];
                                                                                                                                                                                                                                                    } ?>" />
                      <div class="input-group-append">
                        <span class="input-group-text" style="height: 38px;background: #fff0;color: white;">
                          <i class="fa fa-user"></i>
                        </span>
                      </div>
                    </div>
                    <span class="field-validation-valid" data-valmsg-for="username" data-valmsg-replace="true"></span>


                    <div class="input-group">
                      <input type="password" class="form-control mb-2" style="background-color: #fff0;color: #ffffff;" data-val="true" data-val-required="Password is Required" id="inputPassword" name="password" placeholder="Password" required onkeypress="return catchEnter(event)" value="<?php if (isset($_COOKIE[" memberPassKey"])) {
                                                                                                                                                                                                                                                                                                  echo $_COOKIE["memberPassKey"];
                                                                                                                                                                                                                                                                                                } ?>" />
                      <div class="input-group-append">
                        <span class="input-group-text" style="height: 38px;background: #fff0;color: white;">
                          <i class="fa fa-unlock-alt"></i>
                        </span>
                      </div>
                    </div>


                    <span class="field-validation-valid" data-valmsg-for="mpwd" data-valmsg-replace="true"></span>

                    <!--<div class="row">-->
                    <!--  <div class="col-sm-12 col-md-12 mx-auto">-->
                    <!--    <div class="g-recaptcha" data-sitekey="6Ldhj8gjAAAAALeODoepl41a5T-PEsX-QUe-Ac0a"></div>-->
                    <!--  </div>-->
                    <!--</div>-->
                    <div class="row">
                      <div class="col-sm-6 col-md-6">
                        <a href="forget-pass" class="text-white text-left">Forgot Password</a>
                      </div>

                      <div class="col-sm-6 col-md-6">
                        <a href="forget-trn-pass" class="text-white text-right">Forgot Trn Password </a>
                      </div>

                    </div>
                    <div class="col-sm-12 col-md-12" style="    margin-top: 23px;">
                      Don't have an account? <a href="../authUserRegister" class="text-white text-right"> Sign up</a>
                    </div>
                    <center>
                      <div class="wrapper mt-5">
                        <button type="button" class="btn btn4" id="loginSubmit" onclick="LoginValidate()">Login</button>
                        <button disabled style="display: none;" class="btn btn4 btn btn-rounded my-20 btn-warning loadingMore">Validating Data...</button>
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
  <script>
    function togglePasswordVisibility() {
      var passwordInput = document.getElementById("inputPassword");
      var eyeIcon = document.getElementById("eyeIcon");

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
      } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
      }
    }
  </script>
</body>

</html>