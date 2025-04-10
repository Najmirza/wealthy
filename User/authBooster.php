<?php
require_once("loginCheck.php");
require_once('Include/Head.php');
require_once('Include/Header.php');
require_once('Include/Menu.php'); ?>

<?php
    $queryBoost =mysqli_query($con,"SELECT boostingAmount FROM meddolic_config_misc_setting ");
    $valBoost = mysqli_fetch_assoc($queryBoost);
    $boostingAmount = $valBoost['boostingAmount'];

    $queryDetails = mysqli_query($con, "SELECT member_id,name,user_id,topup_flag FROM meddolic_user_details WHERE user_id='$userId'");
    $valUser = mysqli_fetch_array($queryDetails);
    $name1 = $valUser['name'];
    $memberId1 = $valUser['member_id'];
    $userId1 = $valUser['user_id'];
    $topup_flag = $valUser['topup_flag'];
?>
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Magical Booster </span>
    </h4>
    <div class="row">
      <div class="col-md-12">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <div class="card crd0">
                <div class="card-body">
                  <form class="theme-form" action="authBoosterProcess" method="post">
                    <div class="mb-3">
                      <label>UserId *</label>
                      <input type="text" name="sponser_id" id="sponser_id" class="form-control" placeholder="Enter User Id" onblur="checkUserDetails(this.value)" required readonly value="<?= $userId1 ?>" >
                      <input type="hidden" name="loginMemberId" value="<?= $memberId ?>">
                    </div>
                    <div class="mb-3">
                      <label>Name </label>
                      <input type="text" name="sponser_name" class="form-control" placeholder="e.g. Name" disabled readonly value="<?= $name1 ?>">
                    </div>
                    <div class="mb-3">
                      <label>Purchase Wallet </label>
                      <input type="text" id="current_wallet" name="current_wallet" class="form-control" readonly value="<?= $fundWallet ?>">
                    </div>
                    <div class="mb-3">
                      <label>Booster Amount </label>
                      <input type="text" id="boostingAmount" name="boostingAmount" class="form-control" readonly value="<?= $boostingAmount ?>">
                    </div>
                    <div class="mb-3">
                      <label>Transaction Password *</label>
                      <input type="password" name="trnPassword" class="form-control" required placeholder="Enter Transaction Password">
                    </div>
                    <div class="">
                      <button type="submit" class="btn btn-primary" data-bs-original-title="" title="Active Now" name="booster" value="Active Now">Boost Now</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
      <div class="card crd0">
        <div class="card-body">
          <div class="dt-ext table-responsive">
            <table class="table table-bordered table-hover display margin-top-10 w-p100" id="export-button">
              <thead>
                <tr>
                  <th>#</th>
                  <th>UserId</th>
                  <th>Name</th>
                  <th>Boosting Amount </th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
              <?php 
               $count=0;
               $queryBooster=mysqli_query($con,"SELECT a.boostingAmount,a.boostingDate, b.user_id,b.name FROM meddolic_user_booster_details a, meddolic_user_details b WHERE a.member_id=b.member_id AND a.member_id='$memberId' ORDER BY a.boostingDate DESC");
               while($valBooster=mysqli_fetch_assoc($queryBooster)){
                   $count++; ?>
                <tr>
                  <td><?= $count?></td>
                  <td><?= $valBooster['user_id']?></td>
                  <td><?= $valBooster['name']?></td>
                  <td><span class="badge badge-success"><i class="fa-solid fa-dollar"></i> <?= $valBooster['boostingAmount']?></span></td>
                  <td><i class="fa-regular fa-clock"></i> <?= date("d-m-Y H:i:s", strtotime($valBooster['boostingDate']))?></td>
                <?php } ?>
              </tbody>
            </table>
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
  var d = document.getElementById("User");
  d.className += " active";
  var d = document.getElementById("activateMember");
  d.className += " active";
</script>