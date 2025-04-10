<?php
require_once("loginCheck.php");
require_once('Include/Head.php');
require_once('Include/Header.php');
require_once('Include/Menu.php'); ?>

<?php


$nextPool = 0;
$memberId1 = "";
if ($_GET) {
  if ($_GET['userId']) {
    $userLog = $_GET['userId'];
     $queryCo =mysqli_query($con, "SELECT COUNT(*) FROM meddolic_user_details WHERE user_id='$userLog' AND account_status=1 ");
    $valCo = mysqli_fetch_array($queryCo);
    if ($valCo[0] == 0) { ?>
      <script>
        alert("Invalid / Active User Id");
      </script>
<?php
    } else {
      $queryDetails = mysqli_query($con, "SELECT member_id,name,user_id,poolEntry FROM meddolic_user_details WHERE user_id='$userLog'");
      $valUser = mysqli_fetch_array($queryDetails);
      $name1 = $valUser['name'];
      $memberId1 = $valUser['member_id'];
      $userId1 = $valUser['user_id'];
      $currentPool = $valUser['poolEntry'];
      $nextPool = $currentPool + 1;
      if ($nextPool <= 10) {
        $queryPool = mysqli_query($con, "SELECT packageId,packagePrice FROM meddolic_config_package_list WHERE packageId='$nextPool'");
        $valPool = mysqli_fetch_assoc($queryPool);
        $poolId = $valPool['packageId'];
        $upgradePrice = $valPool['packagePrice'];
      }
    }
  }
}
?>

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Activate User</span>
    </h4>
    <div class="row">
      <div class="col-md-12">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <div class="card crd0">
                <div class="card-body">
                  <form class="theme-form" action="authActiveUserProcess" method="post">
                    <div class="mb-3">
                      <label>UserId *</label>
                      <input type="text" name="sponser_id" id="sponser_id" class="form-control" placeholder="Enter User Id" onblur="checkUserDetails(this.value)" required value="<?= $userId1 ?>" >
                      <input type="hidden" name="loginMemberId" value="<?= $memberId ?>">
                    </div>
                    <div class="mb-3">
                      <label>Name </label>
                      <input type="text" name="sponser_name" class="form-control" placeholder="e.g. Name" disabled readonly value="<?= $name1 ?>">
                    </div>
                    <?php if ($memberId1 != "" && $nextPool <= 10) { ?>
                    <div class="mb-3">
                      <label>Purchase Wallet </label>
                      <input type="text" id="current_wallet" name="current_wallet" class="form-control" readonly value="<?= $fundWallet ?>">
                    </div>
                    <div class="mb-3">
                  <label>Next Pool </label>
                  <input type="text" class="form-control" readonly value="<?= $poolName ?>  [ $ <?= $upgradePrice ?> ]">
                  <input type="hidden" name="packageId" value="<?= $poolId ?>" readonly>
                  <input type="hidden" name="investmentAmount" value="<?= $upgradePrice ?>" readonly>
                </div>
                <?php } else if ($nextPool > 10) { ?>
                  <p class="text-danger font-weight-bold">Max Pool Upgrade Limit Reached. Thank You</p>
                  <?php } ?>
                    <div class="mb-3">
                      <label>Transaction Password *</label>
                      <input type="password" name="trnPassword" class="form-control" required placeholder="Enter Transaction Password">
                    </div>
                    <?php if ($memberId1 != "" && $nextPool <= 10) { ?>
                    <div class="">
                      <button type="submit" class="btn btn-primary" data-bs-original-title="" title="Active Now" name="startInvest" value="Active Now">Active Now</button>
                    </div>
                    <?php } else { ?>
                      <button type="button" disabled name="startInvest" class="btn btn-success" data-bs-original-title="">Active Now</button>
                    <?php } ?>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once('Include/Footer.php'); ?>
<script>
  function checkUserDetails(userId) {
    if (userId != "") {
      window.top.location.href = "activateMember?userId=" + userId;
    }
  }
  var d = document.getElementById("User");
  d.className += " active";
  var d = document.getElementById("activateMember");
  d.className += " active";
</script>