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
      <span class="text-muted fw-light">Profile /</span> My Profile
    </h4>

    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <h4 class="card-header">Profile Details</h4>
          <?php
          $queryProfile = mysqli_query($con, "SELECT date_time,sponser_id,countryId,name,user_id,email_id,phone,aadhar,pan FROM meddolic_user_details WHERE user_id='$userId'");
          $valProfile = mysqli_fetch_assoc($queryProfile);
          $dateTime = $valProfile['date_time'];
          $sponserId = $valProfile['sponser_id'];
          $countryId = $valProfile['countryId'];
          $name = $valProfile['name'];
          $email_id = $valProfile['email_id'];
          $phone = $valProfile['phone'];
          $aadhar = $valProfile['aadhar'];
          $pan = $valProfile['pan'];

          if ($countryId != '') {
            $queryCountry = mysqli_query($con, "SELECT countryName FROM meddolic_config_country_list WHERE country_id='$countryId'");
            $valCountry = mysqli_fetch_assoc($queryCountry);
            $countryName = $valCountry['countryName'];
          } ?>
          <!-- Account -->
          <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
              <img src="images\3.png" alt="user-avatar" class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar" />
            </div>
          </div>
          <div class="card-body pt-2 mt-1">
            <form action="userProfileAuthProcess" method="POST" enctype="multipart/form-data">
              <div class="row mt-2 gy-4">
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                  <span>User Name *</span>
                    <input class="form-control" data-val="true" data-val-regex="Please enter only alphabets" data-val-regex-pattern="^[a-zA-Z\s]+$" data-val-required="Name is Required" id="Memb_Name" name="name" placeholder="Name" required type="text" value="<?= $userName ?>" />
                    <input type="hidden" name="memberId" value="<?= $memberId ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                  <span>Mobile Number *</span>
                    <input type="text" name="phone" class="form-control" maxlength="10" data-rule-required="true" data-rule-digits="true" data-rule-minlength="10" data-rule-maxlength="10" required data-val-required="Mobile No is Required" id="MobNo" placeholder="Mobile Number" value="<?= $phone ?>" <?php if ($phone != "") echo "readonly" ?> onkeypress="return onlynum(event)" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                  <span>Email *</span>
                    <input type="email" id="EmailID" data-val="true" data-val-regex="Enter Valid Email Id" class="form-control" data-val-regex-pattern="^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z\-])+\.)+([a-zA-Z]{2,6})$" data-val-required="Email Id is Required" name="emailId" placeholder="Email ID" type="email" value="<?= $email_id ?>" <?php if ($email_id != "") echo "readonly" ?> />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                  <span>Country *</span>
                    <select class="form-control" required id="M_COUNTRY" name="countryId">
                      <option value="">Select Country</option>
                      <?php $queryCountry = "SELECT * FROM meddolic_config_country_list WHERE status=1 ORDER BY countryName ASC";
                      $resultCountry = mysqli_query($con, $queryCountry);
                      while ($valCountry = mysqli_fetch_assoc($resultCountry)) { ?>
                        <option value="<?= $valCountry['country_id'] ?>" <?php if ($valCountry['country_id'] == $countryId) echo "selected"; ?>><?= $valCountry['countryName'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <!--<div class="col-md-6">-->
                <!--  <div class="form-floating form-floating-outline">-->
                <!-- <span>Aadhar Number *</span>-->
                <!--    <input type="text" name="aadhar" class="form-control" maxlength="12" data-rule-required="true" data-rule-digits="true" data-rule-minlength="12" data-rule-maxlength="12" required data-val-required="Aadhar No is Required" id="aadhar" placeholder="Aadhar Number" value="<?= $aadhar ?>" />-->
                <!--  </div>-->
                <!--</div>-->
                <!--<div class="col-md-6">-->
                <!--  <div class="form-floating form-floating-outline">-->
                <!--  <span>Pan Number *</span>-->
                <!--    <input type="text" id="pan" data-val="true" data-val-regex="Enter Pan " class="form-control"  data-val-required="Pan Id is Required" name="pan" placeholder="Pan Number"  value="<?= $pan ?>" />-->
                <!--  </div>-->
                <!--</div>-->
              </div>
              <div class="mt-4">
                <button type="submit" name="profileUpdate" id="submit" class="btn btn-primary me-2">Save changes</button>
                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
              </div>
            </form>
          </div>
          <!-- /Account -->
        </div>

      </div>
    </div>



  </div>
  <!-- / Content -->


  <?php require_once('Include/Footer.php'); ?>