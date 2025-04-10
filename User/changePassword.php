<?php
require_once("loginCheck.php");
require_once('Include/Head.php');
require_once('Include/Header.php');
require_once('Include/Menu.php'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">

  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Profile /</span> Change Password
    </h4>
    <?php
    $queryProfile = mysqli_query($con, "SELECT date_time,sponser_id,countryId,name,user_id,email_id,phone FROM meddolic_user_details WHERE user_id='$userId'");
    $valProfile = mysqli_fetch_assoc($queryProfile);
    $dateTime = $valProfile['date_time'];
    $sponserId = $valProfile['sponser_id'];
    $countryId = $valProfile['countryId'];
    $name = $valProfile['name'];
    $email_id = $valProfile['email_id'];
    $phone = $valProfile['phone']; ?>
    <div class="row">
      <div class="col-md-12">

        <!-- Change Password -->
        <div class="card mb-4">
          <h5 class="card-header">Change Password</h5>
          <div class="card-body">
            <form action="userProfileAuthProcess" method="POST">
              <div class="row">
                <div class="mb-3 col-md-6 form-password-toggle">
                  <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                      <input type="password" name="password" id="currentPass" class="form-control" placeholder="Current Login Password" data-rule-required="true" />
                      <input type="hidden" name="memberId" value="<?= $memberId ?>">
                      <label for="newPassword">Current Password</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="fa fa-eye" aria-hidden="true"></i></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="mb-4 col-md-6 form-password-toggle">
                  <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                      <input type="password" name="password1" id="loginPassword" class="form-control" placeholder="Enter Password" data-rule-required="true" onkeyup="matchPassword('loginPassword','confirmLoginPassword','loginPasswordErrorMsg','loginJoin')" />
                      <label for="newPassword">New Password</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="fa fa-eye" aria-hidden="true"></i></span>
                  </div>
                </div>
                <div class="mb-4 col-md-6 form-password-toggle">
                  <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                      <input type="password" id="confirmLoginPassword" placeholder="Confirm Password" class="form-control" data-rule-required="true" onkeyup="matchPassword('loginPassword','confirmLoginPassword','loginPasswordErrorMsg','loginJoin')" name="password2" />
                      <label for="confirmPassword">Confirm New Password</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="fa fa-eye" aria-hidden="true"></i></span>
                  </div>
                </div>
              </div>
              <h6 class="text-body">Password Requirements:</h6>
              <ul class="ps-3 mb-0">
                <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                <li class="mb-1">At least one lowercase character</li>
                <li>At least one number, symbol, or whitespace character</li>
              </ul>
              <div class="mt-4">
                <button type="submit" name="changeLogin" class="btn btn-primary col-md-2 col-sm-3">Save</button>
                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
              </div>
            </form>
          </div>
        </div>
        <!--/ Change Password -->
      </div>
    </div>
  </div>


  <?php require_once('Include/Footer.php'); ?>