<?php 
  require_once("loginCheck.php");
    require_once('Include/Head.php');
    require_once('Include/Header.php');
    require_once('Include/Menu.php');?>


      <div class="content-wrapper">

        <!-- Content -->
        
          <div class="container-xxl flex-grow-1 container-p-y">
            
            
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Profile /</span> Transaction Password
</h4>
<?php
    $queryProfile=mysqli_query($con,"SELECT date_time,sponser_id,countryId,name,user_id,email_id,phone FROM meddolic_user_details WHERE user_id='$userId'");
    $valProfile=mysqli_fetch_assoc($queryProfile);
    $dateTime=$valProfile['date_time'];
    $sponserId=$valProfile['sponser_id'];
    $countryId=$valProfile['countryId'];
    $name=$valProfile['name'];
    $email_id=$valProfile['email_id'];
    $phone=$valProfile['phone']; ?>
<div class="row">
  <div class="col-md-12">
    <!-- Change Password -->
    <div class="card mb-4">
      <h5 class="card-header">Change Transaction Password</h5>
      <div class="card-body">
        <form action="userProfileAuthProcess" method="POST" >
          <div class="row">
            <div class="mb-3 col-md-6 form-password-toggle">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                <input type="password" name="password" id="trnPassword" class="form-control" placeholder="Current Transation Password" data-rule-required="true" />
                            <input type="hidden" name="memberId" value="<?=$memberId?>" >
                  <label for="currentPassword">Current Trn Password</label>
                </div>
                <span class="input-group-text cursor-pointer"><i class="fa fa-eye" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="mb-4 col-md-6 form-password-toggle">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                <input type="password" id="trnPassword1" class="form-control" placeholder="Current Transaction Password" data-rule-required="true" name="password1" />
                  <label for="newPassword">New Trn Password</label>
                </div>
                <span class="input-group-text cursor-pointer"><i class="fa fa-eye" aria-hidden="true"></i></span>
              </div>
            </div>
            <div class="mb-4 col-md-6 form-password-toggle">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                <input type="password" id="trnPassword2" placeholder="Retype Transaction Password" class="form-control" data-rule-required="true" onkeyup="matchPassword('trnPassword','confirmTrnPassword','trnPwdErrorMsg','trnJoin')" name="password2" />
                  <label for="confirmPassword">Confirm New Trn Pass</label>
                </div>
                <span class="input-group-text cursor-pointer"><i class="fa fa-eye" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          
          <div class="mt-4">
            <button type="submit" name="changeTrn"  class="btn btn-primary me-2">Save changes</button>

          </div>
        </form>
      </div>
    </div>
    <!--/ Change Password -->

    
  </div>
</div>


            
          </div>
          <!-- / Content -->

          
          

          <?php require_once('Include/Footer.php');?>
